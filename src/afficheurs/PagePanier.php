<?php

namespace mywishlist\afficheurs;

use mywishlist\db\ConnectionFactory;

class PagePanier extends Afficheur
{
    public function execute(): string
    {
        $db = ConnectionFactory::makeConnection();
        $html = "";
        if(isset($_SESSION['panier'])){
            $panier = unserialize($_SESSION['panier']);
        } else $panier = array();

        if(isset($_GET['add'])){
            $add = $_GET['add'];
            if(array_key_exists($add,$panier)){
                $panier[$add]++;
            } else $panier[$add]=1;
        }
        $_SESSION['panier']=serialize($panier);

        if(!empty($panier)){
            $where = "";
            $i=0;
            foreach ($panier as $index => $item) {
                $where = "id = ".$index;
                $i++;
                if(!($i-1<count($panier))){
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
                $html .= "<div><strong>$name</strong><br>Prix unitaire : $prix<br>Provenance : $lieu<br>Quantité : $qte <br><br>Prix total : $prixTot<br><a href='index.php?action=article&id=$id'><img class='image_pdt' src=\"src/img/$id.jpg\" alt=\"Image\"></div></a>";
            }
            $html.= "<h3> Prix total de la commande : $prixCommande </h3>";
        }
        else{
            $html .= "<p><h3>Votre panier est vide.</h3><br><a href=\"index.php?action=shopping\"><button type='button'>Parcourir le catalogue</button></a></p>";
        }



        return $html;
    }
}