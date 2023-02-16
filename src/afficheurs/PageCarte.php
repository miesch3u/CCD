<?php

namespace mywishlist\afficheurs;

class PageCarte extends Afficheur
{
    public function execute(): string
    {
        return "
<div class=\"cartegros\">
        <h3 class=\"carte\">Carte des produits</h3>
        <iframe src=\"https://www.google.com/maps/d/embed?mid=1aT4LfHwMjCIJRPvV15FnUlNlVvAOr3Q&ehbc=2E312F\" width=\"640\" height=\"480\"></iframe>
        <p class=\"textcarte\">
        Retrouver tout vos produit préféré à porter de chez vous.
        </p>
        </div>
        ";
    }
}