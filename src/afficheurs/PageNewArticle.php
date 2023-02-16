<?php

namespace mywishlist\afficheurs;

use mywishlist\db\ConnectionFactory;

class PageNewArticle extends Afficheur
{

    public function execute(): string
    {
        if (!isset($_SESSION['user']))  return "<div class='titretexte'>droits insuffisants</div>>";
        else if (unserialize($_SESSION['user'])->__get('role')<=1) return "<div class='titretexte'>droits insuffisants</div>>";
        $html = "";
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $cat = $_POST['cat'];
            $db = ConnectionFactory::makeConnection();
            $req = $db->prepare("select * from produit where id >= all(select id from produit)");
            $req->execute();
            $row = $req->fetch();
            $id = $row['id'];
            $querry = "insert into produit values"
                . "($id+1, $cat,'{$_POST['nomProd']}', {$_POST['prixProd']}"
                . ", {$_POST['poidProd']}, '{$_POST['descProd']}', '{$_POST['detProd']}','{$_POST['lieuxProd']}'"
                . ",{$_POST['distProd']}, {$_POST['latProd']}, {$_POST['longProd']})";
            $q = $db->prepare($querry);
            $q->execute();
            $req = $db->prepare("SELECT id,nom,prix,lieu from produit where id = ?");
            $req->execute([$id]);
            $row = $req->fetch();
            $id = $row['id'];
            $name = $row['nom'];
            $prix = $row['prix'];
            $lieu = $row['lieu'];
            /*$tmpName = $_FILES['file']['tmp_name'];
            $array = explode('.', $_FILES['file']['name']);
            $ext = end($array);
            var_dump($_FILES);
            move_uploaded_file($tmpName, '/src/img' . "$id+$ext");*/
            $html .= "<div><strong>$name</strong><br>Prix : $prix<br>Provenance : $lieu<a href='index.php?action=article&id=$id'><img class='image_pdt' src=\"src/img/$id.jpg\" alt=\"Image\"></div></a>";


            $html .= "<a href='?action=newArticle'><button type='submit'>créer un autre article</button> </form>";
        } else {
            $html .= "<form method='post'><div style='display: flex; flex-direction: column'>";
            $html .= "<div class=\"connexion3\">catégorie du produit : <select id='cat' name='cat'><option value='1'>Confiseries</option><option value='2'>Boissons</option>"
                . "<option value='3'>Hygiène</option><option value ='4'>Cosmetique</option><option value='5'>Fromages et pâtés</option></select></div>";
            $html .= "<div class=\"connexion3\">nom du produit :<input id='nomProd' name='nomProd'></div> ";
            $html .= "<div class=\"connexion3\">prix du produit : <input id='prixProd' type='number' name='prixProd'></div> ";
            $html .= "<div class=\"connexion3\">poids du produit (0 pour vrac) : <input type='number' name='poidProd'></div> ";
            $html .= "<div class=\"connexion3\">description du produit : <textarea name='descProd' placeholder='description'></textarea></div> ";
            $html .= "<div class=\"connexion3\">details du produit : <textarea name='detProd' placeholder='detail'></textarea></div> ";
            $html .= "<div class=\"connexion3\">lieux du produit :<input name='lieuxProd'></div> ";
            $html .= "<div class=\"connexion3\">distance du produit :<input type='number' name='distProd'></div> ";
            $html .= "<div class=\"connexion3\">latitude du produit :<input type='number' name='latProd'></div> ";
            $html .= "<div class=\"connexion3\">longitude du produit :<input type='number' name='longProd'></div> ";
            //$html .= "<div>image du produit :<input type='file' id='file' name='file'/></div> ";
            $html .= "<div class=\"aligner\"><button class=\"buttonslot\" name='btnVal' type='submit'>valider</button></div></div></form>";
        }

        return $html;
    }
}