<?php

namespace mywishlist\afficheurs;
use mywishlist\afficheurs\Afficheur;

class PageArticle extends Afficheur
{
    public function execute(): string
    {
        return "ici c'est l'article'";
    }
}