<?php
require 'User.php';
$user = new User();

if(isset($_POST['id'])) {
    $user->id = $_SESSION['id'];


    $user_bdd = $user->getpourModifier($user->id);

    if($user_bdd){
        $login = $user_bdd['login'];
        $password = $user_bdd['password'];
        $email = $user_bdd['email'];
        $firstname = $user_bdd['firstname'];
        $lastname = $user_bdd['lastname'];
       exit();
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        $login = $_POST['login'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];

        $user->update($login, $password, $email, $firstname, $lastname, $user->id);

        $_SESSION['succsess_message'] = 'Vos informations ont bien été mises à jour.';

        $_SESSION['succsess_message'] = 'Vos informations ont bien été mises à jour.';
        header('Location: ./index.php');
        exit();
    }
    
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Mon Compte</title>
    <!-- Lien vers le CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Modifier Mon Compte</h2>
        <form action="update_account.php" method="post" class="mt-4">
            <div class="mb-3">
                <label for="login" class="form-label">Login</label>
                <input type="text" class="form-control" id="login" name="login" value="<?php echo htmlspecialchars($login); ?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Nouveau mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Laissez vide si inchangé">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <div class="mb-3">
                <label for="firstname" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo htmlspecialchars($firstname); ?>" required>
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Nom</label>
                <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo htmlspecialchars($lastname); ?>" required>
            </div>
            <input type="hidden" name="id" value="<?php echo $user->id; ?>">
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>

    <!-- Lien vers le JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>