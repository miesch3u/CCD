<?php
declare(strict_types=1);
namespace mywishlist\User;
use mywishlist\db\ConnectionFactory;
use mywishlist\Dispatcher;
use mywishlist\Auth\Authentification;
use \PDO;


class User
{
    const ADMIN_USER = 100;
    const NORMAL_USER = 1;
    const NO_USER = 0;
    private string $email;
    private string $nom;
    private string $login;
    private string $prenom;
    private string $password;
    private int $role;


    /**
     * Constructeur de la classe User
     */
    public function __construct(string $login, string $password)
    {
        $this->login = $login;

        $this->password = $password;
          $this->role = User::NORMAL_USER;
        $this->telephone = "";

        $this->update();
    }

    /**
     * Getter de la classe user
     */
    public function __get($attribut)
    {
        if (property_exists($this, $attribut)) {
            return $this->$attribut;
        }

    }

    public function __set($attribut, $valeur)
    {
        if (property_exists($this, $attribut)) {
            $this->$attribut = $valeur;
        }
        //else {
          //  throw new InvalidPropertyNameException($attribut);
       // }
    }

    /**
     * Methode permettant de mettre à jour les informations de l'utilisateur
     */
    public function update(): void
    {
        $db = ConnectionFactory::makeConnection();
        $req =$db->prepare(
            "SELECT nom, prenom, telephone FROM user WHERE login = :login"
        );
        $req->bindParam( ":login", $this->login, PDO::PARAM_STR);
        $req->execute();
        $result = $req->fetch();
        $this->nom = $result[0];
        $this->prenom = $result[1];
        $this->telephone = $result[2];


    }
}