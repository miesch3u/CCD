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
        $html = "<div style='display: flex;justify-content: space-around; flex-direction: row; flex-wrap: wrap'>";
        $req = $this->db->prepare("SELECT id,nom,prix,lieu from produit");
        $req->execute();
        while($row = $req->fetch()){
            //Création des articles
            $id = $row['id'];
            $name = $row['nom'];
            $prix = $row['prix'];
            $lieu =$row['lieu'];
            $html.="<strong>$name</strong><br>Prix : $prix<br>Provenance : $lieu<img src=\"$id.jpg\" alt=\"Image\">";

        }


        $html .="</div>";
        $html.= "<button id='recherche'type='button'>rechercher</button>";

        return $html;
    }
}