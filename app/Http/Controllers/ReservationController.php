<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Model\Data;
use DateTime;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller {

    private function dateTimeToTimestamp($date) {
        $dt = new DateTime($date);
        return $dt->getTimestamp();
    }

    public function saisirReservation() {
        $collectionVilles = Data::obtenirCollectionVille();
        return view('reservation.saisirReservation', ['collectionVilles' => $collectionVilles]);
    }

    public function ajouterReservation(Request $request) {
        $dateDebutReservation = $request->input('dateDebutReservation');
        $dateFinReservation = $request->input('dateFinReservation');
        $dateDebutReservation = $this->dateTimeToTimestamp($dateDebutReservation);
        $dateFinReservation = $this->dateTimeToTimestamp($dateFinReservation);
        $codeVilleMiseDisposition = $request->input('codeVilleMiseDisposition');
        $codeVilleRendre = $request->input('codeVilleRendre');
        $volumeEstime = $request->input('volumeEstime');
        $compteUtilisateur = $request->session()->get('utilisateur');
        $codeUtilisateur = $compteUtilisateur->getCode();
        $codeReservation = Data::AjouterUneReservation($dateDebutReservation,
                        $dateFinReservation, time(), $codeVilleMiseDisposition, $codeVilleRendre, $volumeEstime, $code);
        session()->put('codeReservation', $codeReservation);
        $typeContainer = Data::obtenirCollectionTypeContainer();
        $view = view('reservation.saisirLigneDeReservation', ['typeContainer' => $typeContainer]);
        return $view;
    }

    public function ajouterLigneReservation(Request $request) {
        $numeroTypeContainer = $request->input('container');
        $qteReserver = $request->input('quantite');
        if ($request->session()->has('LesLignesDeReservation') != true) {
            $collectionLignesReservation = collect();
        } else {
            $collectionLignesReservation = $request->session()->get('LesLignesDeReservation');
        }
        $collectionLignesReservation->push(['numTypeContainer' => $numeroTypeContainer, 'qteReserver' => $qteReserver]);
        $request->session()->put('LesLignesDeReservation', $collectionLignesReservation);
        $typeContainer = Data::obtenirCollectionTypeContainer();
        $collectionTypeContainer = collect($typeContainer);
        $collectionTypeContainer->mergeByDesiredKey($collectionLignesReservation, "numTypeContainer");
        return view('reservation.saisirLigneDeReservation', ['typeContainer' => $collectionTypeContainer]);
    }

    public function finaliserLaReservation(Request $request) {
        $codeReservation = $request->session()->get('codeReservation');
        $lesLignesDeReservation = $request->session()->get('LesLignesDeReservation');
        if ($lesLignesDeReservation != null) {
            foreach ($lesLignesDeReservation as $uneLigneDeReservation) {
                $numTypeContainer = $uneLigneDeReservation["numTypeContainer"];
                $qteReserver = $uneLigneDeReservation["qteReserver"];
                Data::ajouterUneLigneDeReservation($codeReservation, $numTypeContainer, $qteReserver);
            }
            $request->session()->remove('LesLignesDeReservation');
            $lignesReservation = Data::obtenirCollectionLignesDeUneReservation($codeReservation);
            $request->session()->remove('codeReservation');
            $view = view('reservation.recapitulatifDemandeDeReservation', ['CollectionlignesReservation' => $lignesReservation]);
        } else {
            $view = $this->consulterReservation($request);
        }
        return $view;
    }

    public function consulterReservation(Request $request) {
        $compteUtilisateur = $request->session()->get('utilisateur');
        $codeUtilisateur = $compteUtilisateur->getCode();
        $collectionReservationEtLigneDeReservation = DB::table('reservation')
                ->select('*', 'v.nomVille as villeDepart', 'v2.nomVille as villeArrivee')
                ->leftJoin('utilisateur', 'utilisateur.code', '=', 'reservation.codeUtilisateur')
                ->leftJoin('reserver', 'reserver.codeReservation', '=', 'reservation.codeReservation')
                ->leftJoin('typeContainer', 'reserver.numTypeContainer', '=', 'typeContainer.numTypeContainer')
                ->leftJoin('ville as v', 'v.codeVille', '=', 'reservation.codeVilleMiseDisposition')
                ->leftJoin('ville as v2', 'v2.codeVille', '=', 'reservation.codeVilleRendre')
                ->where('utilisateur.code', '=', $codeUtilisateur)
                ->get();
        $reservations = $collectionReservationEtLigneDeReservation->groupBy('codeReservation');        
        $reservations = $reservations->toArray();
        return view(
                'reservation.consultationReservations', ['collectionReservationEtLigneDeReservation' => $reservations]);
    }

    public function confirmerReservation(Request $request) {
        $codeReservation = $request->input('codeReservation');
        DB::table("reservation")
                ->where('codeReservation', $codeReservation)
                ->update(['etat' => 'validee']);
                "insert into devis (dateDevis,montantDevis,nbContainers) values (:dateDuJour,:montantDevis,:nbContainers)";
        Data::genererUnDevisPourUneReservation($codeReservation);
        return $this->consulterReservation($request);
    }

}
