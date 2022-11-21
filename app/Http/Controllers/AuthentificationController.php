<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Model\Data;
use App\Http\Model\UtilisateurQuery;

class AuthentificationController extends Controller
{
    public function authentificationCompteUtilisateur(Request $request)
    {
	$identifiant = $request->get("identifiant");
	$motDePasse = $request->get("motDePasse");
	$compteExistant = UtilisateurQuery::create()
                ->where('utilisateur.login = ?', $identifiant)
                ->where('utilisateur.mdp = ?', $motDePasse)
                ->findOne();
	if ($compteExistant != false)
	{
            $request->session()->put('connected');
            $request->session()->put('utilisateur',$compteExistant);
	}
	return back();
    }
}
