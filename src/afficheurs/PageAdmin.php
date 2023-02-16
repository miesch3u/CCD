<?php

namespace mywishlist\afficheurs;


class PageAdmin extends Afficheur
{

    public function execute(): string
    {
        //Affichage de la liste des utilisateurs (administrateurs) : une page affiche la liste des
        //utilisateurs avec leur nom, ainsi qu’un lien pour chacun d’eux vers une description plus
        //complète. Cette liste est accessible uniquement aux administrateurs. Des liens vers les
        //actions menant aux fonctionnalités administrateurs implantées peuvent éventuellement être
        //ajoutés en regard de chaque utilisateur
        if (isset($_SESSION['user'])) {
            $login = $_SESSION['user'];
            $db = \mywishlist\db\ConnectionFactory::makeConnection();
            $req = $db->prepare("SELECT * FROM user where role >0");
            $req->execute();
            $result = $req->fetch();
            if ($result['role'] > 0) {
                $res = "<div class=\"container\">
        <div class=\"row\">
            <div class=\"col-12\">
                <h1 class=\"text-center\">Liste des utilisateurs</h1>
            </div>
        </div>
        <div class=\"row\">
            <div class=\"col-12\">
                <table class=\"table table-striped\">
                    <thead>
                        <tr>
                            <th scope=\"col\">Login</th>
                            $result = $req->fetchAll();
                            <th scope=\"col\">Email</th>
                            <th scope=\"col\">Role</th>
                            <th scope=\"col\">Action</th>
                        </tr>
                    </thead>
                    <tbody>";
                return $res;
            } else {
                return "Vous n'avez pas les droits pour accéder à cette page";
            }
        } else {
            return "Vous n'avez pas les droits pour accéder à cette page";
        }
        $db = \mywishlist\db\ConnectionFactory::makeConnection();
        $req = $db->prepare("SELECT * FROM user where role >0");
        $req->execute();
        $result = $req->fetchAll();
        $res = "<div class=\"container\">
        <div class=\"row\">
            <div class=\"col-12\">
                <h1 class=\"text-center\">Liste des utilisateurs</h1>
            </div>
        </div>
        <div class=\"row\">
            <div class=\"col-12\">
                <table class=\"table table-striped\">
                    <thead>
                        <tr>
                            <th scope=\"col\">Login</th>
                            <th scope=\"col\">Email</th>
                            <th scope=\"col\">Role</th>
                            <th scope=\"col\">Action</th>
                        </tr>
                    </thead>
                    <tbody>";
        foreach ($result as $user) {
            $res .= "<tr>
                        <td>" . $user['login'] . "</td>
                        <td>" . $user['email'] . "</td>
                        <td>" . $user['role'] . "</td>
                        <td><a href=\"?action=supprimer&login=" . $user['login'] . "\">Supprimer</a></td>
                    </tr>";
        }
        $res .= "</tbody>
                </table>
            </div>
        </div> 



    </div>";
        return $res;
    }
}