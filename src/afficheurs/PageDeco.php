<?php

namespace mywishlist\afficheurs;

class PageDeco extends Afficheur
{
    public function execute(): string
    {
        session_destroy();
        return "Vous êtes déconnecté";
    }

}