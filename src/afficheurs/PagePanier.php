<?php

namespace mywishlist\afficheurs;
use mywishlist\afficheurs\Afficheur;

class PagePanier extends Afficheur
{
    public function execute(): string
    {
        return "ici c'est un panier yeee";
    }
}