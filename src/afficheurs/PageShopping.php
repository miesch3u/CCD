<?php

namespace mywishlist\afficheurs;
use mywishlist\db\ConnectionFactory;

class PageShopping extends Afficheur
{
    public function __construct()
    {
        parent::__construct();
        $this->db = ConnectionFactory::makeConnection();
    }

    public function execute(): string
    {
        $html = "<div style='display: flex; flex-direction: column'><div style='display: flex; flex-direction: row'><button id='rech'type='button'>Rechercher</button>"
            ."<select id='filter'><option value='0'>Filtrer</option><option value='1'>Confiseries</option><option value='2'>Boissons</option>"
            ."<option value='3'>Hygiène</option><option value ='4'>Cosmetique</option><option value='5'>Fromages et pâtés</option></select></div>"
            ."<section style='display: flex;justify-content: space-around; flex-direction: column; flex-wrap: wrap'>";
        $req = $this->db->prepare("SELECT id,nom,prix,lieu from produit");
        $req->execute();
        while($row = $req->fetch()){
            //Création des articles
            $id = $row['id'];
            $name = $row['nom'];
            $prix = $row['prix'];
            $lieu =$row['lieu'];
            $html.="<div><strong>$name</strong><br>Prix : $prix<br>Provenance : $lieu<a href='index.php?action=article&id=$id'><img class='image_pdt' src=\"src/img/$id.jpg\" alt=\"Image\"></div></a>";
        }


        $html .="</section>";
        $html.= "</div>";

        return $html;
    }
}