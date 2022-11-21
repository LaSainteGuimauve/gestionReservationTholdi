<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Model\ReservationQuery;
use App\Http\Model\DevisQuery;

class DevisController extends Controller {

    public function consulterDevis(Request $request) {
        $compteUtilisateur = $request->session()->get('utilisateur');
        $codeUtilisateur = $compteUtilisateur->getCode();
        $collectionDevis = ReservationQuery::create()
                ->leftJoinWithDevis()
                ->leftJoinWithUtilisateur()
                ->leftJoinWithReserver()
                ->useReserverQuery()
                ->leftJoinWithTypecontainer()
                ->endUse()
                ->where('reservation.codeDevis is not null')
                ->findByCodeutilisateur($codeUtilisateur);

        return view('devis.consultationDevis', ["collectionDevis" => $collectionDevis]);
    }

}
