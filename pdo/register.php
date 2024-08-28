<?php
require 'user-pdo.php';

$user = new User();
$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['valider'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];

    $resulta = $user->register($login, $password, $email, $firstname, $lastname);

    if ($resulta === true) {
        
        header('Location: ./index.php');
        exit();
    } else {

        $errorMessage = htmlspecialchars($resulta);
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Inscription</title>
</head>
<body>
    <?php if ($errorMessage): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Erreur :</strong> <?php echo $errorMessage; ?>  
            </div>
         <?php endif; ?> 
    </br>   
      </br>
         <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Inscription</h5>
                            </div>
                                <div class="card-body">             
                                <form method="POST">
                                    <div class="mb-3">
                                        <label for="login" class="form-label">Login</label>
                                        <input type="text" class="form-control" id="login" name="login" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">Mot de passe</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="firstname" class="form-label">Prénom</label>
                                        <input type="text" class="form-control" id="firstname" name="firstname" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="lastname" class="form-label">Nom</label>
                                        <input type="text" class="form-control" id="lastname" name="lastname" required>
                                    </div>

                                    <button type="submit" class="btn btn-primary" name="valider">S'inscrire</button>
                                    <a href="./login.php" class="btn btn-secondary">Se connecter</a>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-4yBoA/3AA8eAA/0fOe63Xuo94ktY97B+S7R52vv03Wv59D8SoqMZ4Fdc4G4Z10wr" crossorigin="anonymous"></script>
    
</body>
</html>
