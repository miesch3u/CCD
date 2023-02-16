<?php

namespace mywishlist\afficheurs;
use mywishlist\afficheurs\Afficheur;

class PageCarte extends Afficheur
{
    public function execute(): string
    {
        return "ici c'est la carte ";
    }
}