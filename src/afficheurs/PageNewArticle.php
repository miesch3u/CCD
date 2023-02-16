<?php

namespace mywishlist\afficheurs;

class PageNewArticle extends Afficheur
{

    public function execute(): string{
        $html = "";
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $html = "<form method='get'><button type='submit'>créer un autre article</button> </form>";
        }
        else {
            $html .= "<form method='post'><div style='display: flex; flex-direction: column'>";
            $html .= "<select id='cat'><option value='0'>categorie</option><option value='1'>Confiseries</option><option value='2'>Boissons</option>"
                . "<option value='3'>Hygiène</option><option value ='4'>Cosmetique</option><option value='5'>Fromages et pâtés</option></select>";
            $html .= "<div>nom du produit :<input id='nomProd'></div> ";
            $html .= "<div>prix du produit : <input type='number' id='prixProd'></div> ";
            $html .= "<div>poids du produit (0 pour vrac) : <input type='number' id='poidProd'></div> ";
            $html .= "<div>description du produit : <textarea id='descProd' placeholder='description'></textarea></div> ";
            $html .= "<div>details du produit : <textarea id='detProd' placeholder='detail'></textarea></div> ";
            $html .= "<div>lieux du produit :<input id='lieuxProd'></div> ";
            $html .= "<div>distance du produit :<input type='number' id='distProd'></div> ";
            $html .= "<div>latitude du produit :<input type='number' id='latProd'></div> ";
            $html .= "<div>longitude du produit :<input type='number' id='longProd'></div> ";
            $html .= "<div>image du produit :<input type='image' id='imgProd'></div> ";
            $html .= "<button id='btnVal' type='submit'>valider</button></div></form>";
        }

        return $html;
    }
}