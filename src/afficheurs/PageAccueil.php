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
<h1 class =\"objet titretexte\">Choisissez Bio</h1>
<p class =\"objet soustexte\">Plus de 100 produits fait par vos commerçants préférés dans vos alentours prêt à vous fournir vos produits favoris</p>
</div>
<div class=\"pack1\">
<img class= \"objet image1\" src=\"src/img/3.jpg\" alt=\"Logo\">
<div class=\"objet rectangle1\"></div>
<h1 class =\"objet titretexte1\">Vos produit favoris </h1>
<p class =\"objet soustexte1\"> Des produits phares comme les pots de pâte à tartiner de la marque L'or et Nuts</p>
</div>
<div class=\"pack2\">
<img class= \"objet image\" src=\"src/img/6.jpg\" alt=\"Logo\">
<div class=\"objet rectangle\"></div>
<h1 class =\"objet titretexte\"> 100% bio et fait maison</h1>
<p class =\"objet soustexte\"> Chaque grain de votre café est cultivé et récolté avec l'amour de vos producteurs et éleveurs proche de chez vous</p>
</div>
<div class=\"pack3\">
<img class= \"objet image1\" src=\"src/img/11.jpg\" alt=\"Logo\">
<div class=\"objet rectangle1\"></div>
<h1 class =\"objet titretexte1\"> Et pas que la nourriture</h1>
<p class =\"objet soustexte1\"> Mais des produits comme le savon, déodorant, bougie et bien plus encore vous attends ici</p>
</div>
";
    }
}
