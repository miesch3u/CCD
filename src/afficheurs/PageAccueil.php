<?php

namespace mywishlist\afficheurs;

class PageAccueil extends Afficheur
{

    public function execute(): string
    {
        return "
<div class=\"pack\">
<img class= \"objet image\" src=\"src/img/8.jpg\" alt=\"Logo\">
<div class=\"objet rectangle\"></div>
<h1 class =\"objet titretexte\"> Pour aider vos éleveur favoris</h1>
<p class =\"objet soustexte\"> PTDR</p>
</div>
";
    }
}
