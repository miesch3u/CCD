<?php

namespace Natha\Ccd\afficheurs;

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

        }


        $html .="</div>";

        return $html;
    }
}