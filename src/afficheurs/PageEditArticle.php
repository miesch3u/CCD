<?php

namespace mywishlist\afficheurs;

use mywishlist\db\ConnectionFactory;

class PageEditArticle extends Afficheur
{

    public function execute(): string
    {
        if (!isset($_SESSION['user'])) return "<div class='titretexte'>droits insuffisants</div>>";
        else if (unserialize($_SESSION['user'])->__get('role') == 0) return "<div class='titretexte'>droits insufifsants</div>>";
        $html = "";
        $db = ConnectionFactory::makeConnection();
        $id = $_GET['id'];
        $querry = "delete from produit where id = ?";
        $req = $db->prepare($querry);
        $req->execute([$id]);
        $html .= "<div class='connexion2'>article supprimé</div>";
        return $html;
    }
}