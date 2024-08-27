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
        $this->connexion_bdd = new mysqli('localhost', 'root', '', 'classes');
        if ($this->connexion_bdd->connect_error) {
            die('Erreur de connexion : ' . $this->connexion_bdd->connect_error);
        }
    }
    
    public function register($login, $password, $email, $firstname, $lastname) {
        $insere = $this->connexion_bdd->prepare("SELECT id FROM utilisateurs WHERE login = ?");
        $insere->bind_param('s', $login);
        $insere->execute();
        $insere->store_result();
        
        if ($insere->num_rows > 0) {
            $insere->close();
            return "Ce login est déjà utilisé. Veuillez en choisir un autre"; 
        }
        
        $insere->close();
        
        
        $passwordhash = password_hash($password, PASSWORD_BCRYPT);
        
    
        $insere = $this->connexion_bdd->prepare("INSERT INTO utilisateurs (login, password, email, firstname, lastname) VALUES (?, ?, ?, ?, ?)");
        $insere->bind_param('sssss', $login, $passwordhash, $email, $firstname, $lastname);
        
        if ($insere->execute()) {
            $this->id = $insere->insert_id;
            $_SESSION['user_id'] = $this->id;
            $this->login = $login;
            $this->password = $passwordhash;
            $this->email = $email;
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $insere->close();
            return true;
        } else {
            $insere->close();
            return "Erreur lors de l\'inscription. Veuillez réessayer.";
        }
    }
    


    public function login($login, $password) {
        $insere = $this->connexion_bdd->prepare("SELECT * FROM utilisateurs WHERE login = ?");
        $insere->bind_param('s', $login);
        $insere->execute();
        $result = $insere->get_result();
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $this->id = $user['id'];
            $this->login = $user['login'];
            $this->email = $user['email'];
            $this->firstname = $user['firstname'];
            $this->lastname = $user['lastname'];
            $_SESSION['user_id'] = $this->id;
            return true;
        } else {
            return false;
        }

        $insere->close();
    }

    public function disconnect() {
        session_unset();
        session_destroy();
    }

    public function delete($id) {
        $this->id = $id;
        $insere = $this->connexion_bdd->prepare("DELETE FROM utilisateurs WHERE id = ?");
        $insere->bind_param('i', $id);
        $insere->execute();
        $insere->close();
        $this->disconnect();
    }

    public function update($login, $password, $email, $firstname, $lastname, $id) {
        if ($this->id) {
            $passwordhash = password_hash($password, PASSWORD_BCRYPT);
            $insere = $this->connexion_bdd->prepare("UPDATE utilisateurs SET login = ?, password = ?, email = ?, firstname = ?, lastname = ? WHERE id = ?");
            $insere->bind_param('sssssi', $login, $passwordhash, $email, $firstname, $lastname, $id);
            $insere->execute();
            $insere->close();

            $this->login = $login;
            $this->email = $email;
            $this->firstname = $firstname;
            $this->lastname = $lastname;
        }
    }

    public function est_ce_connecte() {
        return isset($_SESSION['user_id']);
    }

    public function getUtilisateurs() {
        $insere = $this->connexion_bdd->prepare("SELECT * FROM utilisateurs");
        $insere->execute();
        $result = $insere->get_result();
        $users = $result->fetch_all(MYSQLI_ASSOC);
        $insere->close();
        return $users;
    }

    public function __destruct() {
        $this->connexion_bdd->close();
    }
}
?>
