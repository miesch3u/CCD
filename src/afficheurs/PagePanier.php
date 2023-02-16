<?php

namespace mywishlist\afficheurs;

use mywishlist\db\ConnectionFactory;

class PagePanier extends Afficheur
{
    public function execute(): string
    {
        $db = ConnectionFactory::makeConnection();
        $html = "";
        if(isset($_COOKIE['panier'])){
            $panier = unserialize($_COOKIE['panier']);
        } else $panier = array();

        if(isset($_GET['add'])){
            $add = $_GET['add'];
            if(array_key_exists($add,$panier)){
                $panier[$add]++;
            } else $panier[$add]=1;
            setcookie("panier",serialize($panier));
        }

        if(!empty($panier)){
            $where = "";
            $i=0;
            foreach ($panier as $index => $item) {
                $where .= "id = ".$index;
                $i++;
                if(($i<count($panier))){
                    $where .= " or ";
                }
            }
            $req = $db->prepare("SELECT id,nom,prix,lieu from produit where ".$where);
            $req->execute();
            $prixCommande = 0;
            while ($row = $req->fetch()) {
                //Création des articles
                $id = $row['id'];
                $name = $row['nom'];
                $prix = $row['prix'];
                $lieu = $row['lieu'];
                $qte = $panier[$id];
                $prixTot = $prix*$qte;
                $prixCommande += $prixTot;
                $html .= "<div class=\"undertitre\"><strong>$name</strong><br>Prix unitaire : $prix €<br>Provenance : $lieu<br>Quantité : $qte <br><br>Prix total : $prixTot €<br><a href='index.php?action=article&id=$id'><img class='image_pdt2' src=\"src/img/$id.jpg\" alt=\"Image\"></a></div>";
            }
            $html.= "<div class=\"undertitre\"><h3> Prix total de la commande : $prixCommande €</h3>  <a href=\"index.php?action=shopping\"><button type='button'>Continuer vos achats</button></a><a href=\"index.php?action=commande\"><button type='button'>Valider et payer</button></a> </div>";
        }
        else{
            $html .= "<p><h3>Votre panier est vide.</h3><br><a href=\"index.php?action=shopping\"><button type='button'>Parcourir le catalogue</button></a></p>";
        }



        return $html;
    }
}