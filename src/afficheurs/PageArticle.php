<?php

namespace mywishlist\afficheurs;
use mywishlist\db\ConnectionFactory;

class PageArticle extends Afficheur
{
    public function __construct()
    {
        parent::__construct();
        $this->db = ConnectionFactory::makeConnection();
    }

    public function execute(): string
    {
        $html ="";
        $action = $_GET['id'];
        $req = $this->db->prepare("SELECT * from produit where id=?");
        $req->bindParam(1,$action);
        $req->execute();
        $row = $req->fetch();
        //Création des articles
        $id = $row['id'];
        $name = $row['nom'];
        $prix = $row['prix'];
        $lieu =$row['lieu'];
        $html.="<div><strong>$name</strong><br>Prix : $prix<br>Provenance : $lieu<img class='image_pdt' src=\"src/img/$id.jpg\" alt=\"Image\"></div>";

        return $html;
    }
}