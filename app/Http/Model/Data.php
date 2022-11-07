<?php

namespace App\Http\Model;

use PDO;
use DateTime;
use Exception;

class Data {

    static private $requete_ajouterUneReservation = "insert into reservation (dateDebutReservation, dateFinReservation,dateReservation, codeVilleMiseDispositioncodeVilleRendre,volumeEstime,codeUtilisateur) values (:dateDebutReservation,:dateFinReservation,:dateReservation,:codeVilleMiseDisposition,:codeVilleRendre,:volumeEstime,:codeUtilisateur)";
    static private $requete_obtenirCollectionTypeContainer = " select * from typeContainer";
            
    static function init() {
        return new PDO(Data::$dsn, "root", "Azerty1");
    }
    
    static function obtenirCompteUtilisateur($identifiant, $motDePasse) {
        $compteExistant = false;
        $pdo = Data::init();
        $pdoStatement=$pdo->prepare(Data::$requete_obtenirCompteUtilisateur);
        $pdoStatement->bindParam(':identifiant', $identifiant, PDO::PARAM_STR);
        $pdoStatement->bindParam(':motDePasse', $motDePasse, PDO::PARAM_STR);
        $pdoStatement->execute();
        if ($pdoStatement == false) {
            $error = $pdoStatement->errorCode() . $pdoStatement->errorInfo();
            report($error);
            throw new Exception($error);
        }
        $resultat = $pdoStatement->fetch();
        if ($resultat != false) {
            $compteExistant = $resultat;
        }
        $pdoStatement->closeCursor();
        return $compteExistant;
    }

    static function obtenirCollectionVille() {
        $pdo = Data::init();
        $pdoStatement = $pdo->query(Data::$requete_obtenirCollectionVille);
        if ($pdoStatement == false) {
            $error = $pdoStatement->errorCode(). $pdoStatement->errorInfo();
            report($error);
            throw new Exception($error);
        }
        $collectionDeVille = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        return $collectionDeVille;
    }
    
    static function obtenirCollectionTypeContainer() {
    $pdo = Data::init();
    $pdoStatement = $pdo->query(Data::$requete_obtenirCollectionTypeContainer);
    if ($pdoStatement == false) {
        $error = $pdoStatement->errorCode() . $pdoStatement->errorInfo();
        report($error);
        throw new Exception($error);
    }
    return $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    }
    
    static function ajouterUneReservation($dateDebutReservation, $dateFinReservation, $dateReservation, $codeVilleMiseDisposition, $codeVilleRendre, $volumeEstime, $codeUtilisateur) {
        $pdo = Data::init();
        $pdoStatement = $pdo->prepare(Data::$requete_ajouterUneReservation);
        $pdoStatement->bindParam(":dateDebutReservation", 
        $dateDebutReservation);
        $pdoStatement->bindParam(":dateFinReservation", $dateFinReservation);
        $pdoStatement->bindParam(":dateReservation", $dateReservation);
        $pdoStatement->bindParam(":codeVilleMiseDisposition", 
        $codeVilleMiseDisposition);
        $pdoStatement->bindParam(":codeVilleRendre", $codeVilleRendre);
        $pdoStatement->bindParam(":volumeEstime", $volumeEstime);
        $pdoStatement->bindParam(":codeUtilisateur", $codeUtilisateur);
        $pdoStatement->execute();
        if ($pdoStatement == false) {
            $error = $pdoStatement->errorCode() . $pdoStatement->errorInfo();
            report($error);
            throw new Exception($error);
        }
        $idReservationInseree = $pdo->lastInsertId();
        return $idReservationInseree;
    }
    
    static function ajouterUneLigneDeReservation($codeReservation, $numTypeContainer, $qteReserver) {
        $pdo = Data::init();
        $pdoStatement = $pdo->prepare(Data::$requete_ajouterUneLigneDeReservation);
        $pdoStatement->bindParam(":codeReservation", $codeReservation);
        $pdoStatement->bindParam(":numTypeContainer", $numTypeContainer);
        $pdoStatement->bindParam(":qteReserver", $qteReserver);
        $pdoStatement->execute();
        if ($pdoStatement == false) {
            $error = $pdoStatement->errorCode() . $pdoStatement->errorInfo();
            report($error);
        throw new Exception($error);
        }
    }

    static function obtenirCollectionReservationEtLigneDeReservationPourUnUtilisateur($codeUtilisateur) {
        $pdo = Data::init();
        $pdoStatement = $pdo->prepare(Data::$requete_obtenirCollectionReservationEtLigneDeReservationPourUnUtilisateur);
        $pdoStatement->bindParam(":codeUtilisateur", $codeUtilisateur);
        if ($pdoStatement->execute() == false) {
            $error = $pdoStatement->errorCode() . $pdoStatement->errorInfo();
            report($error);
            throw new Exception($error);
           }
        $ligneDeResultat = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        return $ligneDeResultat;
    }
    
    static function obtenirCollectionLignesDeUneReservation($codeReservation) {
        $pdo = Data::init();
        $pdoStatement = $pdo->prepare(Data::$requete_obtenirCollectionLignesDeUneReservation);
        $pdoStatement->bindParam(":codeReservation", $codeReservation);
        $pdoStatement->execute();
        if ($pdoStatement == false) {
            $error = $pdoStatement->errorCode() . $pdoStatement->errorInfo();
            report($error);
            throw new Exception($error);
        }
        $ligneDeResultat = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        return $ligneDeResultat;
    }

    
    static private $requete_obtenirCollectionReservationEtLigneDeReservationPourUnUtilisateur = "select v.nomVille as villeDepart, v2.nomVille as villeArrivee, rs.codeReservation, rs.dateDebutReservation, rs.numeroDeReservation, rs.dateFinReservation, rs.etat, rs.dateReservation, rs.volumeEstime, t.libelleTypeContainer, r.qteReserver from reservation rs join utilisateur u on u.code = rs.codeUtilisateur join reserver r on r.codeReservation = rs.codeReservation join typeContainer t on t.numTypeContainer = r.numTypeContainer join ville v on v.codeVille = rs.codeVilleMiseDisposition join ville v2 on v2.codeVille = rs.codeVilleRendre where rs.codeUtilisateur = :codeUtilisateur order by etat asc ";
    static private $dsn = 'mysql:host=mysql;dbname=tholdi_reservation';
    static private $requete_obtenirCompteUtilisateur = "SELECT * FROM utilisateur WHERE login=:identifiant AND mdp=:motDePasse";
    static private $requete_obtenirCollectionVille = "select * from ville ";
    static private $requete_ajouterUneLigneDeReservation = "insert into reserver (codeReservation, numTypeContainer, qteReserver) values (:codeReservation, :numTypeContainer, :qteReserver) ";
    static private $requete_obtenirCollectionLignesDeUneReservation = "select * from typeContainer t join reserver r on t.numTypeContainer = r.numTypeContainer join reservation rs on r.codeReservation = rs.codeReservation where r.codeReservation = :codeReservation";
        
}
