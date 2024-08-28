<?php
session_start();

class User {

    private $id;
    public $login;
    public $password;
    public $email;
    public $firstname;
    public $lastname;
    private $connexion_bdd; 

    public function __construct() {
        try {
            $this->connexion_bdd = new PDO('mysql:host=localhost;dbname=classes', 'root', '');
            $this->connexion_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Erreur de connexion : ' . $e->getMessage());
        }
    }

    public function register($login, $password, $email, $firstname, $lastname) {
        $inser = "SELECT id FROM utilisateurs WHERE login = :login";
        $insere = $this->connexion_bdd->prepare($inser);
        $insere->bindParam(':login', $login);
        $insere->execute();

        if ($insere->rowCount() > 0) {
            return "Ce login est déjà utilisé. Veuillez en choisir un autre";
        }

        $passwordhash = password_hash($password, PASSWORD_BCRYPT);

        $inser = "INSERT INTO utilisateurs (login, password, email, firstname, lastname) VALUES (:login, :password, :email, :firstname, :lastname)";
        $insere = $this->connexion_bdd->prepare($inser);
        $insere->bindParam(':login', $login);
        $insere->bindParam(':password', $passwordhash);
        $insere->bindParam(':email', $email);
        $insere->bindParam(':firstname', $firstname);
        $insere->bindParam(':lastname', $lastname);

        if ($insere->execute()) {
            $this->id = $this->connexion_bdd->lastInsertId();
            $_SESSION['user_id'] = $this->id;
            $this->login = $login;
            $this->password = $passwordhash;
            $this->email = $email;
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            return true;
        } else {
            return "Erreur lors de l'inscription. Veuillez réessayer.";
        }
    }

    public function login($login, $password) {
        $inser = "SELECT * FROM utilisateurs WHERE login = :login";
        $insere = $this->connexion_bdd->prepare($inser);
        $insere->bindParam(':login', $login);
        $insere->execute();

        $user = $insere->fetch(PDO::FETCH_ASSOC);

        if ($user !== false && password_verify($password, $user['password'])) {
            $this->id = $user['id'];
            $this->login = $user['login'];
            $this->email = $user['email'];
            $this->firstname = $user['firstname'];
            $this->lastname = $user['lastname'];
            $_SESSION['id'] = $this->id;
            return true;
        } else {
            return false;
        }
    }

    public function disconnect() {
        session_destroy();
        // Unset all of the session variables
        $_SESSION = array();
    }

    public function isconnecte() {
        return isset($_SESSION['id']) ? $_SESSION['id'] : null;
    }

    public function delete($id) {
        $this->id = $_SESSION['id'];
        $inser = "DELETE FROM utilisateurs WHERE id = :id";
        $insere = $this->connexion_bdd->prepare($inser);
        $insere->bindParam(':id', $id);
        $insere->execute();
        $this->disconnect();
    }

    public function update($login, $password, $email, $firstname, $lastname, $id) {
        if ($this->id && $this->id == $id) {
            $passwordhash = password_hash($password, PASSWORD_BCRYPT);

            $inser = "UPDATE utilisateurs SET login = :login, password = :password, email = :email, firstname = :firstname, lastname = :lastname WHERE id = :id";
            $insere = $this->connexion_bdd->prepare($inser);
            $insere->bindParam(':login', $login);
            $insere->bindParam(':password', $passwordhash);
            $insere->bindParam(':email', $email);
            $insere->bindParam(':firstname', $firstname);
            $insere->bindParam(':lastname', $lastname);
            $insere->bindParam(':id', $id);
            $insere->execute();

            $this->login = $login;
            $this->email = $email;
            $this->firstname = $firstname;
            $this->lastname = $lastname;
        }
    }

    public function getpourModifier($id) {
        $inser = "SELECT * FROM utilisateurs WHERE id = :id";
        $insere = $this->connexion_bdd->prepare($inser);
        $insere->bindParam(':id', $id);
        $insere->execute();
        return $insere->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllinfos() {
        try {
            $inser = "SELECT * FROM utilisateurs WHERE id = :id";
            $insere = $this->connexion_bdd->prepare($inser);
            $insere->bindParam(':id', $this->id);
            $insere->execute();
            $result = $insere->fetch(PDO::FETCH_ASSOC);
            return $result ? $result : [];
        } catch (PDOException $e) {
            return [];
        }
    }

     function setId($id) {
        $this->id = $id;
    }

    // Méthode pour obtenir l'ID
    public function getId() {
        return $this->id;
    }

    public function getlogin() {
        $inser = "SELECT login FROM utilisateurs WHERE id = :id";
        $insere = $this->connexion_bdd->prepare($inser);
        $insere->bindParam(':id', $this->id);
        $insere->execute();
        return $insere->fetchColumn();
    }

    public function getpassword() {
        $inser = "SELECT password FROM utilisateurs WHERE id = :id";
        $insere = $this->connexion_bdd->prepare($inser);
        $insere->bindParam(':id', $this->id);
        $insere->execute();
        return $insere->fetchColumn();
    }

    public function getemail() {
        $inser = "SELECT email FROM utilisateurs WHERE id = :id";
        $insere = $this->connexion_bdd->prepare($inser);
        $insere->bindParam(':id', $this->id);
        $insere->execute();
        return $insere->fetchColumn();
    }

    public function getfirstname() {
        $inser = "SELECT firstname FROM utilisateurs WHERE id = :id";
        $insere = $this->connexion_bdd->prepare($inser);
        $insere->bindParam(':id', $this->id);
        $insere->execute();
        return $insere->fetchColumn();
    }

    public function getlastname() {
        $inser = "SELECT lastname FROM utilisateurs WHERE id = :id";
        $insere = $this->connexion_bdd->prepare($inser);
        $insere->bindParam(':id', $this->id);
        $insere->execute();
        return $insere->fetchColumn();
    }

    public function __destruct() {
        // PDO does not have a close method; the connection is automatically closed when the object is destroyed
    }
}
?>
