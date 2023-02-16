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
            if (isset($_POST['email'])& isset($_POST['pwd']) & isset($_POST['pwdd'])  & isset($_POST['Nom']) & isset($_POST['Prenom']) & isset($_POST['Telephone']) & isset($_POST['Login'])) {

                $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                $pss = $_POST['pwd'];
                $login = $_POST['Login'];
                $tele = $_POST['Telephone'];
                $nom = $_POST['Nom'];
                $prenom = $_POST['Prenom'];
                $password = $_POST['pwdd'];
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    return  "L'email n'est pas valide";
                }
                //On verifie que le mot de passe fait au moins 10 caractères. Si ce n'est pas le cas, on lance une exception
                if (strlen($password) < 10) {
                   return "Le mot de passe doit faire au moins 10 caractères";
                }
                //On verifie que l'email est libre. Si ce n'est pas le cas, on lance une exception
            if (!Authentification::emailLibre($email)) {
                 return "Email déjà utilisé.";
                }
                //On verifie que le login est libre. Si ce n'est pas le cas, on lance une exception
                if (!Authentification::loginLibre($login)) {
                  return "Login déjà utilisé.";
                }

                if ($password === $pss) {
                    if (Authentification::emailLibre($email) && Authentification::loginLibre($login)) {

                        if (Authentification::register($login,$email ,$pss, $nom, $prenom, $tele)) {
                            $track_user_code = uniqid();
                            setcookie("token", $track_user_code,
                                Time() + 60 * 60 * 24 * 365);


                            $res = "Bienvenu $login  votre compte a bien été créé ";

                        } else {
                            $res = "Pensez a mettre un mail valide et un mot de passe de plus de 10 caractères";
                        }
                    } else {
                        $res = "L'email ou le login est déjà utilisé";

                    }
                } else {
                    $res = "Les mots de passe sont differents";
                }
            } else {
                return "Veuillez remplir tous les champs";
            }

        } else {
            $res = <<<END
            <h1>Inscription</h1>
            <form action="?action=inscription" method="POST">
            
                <input type="text" name="Login" placeholder="Login"><br>
                <input type="text" name="Nom" placeholder="Nom"><br>
                <input type="text" name="Prenom" placeholder="Prenom"><br>
                <input type="email" name="email" placeholder="Email"><br>
                <input type="number" name="Telephone" placeholder="Telphone"><br>
                <input type="password" name="pwd" placeholder="password"><br>
                <input type="password" name="pwdd" placeholder="password"><br>
                <input type="submit" value="Inscription"><br>
            </form>
            <div id="redirection">
                <p>Déjà inscrit ? <a href="?action=connexion">Connectez-vous !</a></p>
            </div>
            END;

        }
        return $res;
    }


}