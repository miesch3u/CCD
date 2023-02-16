<?php

namespace mywishlist\afficheurs;

use mywishlist\db\ConnectionFactory;

class PageProfil extends Afficheur
{   public function execute(): string
{
    ConnectionFactory::makeConnection();
    $res = "";

    if (isset($_SESSION['user'])) {
        $user = unserialize($_SESSION['user']);
        $email = $user->email;
        if ($this->http_method == 'POST') {
            if (($_POST['nom']!="") || ($_POST['prenom']!="") ||($_POST['email']!="")) {
                $nom = filter_var($_POST['nom'], FILTER_SANITIZE_STRING);
                $ui = filter_var($_POST['prenom'], FILTER_SANITIZE_STRING);
                $id = filter_var($_POST['pref'], FILTER_SANITIZE_STRING);
                if ($nom  != "") {
                    $sql = ("update user set nom=? where email=?");
                    $st = ConnectionFactory::$db->prepare($sql);
                    $st->bindParam(1, $nom);
                    $st->bindParam(2, $email);
                    $st->execute();
                    //on met a jour l'objet user
                    $user->nom = $nom;
                    $res = "Changement profil effecuté";
                }

                if ($ui != "") {
                    $sqll = ("update user set prenom=? where email=?");
                    $st = ConnectionFactory::$db->prepare($sqll);
                    $st->bindParam(1, $ui);
                    $st->bindParam(2, $email);
                    $st->execute();
                    //on met a jour l'objet user
                    $user->prenom = $ui;
                    $res = "Changement profil effecuté";
                }

                if ($id != "") {
                    $sqlo = ("select id_genre from genre where libelle_genre=?");
                    $st = ConnectionFactory::$db->prepare($sqlo);
                    $st->bindParam(1, $id);
                    $st->execute();
                    $row = $st->fetch();
                    $ids = $row["id_genre"];

                    $sqla = ("update user set id_genre=? where email=?");
                    $st = ConnectionFactory::$db->prepare($sqla);
                    $st->bindParam(1, $ids);
                    $st->bindParam(2, $email);
                    $st->execute();
                    $res = "Changement profil effecuté";
                }

            }else{
                $res="Veuillez au minimum rentrer une information" ;
            }

            //on met l'objet user a jour dans la session
            $_SESSION['user'] = serialize($user);

        } else {
            $res = <<<END
                <form action="?action=display-profil" method="POST">
                    <label for="nom">Nom</label>
                    <input type="text" name="nom" placeholder="Votre nom" value="$user->nom"><br>
                    <label for="prenom">Prenom</label>
                    <input type="text" name="prenom" placeholder="Votre prenom" value="$user->prenom"><br>
                    <input type="email" name="email" placeholder="Votre email" value="$user->email"><br>
                    <input type="submit" value="valider">
                </form>
                <form action="?action=deco" method="POST">
                    <input type="submit" value="Se déconnecter">
                </form>
                END;

        }
    }else{
        $res="<button><a href='?action=connexion'>Veuillez-vous connecter !</a></button>";
    }
    return $res;
}
}

