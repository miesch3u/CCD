<?php

namespace mywishlist\afficheurs;
use mywishlist\afficheurs\Afficheur;
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
        $html = "<div style='display: flex; flex-direction: row'><button id='rech'type='button'>rechercher</button>"
            ."<section style='display: flex;justify-content: space-around; flex-direction: column; flex-wrap: wrap'>";
        $req = $this->db->prepare("SELECT id,nom,prix,lieu from produit");
        $req->execute();
        while($row = $req->fetch()){
            //Création des articles
            $id = $row['id'];
            $name = $row['nom'];
            $prix = $row['prix'];
            $lieu =$row['lieu'];
            $html.="<div><strong>$name</strong><br>Prix : $prix<br>Provenance : $lieu<img class='image_pdt' src=\"src/img/$id.jpg\" alt=\"Image\"></div>";

        }


        $html .="</section>";
        $html.= "</div>";

        return $html;
    }
}