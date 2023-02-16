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
        $html = "<div style='display: flex; flex-direction: column'><div class=\"sticky\" style='display: flex; flex-direction: row'><button class=\"panier2\" id='rech'type='button'>Rechercher</button>"
            . "<input class=\"cafe2\" id='rechTxt'>"
            . "<select class=\"cafe\" id='filter'><option value='0'>Filtrer</option><option value='1'>Confiseries</option><option value='2'>Boissons</option>"
            . "<option value='3'>Hygiène</option><option value ='4'>Cosmetique</option><option value='5'>Fromages et pâtés</option></select>";
        if (true){// uniquement pour les admin mais c'est pas encore implémenté
            $html.="<a class=\"genoux\" href='?action=newArticle'><button class=\"panier3\" type='button'>nouvel article</button></a>";
            }
            $html.= "</div><section style='display: flex;justify-content: space-around; flex-direction: column; flex-wrap: wrap'>";
        $cond = "";
        if (isset($_GET['cat'])) {
            $cat = $_GET['cat'];
            $key = $_GET['key'];
            $cond = 'where ';
            if ($cat > 0) $cond .= " categorie = $cat and ";
            $cond .= "nom like '%$key%'";
        }
        $req = $this->db->prepare("SELECT id,nom,prix,lieu from produit " . $cond);
        $req->execute();
        while ($row = $req->fetch()) {
            //Création des articles
            $id = $row['id'];
            $name = $row['nom'];
            $prix = $row['prix'];
            $lieu = $row['lieu'];
            $html .= "<div class=\"undertitre\"><a class=\"nommer\" href='index.php?action=article&id=$id'><strong>$name</strong><br>Prix : $prix €<br><img class='image_pdt2' src=\"src/img/$id.jpg\" alt=\"Image\"></a><br>Provenance : $lieu</div>";
        }


        $html .= "</section>";
        $html .= "</div>";

        return $html;
    }
}