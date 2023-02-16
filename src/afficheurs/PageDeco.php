<?php

namespace mywishlist\afficheurs;

class PageDeco extends Afficheur
{
    public function execute(): string
    {
        session_destroy();
        return "<p class=\"connexion2\">Vous êtes déconnecté</p>";
    }

}