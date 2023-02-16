<?php
declare(strict_types=1);
namespace mywishlist\Auth;
use mywishlist\db\ConnectionFactory;
use mywishlist\User\User;



//Classe Auth
class Authentification
{

    //Methode permettant de savoir si un email est disponible
    public static function emailLibre($email): bool
    {
        $db = ConnectionFactory::makeConnection();
        $req = $db->prepare(
            "SELECT email FROM user WHERE email ='$email'"
        );
        $req->execute();
        $result = $req->fetch();
        return empty($result);
    }

    /**
     * Permet de verifier si l'utilisateur a les droits suffisants pour acceder a la page
     */
    public static function checkAccessLevel(int $required): void
    {
        $userLevel = (int)unserialize($_SESSION['user'])->role;
        //  if ($userLevel < $required){
        //    throw new AccessControlException("Action non autorisée : droits insuffisants");
        //}
    }

    /**
     * methode permettant d'authentifier un utilisateur
     * d'en creer l'objet et de le stocker dans la session
     * @param string $email
     * @param string $password
     * @return User|null
     */
    public static function authenticate(string $login, string $password): ?User
    {
        if (!filter_var($login, FILTER_SANITIZE_STRING)) return null;
        $res = null;
        $db = ConnectionFactory::makeConnection();
        $req = $db->prepare(
            "SELECT passwd, role FROM user WHERE login ='$login'"
        );

        $req->execute();
        $result = $req->fetch();
        if (!self::loginLibre($login)) {
            if (password_verify($password, $result[0])) {
                $res = new User($login, $password, $result[1]);
                $_SESSION['user'] = serialize($res);
            }
        }
        return $res;
    }

    /**
     * Methode permettant de s'enregistrer dans la base de données
     * @param string $email
     * @param string $password
     * @return bool
     */
    public static function register(string $login,string $email, string $password, string $nom, string $prenom, int $telephone): bool
    {
        //On verifie que l'email est valide. Si ce n'est pas le cas, on retourne false
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return false;
        //On verifie que le mot de passe fait au moins 10 caractères. Si ce n'est pas le cas, on retourne false
        if (strlen($password) < 10) {
            return false;
        } else {
            //On verifie que l'email est libre. Si ce n'est pas le cas, on retourne false
            if (self::emailLibre($email) && self::loginLibre($login)) {
                $password = password_hash($password, PASSWORD_DEFAULT);
                //On insere l'utilisateur dans la base de données ainsi que son mot de passe
                $db = ConnectionFactory::makeConnection();
                $req = $db->prepare(
                    "INSERT INTO user (login,email, passwd, role,nom,prenom,telephone) VALUES (:login ,:email, :password, 0,:nom,:prenom,:telephone)"
                );
                $req->execute(array(
                    'login' => $login,
                    'email' => $email,
                    'password' => $password,
                    'nom' => $nom,
                    'prenom' => $prenom,

                    'telephone' => $telephone
                ));
                //On retourne true pour signifier que l'inscription a bien été effectuée
                return true;
            } else {
                return false;
            }
        }
        echo "L'enregistrement s'est mal déroulé";
        return false;
    }

    /**
     *Methode permettant de savoir si un login est libre
     */

    public static function loginLibre($login): bool
    {
        $db = ConnectionFactory::makeConnection();
        $req = $db->prepare(
            "SELECT login FROM user WHERE login ='$login'"
        );
        $req->execute();
        $result = $req->fetch();
        return empty($result);
    }
}

?>