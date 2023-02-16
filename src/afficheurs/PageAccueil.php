<?php

namespace mywishlist\afficheurs;

class PageAccueil extends Afficheur
{

    public function execute(): string
    {
        return "<div class=\"taille\">
</div>
<div class=\"pack\">
<img class= \"objet image\" src=\"src/img/8.jpg\" alt=\"Logo\">
<div class=\"objet rectangle\"></div>
<h1 class =\"objet titretexte\"> Pour aider vos éleveur favoris</h1>
<p class =\"objet soustexte\"> PTDR</p>
</div>
<div class=\"pack1\">
<img class= \"objet image1\" src=\"src/img/8.jpg\" alt=\"Logo\">
<div class=\"objet rectangle1\"></div>
<h1 class =\"objet titretexte1\"> Pour aider vos éleveur favoris</h1>
<p class =\"objet soustexte1\"> PTDR</p>
</div>
<div class=\"pack2\">
<img class= \"objet image\" src=\"src/img/8.jpg\" alt=\"Logo\">
<div class=\"objet rectangle\"></div>
<h1 class =\"objet titretexte\"> Pour aider vos éleveur favoris</h1>
<p class =\"objet soustexte\"> PTDR</p>
</div>
<div class=\"pack3\">
<img class= \"objet image1\" src=\"src/img/8.jpg\" alt=\"Logo\">
<div class=\"objet rectangle1\"></div>
<h1 class =\"objet titretexte1\"> Pour aider vos éleveur favoris</h1>
<p class =\"objet soustexte1\"> PTDR</p>
</div>
";
    }
}
