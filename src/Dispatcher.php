<?php

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
            <title>NetVOD</title>
            
            <link rel="icon" type="image/png" sizes="64x64" href="src/Styles/img/favicon.ico">           
            <link rel="stylesheet" href="src/Styles/CSS/tailwind.css"/>
            <link rel="stylesheet" href="src/Styles/CSS/Catalogue.css"/>
        </head>
        <body class="">
        <header class=" text-gray-300 bg-gray-800 flex flex-row justify-between py-8 shadow-2xl mb-4 "  ">
        <div class="  mx-8 ">
            <a href="?action=accueil-utilisateur"><img class='' src="src/Styles/img/Petitlogo.png" width="10%"></a>
        </div>
        <div class="flex flex-row mx-8 ">
            <div class="justify-start mx-8 "> 
            <a href="?action=afficher-catalogue"><button class="rounded-2xl hover:bg-gray-300 hover:text-gray-800 m-2 p-1 px-3 h-full ">Catalogue</button></a>

            </div>
            <div  class=""> 
               <a href="?action="><button class="rounded-2xl hover:bg-gray-300 hover:text-gray-800 m-2 p-1 px-3 h-full ">Se déconnecter</button></a>
            </div>
        </div>
        </header>
        END;

        $res .= $html;

        $res .= "</body>
        </html>";
        echo $res;
    }
}