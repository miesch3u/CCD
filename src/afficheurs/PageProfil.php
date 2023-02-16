<?php

namespace mywishlist\afficheurs;

use mywishlist\db\ConnectionFactory;

class PageProfil extends Afficheur
{
    public function execute(): string
    {
        ConnectionFactory::makeConnection();
        $res = "";

        if (isset($_SESSION['user'])) {
            $user = unserialize($_SESSION['user']);
            if ($this->http_method == 'POST') {
                if (($_POST['nom'] != "") || ($_POST['prenom'] != "") || ($_POST['email'] != "") || ($_POST['telephone'] != "")) {
                    $nom = filter_var($_POST['nom'], FILTER_SANITIZE_STRING);
                    $prenom = filter_var($_POST['prenom'], FILTER_SANITIZE_STRING);
                    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                    $telephone = filter_var($_POST['telephone'], FILTER_SANITIZE_NUMBER_INT);
                    $login = $user->login;
                    if ($nom != "") {
                        $sql = ("update user set nom=? where login=?");
                        $db = ConnectionFactory::makeConnection();
                        $st = $db->prepare($sql);
                        $st->bindParam(1, $nom);
                        $st->bindParam(2, $login);
                        $st->execute();
                        //on met a jour l'objet user
                        $user->nom = $nom;
                        $res = "Changement profil effecuté";
                    }

                    if ($prenom != "") {
                        $sqll = ("update user set prenom=? where login=?");
                        $db = ConnectionFactory::makeConnection();
                        $st = $db->prepare($sqll);
                        $st->bindParam(1, $prenom);
                        $st->bindParam(2, $login);
                        $st->execute();
                        //on met a jour l'objet user
                        $user->prenom = $prenom;
                        $res = "Changement profil effecuté";
                    }

                    if ($email != "") {
                        $sqlo = ("update user set email=?  where login=?");
                        $db = ConnectionFactory::makeConnection();
                        $st = $db->prepare($sqlo);
                        $st->bindParam(1, $email);
                        $st->bindParam(2, $login);
                        $st->execute();

                        $user->email = $email;
                        $res = "Changement profil effecuté";
                    }

                    if ($telephone != "") {
                        $sqlll = ("update user set telephone=? where login=?");
                        $db = ConnectionFactory::makeConnection();
                        $st = $db->prepare($sqlll);
                        $st->bindParam(1, $telephone);
                        $st->bindParam(2, $login);
                        $st->execute();
                        //on met a jour l'objet user
                        $user->telephone = $telephone;
                        $res = "Changement profil effecuté";
                    }
                } else {
                    $res = "Veuillez au minimum rentrer une information";
                }

                //on met l'objet user a jour dans la session
                $_SESSION['user'] = serialize($user);

            } else {
                var_dump($user);
                $db = ConnectionFactory::makeConnection();
                $req = $db->prepare(
                    "SELECT email FROM user WHERE login = ?"
                );
                $req->execute([$user->login]);
                $result = $req->fetch();

                $db = ConnectionFactory::makeConnection();
                $req = $db->prepare(
                    "SELECT Telephone FROM user WHERE login = ?"
                );
                $req->execute([$user->login]);
                $resultt = $req->fetch();


                $res = <<<END
                <form action="?action=profil" method="POST" xmlns="http://www.w3.org/1999/html">
                    <label for="nom">Nom</label>
                    <input type="text" name="nom" placeholder="Votre nom" value="$user->nom"><br>
                    <label for="prenom">Prenom</label>
                    <input type="text" name="prenom" placeholder="Votre prenom" value="$user->prenom"><br>
                    <label for="email">Email</label>
                    <input type="email" name="email" placeholder="Votre email" value="$result[0]"><br>
                    <label for="telephone">Telephone</label>
                    <input type="text" name="telephone" placeholder="Votre telephone" value="$resultt[0]"><br>
                    <input type="submit" value="valider">
                </form>
                <form action="?action=deco" method="POST">
                    <input type="submit" value="Se déconnecter">
                </form>
                END;

            }
        } else {
            $res = "<div class=\"aligner2\"'><button class=\"panier4\"><a class=\"nommer\" href='?action=connexion'>Veuillez-vous connecter !</a></button><div>";
        }
        return $res;
    }
}

