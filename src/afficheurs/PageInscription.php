<?php

namespace mywishlist\afficheurs;
use Exception;
use mywishlist\Auth\Authentification;
use mywishlist\db\ConnectionFactory;

class PageInscription extends Afficheur
{
    public function execute(): string
    {
        $res = "";
        if ($this->http_method == 'POST') {
            if (isset($_POST['email']) and isset($_POST['pwd']) and isset($_POST['pwdd']) and isset($_POST['Nom']) and isset($_POST['Prenom']) and isset($_POST['Telephone']) and isset($_POST['Login'])) {
                $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                $pss = $_POST['pwd'];
                $login = $_POST['Login'];
                $tele = $_POST['Telephone'];
                $nom = $_POST['Nom'];
                $prenom = $_POST['Prenom'];
                $password = $_POST['pwdd'];
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    return  "<p class=\"connexion2\"> L'email n'est pas valide</p>";
                }
                //On verifie que le mot de passe fait au moins 10 caractères. Si ce n'est pas le cas, on lance une exception
                if (strlen($password) < 10) {
                   return "<p class=\"connexion2\"> Le mot de passe doit faire au moins 10 caractères</p>";
                }
                //On verifie que l'email est libre. Si ce n'est pas le cas, on lance une exception
            if (!Authentification::emailLibre($email)) {
                 return "<p class=\"connexion2\"> Email déjà utilisé.</p>";
                }
                //On verifie que le login est libre. Si ce n'est pas le cas, on lance une exception
                if (!Authentification::loginLibre($login)) {
                  return "<p class=\"connexion2\"> Login déjà utilisé.</p>";
                }

                if ($password === $pss) {
                    if (Authentification::emailLibre($email) && Authentification::loginLibre($login)) {

                        if (Authentification::register($login,$email ,$pss, $nom, $prenom, $tele)) {
                            $track_user_code = uniqid();
                            setcookie("token", $track_user_code,
                                Time() + 60 * 60 * 24 * 365);


                            $res = "<p class=\"connexion2\"> Bienvenu $login  votre compte a bien été créé </p>";

                        } else {
                            $res = "<p class=\"connexion2\"> Pensez a mettre un mail valide et un mot de passe de plus de 10 caractères</p>";
                        }
                    } else {
                        $res = "<p class=\"connexion2\"> L'email ou le login est déjà utilisé</p>";

                    }
                } else {
                    $res = "<p class=\"connexion2\"> Les mots de passe sont differents</p>";
                }
            } else {
                return "<p class=\"connexion2\"> Veuillez remplir tous les champs</p>";
            }

        } else {
            $res = <<<END
            <h1 class="connexion">Inscription</h1>
            <form class="slot" action="?action=inscription" method="POST">
            
                <input class="underslot" type="text" name="Login" placeholder="Login"><br>
                <input class="underslot" type="text" name="Nom" placeholder="Nom"><br>
                <input class="underslot" type="text" name="Prenom" placeholder="Prenom"><br>
                <input class="underslot" type="email" name="email" placeholder="Email"><br>
                <input class="underslot" type="number" name="Telephone" placeholder="Telphone"><br>
                <input class="underslot" type="password" name="pwd" placeholder="password"><br>
                <input class="underslot" type="password" name="pwdd" placeholder="password"><br>
                <input class="buttonslot" type="submit" value="Inscription"><br>
            </form>
            <div id="redirection">
                <p class="aligner">Déjà inscrit ? <a class="nommer2" href="?action=connexion">Connectez-vous !</a></p>
            </div>
            END;

        }
        return $res;
    }


}