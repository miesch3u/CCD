<?php

namespace mywishlist;
use mywishlist\afficheurs\PageAcceuil;

class Dispatcher
{
    private string $action;

    /**
     * @param string $action
     */
    public function __construct(string $action){
        $this->action = $action;
    }

    /**
     * Méthode qui effectue l'action adaptée
     * @return void
     */
    public function run():void{
        $res = "";
        switch ($this->action){
            //Connexion
            case "connexion":
                $act = new PageConnexion();
                break;
            //Shopping
            case "shopping":
                $act = new PageShopping();
                break;
            //Article
            case "article":
                $act = new PageArticle();
                break;
            //Panier
            case "panier":
                $act = new PagePanier();
                break;
            //Commande
            case "commande":
                $act = new PageCommande();
                break;
            //Profil
            case "profil":
                $act = new PageProfil();
                break;
            case "inscription":
                $act = new PageInscription();
                break;
            case "carte":
                $act = new PageCarte();
                break;
            case "information":
                $act = new PageInformation();
                break;
            //sinon ici c'est la page d'accueil
            default :
                $act = new PageAcceuil();

        }
        $res = $act->execute();
        $this->renderPage($res);
    }

    /**
     * Méthode qui effectue un rendu de la page
     * @param String $html
     * @return void, sachant que le rendu est écrit sur la page
     */
    private function renderPage(String $html) : void {
        $res = <<<END
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <title>Court-Circuit Voltaire</title>
        </head>
        <header>
        
        </header>
        <body class="">
        END;

        $res .= $html;

        $res .= "</body>
        </html>";
        echo $res;
    }
}