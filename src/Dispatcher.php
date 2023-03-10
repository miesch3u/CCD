<?php


namespace mywishlist;

use mywishlist\afficheurs\PageAccueil;
use mywishlist\afficheurs\PageAdmin;
use mywishlist\afficheurs\PageArticle;
use mywishlist\afficheurs\PageCarte;
use mywishlist\afficheurs\PageCommande;
use mywishlist\afficheurs\PageConnexion;
use mywishlist\afficheurs\PageDeco;
use mywishlist\afficheurs\PageEditArticle;
use mywishlist\afficheurs\PageInformation;
use mywishlist\afficheurs\PageInscription;
use mywishlist\afficheurs\PageNewArticle;
use mywishlist\afficheurs\PagePanier;
use mywishlist\afficheurs\PageProfil;
use mywishlist\afficheurs\PageShopping;
use mywishlist\Auth\Authentification;
use mywishlist\db\ConnectionFactory;
use mywishlist\Exceptions\AccessControlException;

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
                case "admin":
                    $act = new PageAdmin();
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
            case "newArticle":
                $act = new PageNewArticle();
                break;
            case "editArticle":
                $act = new PageEditArticle();
                break;
            case "deco":
               $act = new PageDeco();
                break;
            default :
                $act = new PageAccueil();

        }
        $res .= $act->execute();
        $this->renderPage($res);
    }

    /**
     * Méthode qui effectue un rendu de la page
     * @param String $html
     * @return void, sachant que le rendu est écrit sur la page
     */
    private function renderPage(String $html) : void {
        $res = "<!DOCTYPE html>
        <html lang='fr' xmlns='http://www.w3.org/1999/html'>
        <head>
            <meta charset='UTF-8'>
            <title>Court-Circuit Voltaire</title>
            <script src='src/javascript/le_Js.js' defer></script>
            <link rel='stylesheet' href='src/css/base.css' />
        </head>
        <header class='font'>
        <a class='gros' href='index.php'>Court-Circuit Voltaire</a>
        <a href='index.php?action=connexion'>Connexion</a>
        <a href='index.php?action=shopping'>Shopping</a>
        <a href='index.php?action=panier'>Panier</a>
        <a href='index.php?action=commande'>Commande</a>
        <a href='index.php?action=profil'>Profil</a>
        <a href='index.php?action=inscription'>Inscription</a>
        <a href='index.php?action=carte'>Carte</a>
        <a href='index.php?action=information'>Information</a>";
        if (isset($_SESSION['user'])) if (unserialize($_SESSION['user'])->__get('role')>1) {
            $res.="<a href='index.php?action=admin'>admin</a>";
        }
            $res.="</header>
        <body class='corp'>";

        $res .= $html;

        $res .= "</body>
        </html>";
        echo $res;
    }
}