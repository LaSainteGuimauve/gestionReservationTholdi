<?php

namespace App\Http\Model;

use PDO;
use DateTime;
use Exception;

class Data {

    
    static function init() {
        return new PDO(Data::$dsn, "root", "Azerty1");
    }

    static private $dsn = 'mysql:host=mysql;dbname=tholdi_reservation_laravel';
    
    
    static function obtenirCollectionVille() {
        $pdo = Data::init();
        $pdoStatement = $pdo->query(Data::$requete_obtenirCollectionVille);
        if ($pdoStatement == false) {
            $error = $pdoStatement->errorCode() . $pdoStatement->errorInfo();
            report($error);
            throw new Exception($error);
        }
        $collectionDeVille = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        return $collectionDeVille;
    }

    static function AjouterUneReservation($dateDebutReservation, $dateFinReservation, $dateReservation, $codeVilleMiseDisposition, $codeVilleRendre, $volumeEstime, $codeUtilisateur) {
        $pdo = Data::init();
        $pdoStatement = $pdo->prepare(Data::$requete_ajouterUneReservation);
        $pdoStatement->bindParam(":dateDebutReservation", $dateDebutReservation);
        $pdoStatement->bindParam(":dateFinReservation", $dateFinReservation);
        $pdoStatement->bindParam(":dateReservation", $dateReservation);
        $pdoStatement->bindParam(":codeVilleMiseDisposition", $codeVilleMiseDisposition);
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

    static function obtenirCompteUtilisateur($identifiant, $motDePasse) {
        $compteExistant = false;
        $pdo = Data::init();
        $pdoStatement = $pdo->prepare(Data::$requete_obtenirCompteUtilisateur);
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

    static function confirmerReservation($codeReservation) {
        $pdo = Data::init();
        $pdoStatement = $pdo->prepare(Data::$requete_confirmerReservation);
        $pdoStatement->bindParam(":codeReservation", $codeReservation);
        $pdoStatement->execute();
        if ($pdoStatement == false) {
            $error = $pdoStatement->errorCode() . $pdoStatement->errorInfo();
            report($error);
            throw new Exception($error);
        }
    }

    static function obtenirReservationEncoursDeUnUtilisateur($codeUtilisateur) {
        $pdo = Data::init();
        $pdoStatement = $pdo->prepare(Data::$requete_obtenirReservationEncoursDeUnUtilisateur);
        $pdoStatement->bindParam(":codeUtilisateur", $codeUtilisateur);
        $pdoStatement->execute();
        if ($pdoStatement == false) {
            $error = $pdoStatement->errorCode() . $pdoStatement->errorInfo();
            report($error);
            throw new Exception($error);
        }
        $collectionDeReservationEnCoursDeUnUtilisateur = $pdoStatement->fetchAll(\PDO::FETCH_ASSOC);
        return $collectionDeReservationEnCoursDeUnUtilisateur;
    }

    static function supprimerUneReservation($codeReservation) {
        $pdo = Data::init();
        $pdoStatement = $pdo->prepare(Data::$requete_supprimerUneReservation);
        $pdoStatement->bindParam(":codeReservation", $codeReservation);
        $pdoStatement->execute();
        if ($pdoStatement == false) {
            $error = $pdoStatement->errorCode() . $pdoStatement->errorInfo();
            report($error);
            throw new Exception($error);
        }
    }

    static function genererUnDevisPourUneReservation($codeReservation) {
        $pdo = Data::init();
        $dateDuJour = Data::dateDuJourAuFormatTimestamp();
        $montantDevis = Data::calculMontantDevisDeLaReservation($codeReservation);
        $nbContainers = Data::nombreDeContainersDeLaReservation($codeReservation);
        $pdoStatement = $pdo->prepare(Data::$requete_genererUnDevisPourUneReservation);
        $pdoStatement->bindParam(":dateDuJour", $dateDuJour);
        $pdoStatement->bindParam(":montantDevis", $montantDevis);
        $pdoStatement->bindParam(":nbContainers", $nbContainers);
        $pdoStatement->execute();
        if ($pdoStatement == false) {
            $error = $pdoStatement->errorCode() . $pdoStatement->errorInfo();
            report($error);
            throw new Exception($error);
        }
        $codeDevis = $pdo->lastInsertId();
        Data::associerReservationAuDevis($codeDevis, $codeReservation);
    }

    static private function associerReservationAuDevis($codeDevis, $codeReservation) {
        $pdo = Data::init();
        $pdoStatement = $pdo->prepare(Data::$requete_associerReservationAuDevis);
        $pdoStatement->bindParam(":codeDevis", $codeDevis);
        $pdoStatement->bindParam(":codeReservation", $codeReservation);
        $pdoStatement->execute();
        if ($pdoStatement == false) {
            $error = $pdoStatement->errorCode() . $pdoStatement->errorInfo();
            report($error);
            throw new Exception($error);
        }
    }

    static public function calculMontantDevisDeLaReservation($codeReservation) {
        $pdo = Data::init();
        $pdoStatement = $pdo->prepare(Data::$requete_calculMontantDevisDeLaReservation);
        $pdoStatement->bindParam(":codeReservation", $codeReservation);
        $pdoStatement->execute();
        if ($pdoStatement == false) {
            $error = $pdoStatement->errorCode() . $pdoStatement->errorInfo();
            report($error);
            throw new Exception($error);
        }
        $ligneDeResultat = $pdoStatement->fetch(PDO::FETCH_ASSOC);
        $montantDevis = $ligneDeResultat["montantDevis"];
        return $montantDevis;
    }

    static public function nombreDeContainersDeLaReservation($codeReservation) {
        $pdo = Data::init();
        $pdoStatement = $pdo->prepare(Data::$requete_nombreDeContainersDeLaReservation);
        $pdoStatement->bindParam(":codeReservation", $codeReservation);
        $pdoStatement->execute();
        if ($pdoStatement == false) {
            $error = $pdoStatement->errorCode() . $pdoStatement->errorInfo();
            report($error);
            throw new Exception($error);
        }
        $ligneDeResultat = $pdoStatement->fetch(PDO::FETCH_ASSOC);
        $nombreDeContainerDeLaReservation = $ligneDeResultat["nbContainer"];
        return $nombreDeContainerDeLaReservation;
    }

    static public function obtenirCollectionDevisDeUnUtilisateur($codeUtilisateur) {
        $pdo = Data::init();
        $pdoStatement = $pdo->prepare(Data::$requete_obtenirCollectionDevisDeUnUtilisateur);
        $pdoStatement->bindParam(":codeUtilisateur", $codeUtilisateur);
        $pdoStatement->execute();
        if ($pdoStatement == false) {
            $error = $pdoStatement->errorCode() . $pdoStatement->errorInfo();
            report($error);
            throw new Exception($error);
        }
        $collectionDevis = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        return $collectionDevis;
    }

    static public function confirmerDevis($codeDevis) {
        $pdo = Data::init();
        $pdoStatement = $pdo->prepare(Data::$requete_confirmerDevis);
        $pdoStatement->bindParam(":codeDevis", $codeDevis);
        $pdoStatement->execute();
        if ($pdoStatement == false) {
            $error = $pdoStatement->errorCode() . $pdoStatement->errorInfo();
            report($error);
            throw new Exception($error);
        }
    }

    static public function obtenirNombreDeReservationParMoisPourUnUtilisateur($codeUtilisateur) {
        $pdo = Data::init();
        $pdoStatement = $pdo->prepare(Data::$requete_nbReservationParMoisPourUnUtilisateur);
        $pdoStatement->bindParam(":codeUtilisateur", $codeUtilisateur);
        $pdoStatement->execute();
        if ($pdoStatement == false) {
            $error = $pdoStatement->errorCode() . $pdoStatement->errorInfo();
            report($error);
            throw new Exception($error);
        }
        $NombreDeReservationParMoisPourUnUtilisateur = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        return $NombreDeReservationParMoisPourUnUtilisateur;
    }

    static public function nombreDeReservationParPaysDeUnUtilisateur($codeUtilisateur){
        $pdo = Data::init();
        $pdoStatement = $pdo->prepare(Data::$requete_nombreDeReservationParPaysDeUnUtilisateur);
        $pdoStatement->bindParam(":codeUtilisateur", $codeUtilisateur);
        $pdoStatement->execute();
        if ($pdoStatement == false) {
            $error = $pdoStatement->errorCode() . $pdoStatement->errorInfo();
            report($error);
            throw new Exception($error);
        }
        $nombreDeReservationParPaysDeUnUtilisateur = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        return $nombreDeReservationParPaysDeUnUtilisateur;
    }
            


    static private function dateDuJourAuFormatTimestamp() {
        $date = new DateTime();
        return $date->getTimestamp();
    }

    static private $requete_nombreDeReservationParPaysDeUnUtilisateur = 
            "select COUNT(*) as nbReservationParPays ,p.nomPays,p.codePays from reservation r 
            join ville v on v.codeVille = r.codeVilleMiseDisposition
            join pays p on p.codePays = v.codePays
            join utilisateur u on u.code = r.codeUtilisateur
            where  u.code = :codeUtilisateur
            group by v.codePays";
    static private $requete_confirmerDevis = "update devis set valider = 1 where codeDevis = :codeDevis";
    static private $requete_obtenirCollectionDevisDeUnUtilisateur = "select *
                from devis d
                join reservation rs on rs.codeDevis = d.codeDevis
                join  utilisateur u on u.code = rs.codeUtilisateur
                join reserver r on r.codeReservation = rs.codeReservation
                join typeContainer t on t.numTypeContainer = r.numTypeContainer
                where rs.codeUtilisateur = :codeUtilisateur";
    static private $requete_nombreDeContainersDeLaReservation = "
                select sum(r.qteReserver) as nbContainer 
                from reservation rs
                join reserver r on r.codeReservation = rs.codeReservation
                where rs.codeReservation = :codeReservation ";
    static private $requete_calculMontantDevisDeLaReservation = "
                select  sum((DATE_FORMAT(FROM_UNIXTIME(`dateFinReservation`), '%d-%m-%Y')
                - DATE_FORMAT(FROM_UNIXTIME(`dateDebutReservation`), '%d-%m-%Y')) * r.qteReserver * tc.tarif ) as montantDevis
                from reservation rs
                join reserver r on r.codeReservation = rs.codeReservation
                join typeContainer t on t.numTypeContainer = r.numTypeContainer
                JOIN tarificationContainer tc on tc.numTypeContainer = t.numTypeContainer
                JOIN duree d on d.code = tc.codeDuree
                where rs.codeReservation = :codeReservation
                and tc.codeDuree = (select  DISTINCT
                                    CASE WHEN (DATE_FORMAT(FROM_UNIXTIME(`dateFinReservation`), '%d-%m-%Y')
                                        - DATE_FORMAT(FROM_UNIXTIME(`dateDebutReservation`), '%d-%m-%Y')) > 360 then  'ANNEE'
                                    WHEN (DATE_FORMAT(FROM_UNIXTIME(`dateFinReservation`), '%d-%m-%Y')
                                           - DATE_FORMAT(FROM_UNIXTIME(`dateDebutReservation`), '%d-%m-%Y')) > 90 then 'TRIMESTRE'
                                    ELSE 'JOUR'
                                    END as libelleDuree
                                    from reservation rs
                                     join reserver r on r.codeReservation = rs.codeReservation
                                     join typeContainer t on t.numTypeContainer = r.numTypeContainer
                                     JOIN tarificationContainer tc on tc.numTypeContainer = t.numTypeContainer
                                     JOIN duree d on d.code = tc.codeDuree
                                     where rs.codeReservation = :codeReservation
                                     )";
    static private $requete_obtenirCollectionReservationEtLigneDeReservationPourUnUtilisateur = "select 
                v.nomVille as villeDepart, 
                v2.nomVille as villeArrivee,
                rs.codeReservation,
                rs.dateDebutReservation,
                rs.numeroDeReservation,
                rs.dateFinReservation,
                rs.etat,
                rs.dateReservation,
                rs.volumeEstime,
                t.libelleTypeContainer,
                r.qteReserver
                from reservation rs
                join  utilisateur u on u.code = rs.codeUtilisateur
                join reserver r on r.codeReservation = rs.codeReservation
                join typeContainer t on t.numTypeContainer = r.numTypeContainer
                join ville v on v.codeVille = rs.codeVilleMiseDisposition
                join ville v2 on v2.codeVille = rs.codeVilleRendre
                where rs.codeUtilisateur = :codeUtilisateur
                    order by  etat asc ";
    static private $requete_obtenirCompteUtilisateur = "SELECT *  FROM utilisateur "
            . " WHERE login=:identifiant AND mdp=:motDePasse";
    static private $requete_obtenirCollectionLignesDeUneReservation = "select * from typeContainer t 
                join  reserver r on t.numTypeContainer = r.numTypeContainer
                join  reservation rs on r.codeReservation = rs.codeReservation 
                where r.codeReservation = :codeReservation";
    static private $requete_obtenirCollectionVille = "select * from ville ";
    static private $requete_obtenirCollectionTypeContainer = " select * from typeContainer";
    static private $requete_ajouterUneReservation = "insert into reservation (dateDebutReservation,dateFinReservation,dateReservation,"
            . "codeVilleMiseDisposition,codeVilleRendre,volumeEstime,codeUtilisateur) "
            . "values (:dateDebutReservation,:dateFinReservation,:dateReservation,:codeVilleMiseDisposition,"
            . ":codeVilleRendre,:volumeEstime,:codeUtilisateur) ";
    static private $requete_ajouterUneLigneDeReservation = "insert into reserver (codeReservation, numTypeContainer, qteReserver) "
            . "values (:codeReservation, :numTypeContainer, :qteReserver) ";
    static private $requete_confirmerReservation = "update reservation set etat = 'validee' where codeReservation = :codeReservation  ";
    private static $requete_obtenirReservationEncoursDeUnUtilisateur = "select 
                v.nomVille as villeDepart, 
                v2.nomVille as villeArrivee,
                rs.codeReservation,
                rs.dateDebutReservation,
                rs.numeroDeReservation,
                rs.dateFinReservation,
                rs.etat,
                rs.dateReservation,
                rs.volumeEstime,
                t.libelleTypeContainer,
                r.qteReserver
                from reservation rs
                join  utilisateur u on u.code = rs.codeUtilisateur
                join reserver r on r.codeReservation = rs.codeReservation
                join typeContainer t on t.numTypeContainer = r.numTypeContainer
                join ville v on v.codeVille = rs.codeVilleMiseDisposition
                join ville v2 on v2.codeVille = rs.codeVilleRendre
                where rs.codeUtilisateur = :codeUtilisateur
                    and rs.etat = 'enCours'
                ";
    static private $requete_supprimerUneReservation = "delete from reservation where codeReservation = :codeReservation";
    private static $requete_genererUnDevisPourUneReservation = "insert into devis (dateDevis,montantDevis,nbContainers)"
            . " values(:dateDuJour,:montantDevis,:nbContainers)";
    private static $requete_associerReservationAuDevis = "update reservation set codeDevis = :codeDevis where codeReservation = :codeReservation";
    private static $requete_nbReservationParMoisPourUnUtilisateur = "select COUNT(DATE_FORMAT(FROM_UNIXTIME(`dateDebutReservation`), '%m-%Y')) as nbReservationParMoisPourUnUtilisateur,
                DATE_FORMAT(FROM_UNIXTIME(`dateDebutReservation`), '%m-%Y') as moisAnneeDeReservation
                from reservation rs
                join  utilisateur u on u.code = rs.codeUtilisateur
                where u.code = :codeUtilisateur
                group by DATE_FORMAT(FROM_UNIXTIME(`dateDebutReservation`), '%m-%Y')";

}