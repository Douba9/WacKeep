<!-- register.php -->
<?php
session_start();

// Vérifier si l'utilisateur est déjà connecté, le rediriger vers la page principale
if (isset($_SESSION['user_id'])) {
    header('Location: keep.php');
    exit();
}

// Si le formulaire d'inscription est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assurez-vous de valider et d'assainir les entrées de l'utilisateur
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Vous devez ajouter le code ici pour insérer les informations d'inscription dans la base de données
    // (Assurez-vous d'utiliser des requêtes préparées pour éviter les injections SQL)

    // Exemple : Connexion à la base de données (remplacez ces détails par les vôtres)
    $pdo = new PDO('mysql:host=localhost;dbname=keep', 'marius', 'devauber');

    // Exemple : Préparer et exécuter une requête pour insérer les informations d'inscription dans la base de données
    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    // Rediriger vers la page de connexion après l'inscription réussie
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WacKeep - Inscription</title>
</head>

<body>
    <h2>Inscription</h2>

    <form action="register.php" method="post">
        <label for="username">Nom d'utilisateur:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">S'inscrire</button>
        <p>Déjà un compte ? <a href="login.php">Se connecter</a></p>
    </form>
</body>

</html>
