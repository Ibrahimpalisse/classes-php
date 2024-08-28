<?php
require 'user-pdo.php';

// Vérifiez que l'ID est passé dans l'URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Redirigez vers la page d'index avec un message d'erreur
    header('Location: ./index.php?error=ID manquant');
    exit();
}

$id = intval($_GET['id']);

// Assurez-vous que la connexion à la base de données est correcte
$connexion_bdd = new mysqli('localhost', 'root', '', 'classes');

if ($connexion_bdd->connect_error) {
    die("Connexion échouée : " . $connexion_bdd->connect_error);
}

$utilisateurs = new User($connexion_bdd);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $utilisateurs->delete($id);
    // Rediriger après la suppression
    header('Location: ./login.php?message=Utilisateur supprimé et déconnecté');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Confirmer la Suppression</title>
</head>
<body>
    <div class="container mt-5">
        <div class="alert alert-warning">
            <h4 class="alert-heading">Confirmation de la Suppression</h4>
            <p>Êtes-vous sûr de vouloir supprimer cet utilisateur ? Cette action est irréversible.</p>
            <form method="post">
                <button type="submit" class="btn btn-danger">Supprimer</button>
                <a href="./index.php" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</body>
</html>
