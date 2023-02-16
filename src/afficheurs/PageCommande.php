<?php

namespace mywishlist\afficheurs;

use mywishlist\db\ConnectionFactory;

class PageCommande extends Afficheur
{
    public function execute(): string{
        $html = "";
        //vérifier que la personne soit connecté
        if(isset($_SESSION['user'])){
            $db = ConnectionFactory::makeConnection();
            if(isset($_COOKIE['panier'])){
                $panier = unserialize($_COOKIE['panier']);
                $req = $db->prepare("select idcommande from commandes order by idcommande DESC");
                $req->execute();
                $fe = $req->fetch();
                if($fe!=false){
                    $idcommande = $fe['idcommande'];
                } else {
                    $idcommande = 1;
                }
                foreach ($panier as $idproduit => $qte) {
                    $req = $db->prepare("insert into commandes values (?,?,?,?,?)");
                    $usr = unserialize($_SESSION['user']);
                    $logi = $usr->login;
                    $reque = $db->prepare(
                        "SELECT email FROM user WHERE login = ?"
                    );
                    $reque->execute([$logi]);
                    $email = $reque->fetch();
                    $req->bindParam(1,$idcommande);
                    $req->bindParam(2,$logi);
                    $req->bindParam(3,$email['email']);
                    $req->bindParam(4,$idproduit);
                    $req->bindParam(5,$qte);
                    $req->execute();
                }
                $html.="<div class=\"undertitre\"><h3>Votre commande a été enregistrée.</h3> <br>".
                    "<p>Merci de faire confiance à Court-Circuit Voltaire ! </p>".
                    "<a href=\"index.php?\"><button type='button'>Retour à la page principale</button></a></div>";
            }
        }
        //sinon on redirige
        else {
            $html .= "<div class=\"undertitre\"><h3>Vous n'êtes pas actuellement connecté.</h3> <br>".
            "<p>Veuillez vous connecter, puis retourner sur le panier.</p>".
            "<a href=\"index.php?action=connexion\"><button type='button'>Se connecter</button></a></div>";
        }

        return $html;
    }
}