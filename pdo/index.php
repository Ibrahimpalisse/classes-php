<?php
require 'user-pdo.php';

$utilisateurs = new User();
$utilisateur_connecte = $utilisateurs->isconnecte();

if ($utilisateur_connecte === null) {
    header('Location: ./login.php');
    exit();
}

$utilisateurs->setId($utilisateur_connecte); 
$users = $utilisateurs->getAllinfos();

if (!$users) {
    echo "Aucune information trouvée ou une erreur est survenue.";
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
                <?php if ($users): ?>
                    
                    <tr>
                        <td><?php echo htmlspecialchars($users['id']); ?></td>
                        <td><?php echo htmlspecialchars($users['login']); ?></td>
                        <td><?php echo htmlspecialchars($users['password']); ?></td>
                        <td><?php echo htmlspecialchars($users['email']); ?></td>
                        <td><?php echo htmlspecialchars($users['lastname']); ?></td>
                        <td><?php echo htmlspecialchars($users['firstname']); ?></td>
                        <td>
                        
                            <a href="update.php?id=<?php echo htmlspecialchars($users['id']); ?>" class="btn btn-info btn-sm">Mettre à jour</a>
                            <a href="delete.php?id=<?php echo htmlspecialchars($users['id']); ?>" class="btn btn-danger btn-sm">Supprimer</a>
                        </td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td colspan="7">Aucune information trouvée.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
