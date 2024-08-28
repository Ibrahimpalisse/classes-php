<?php
require 'User.php';

$utilisateurs = new User();
$users = $utilisateurs->getAllinfos();
$utilisateur_connecte = $utilisateurs->isconnecte();


if ($utilisateur_connecte == null) {
    header('Location: ./login.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <a href="./disconnect.php" class="btn btn-secondary">Se déconnecter</a>

    <div class="container mt-4">
        <table class="table table-striped">
            <thead>
                <tr>
                    <!-- Créez les en-têtes de colonnes -->
                    <th>ID</th>
                    <th>login</th>
                    <th>password</th>
                    <th>email</th>
                    <th>lastname</th>
                    <th>firstname</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <?php if ($user['id'] == $utilisateur_connecte): ?>
                        <!-- Affichez les données des utilisateurs dans chaque ligne -->
                        <tr>
                            <td><?php echo htmlspecialchars($user['id']); ?></td>
                            <td><?php echo htmlspecialchars($user['login']); ?></td>
                            <td><?php echo htmlspecialchars($user['password']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td><?php echo htmlspecialchars($user['lastname']); ?></td>
                            <td><?php echo htmlspecialchars($user['firstname']); ?></td>
                            <td>
                                <!-- Ajoutez des boutons dans la dernière colonne -->
                                <a href="update.php?id=<?php echo htmlspecialchars($user['id']); ?>" class="btn btn-info btn-sm">Mettre a jour</a>
                                <a href="delete.php?id=<?php echo htmlspecialchars($user['id']); ?>" class="btn btn-danger btn-sm">Supprimer</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
