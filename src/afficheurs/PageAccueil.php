<?php


namespace mywishlist\afficheurs;

class PageAccueil extends Afficheur
{

    public function execute(): string
    {
        return "<div class=\"rectangle\"></div>
<img class= \"image\" src=\"src/img/logorond.png\" alt=\"Logo\">
";
    }
}
