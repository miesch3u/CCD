<?php

namespace mywishlist\afficheurs;

use mywishlist\afficheurs\Afficheur;
use mywishlist\Auth\Authentification;
use mywishlist\User\User;


class PageConnexion extends Afficheur
{
    public function execute(): string
    {
        if ($this->http_method == 'POST') {
            $res = '';
            //on recupere les donnees du formulaire dans le cas ou on veut se connecter
            if (isset($_POST['login']) and isset($_POST['pwd'])) {
                $login = filter_var($_POST['login'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
                $user = Authentification::authenticate($login, $_POST['pwd']);
                if (isset($_SESSION['user'])) {
                        Authentification::checkAccessLevel(USER::NORMAL_USER);
                        $res = " Bienvenu ! $login";
                }else {
                    $res = "L'authentification a échoué";
                }

                //on gere aussi le cas ou le mot de passe a ete oublie
            }

        } else {
            //on affiche le formulaire de connexion
            setcookie('mdpchangement');
            $res = <<<END
            <h1 class="connexion">Connexion</h1>
            <form class="slot"  action="?action=connexion" method="post">
                <input class="underslot" type="text" name="login" placeholder="login"><br>
                <input class="underslot" type="password" name="pwd" placeholder="password"><br>
                <input class="buttonslot" type="submit" value="Se connecter"><br>
            </form>
            <div id="redirection">
                <p class="aligner">Toujours pas inscrit ? <a class="nommer2" href="?action=inscription">Inscrivez-vous !</a></p>
            </div>
            END;
        }
        return $res;
    }

}