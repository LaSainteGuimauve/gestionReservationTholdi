<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Model\Data;

class AuthentificationController extends Controller
{
    public function authentificationCompteUtilisateur(Request $request)
    {
	$identifiant = $request->get("identifiant");
	$motDePasse = $request->get("motDePasse");
	$compteExistant = Data::obtenirCompteUtilisateur($identifiant, $motDePasse);
	if ($compteExistant != false)
	{
            $request->session()->put('connected');
            $request->session()->put('utilisateur',$compteExistant);
	}
	return back();
    }
}
