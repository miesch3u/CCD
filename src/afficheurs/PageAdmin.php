<?php

namespace mywishlist\afficheurs;


use mywishlist\db\ConnectionFactory;

class PageAdmin extends Afficheur
{

    public function execute(): string
    {
        $db = ConnectionFactory::makeConnection();
        $sql = "select nom,prenom,email,telephone, role from user where role > 0";
        $st = $db->prepare($sql);
        $st->execute();

        $user = unserialize($_SESSION['user']);
        $j = $user->role;

        if ($j > 0) {
            $res = '<h1 class="connexion">Page d\'administration</h1>';

            while ($row = $st->fetch()) {
                //Création des articles
                $id = $row['nom'];
                $name = $row['prenom'];
                $prix = $row['email'];
                $lieu = $row['role'];

                $res .= <<<END
                <label for="id">Prenom $id</label>
                <label for="name">Nom $name</label>
                <label for="prix">Email $prix</label>
                <label for="lieu">Role $lieu</label>
                <br/>
END;
            }
        } else {
            $res = "Vous n'avez pas les droits pour accéder à cette page";
        }

        return $res;
    }
}