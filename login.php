<!-- login.php -->
<?php
session_start();

// Vérifier si l'utilisateur est déjà connecté, le rediriger vers la page principale
if (isset($_SESSION['user_id'])) {
    header('Location: keep.php');
    exit();
}

// Si le formulaire de connexion est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assurez-vous de valider et d'assainir les entrées de l'utilisateur
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vous devez ajouter le code ici pour vérifier les informations d'identification par rapport à la base de données
    // (Assurez-vous d'utiliser des requêtes préparées pour éviter les injections SQL)

    // Exemple : Connexion à la base de données (remplacez ces détails par les vôtres)
    $pdo = new PDO('mysql:host=localhost;dbname=keep', 'marius', 'devauber');

    // Exemple : Préparer et exécuter une requête pour vérifier les informations d'identification
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Les informations d'identification sont correctes, connectez l'utilisateur
        $_SESSION['user_id'] = $user['id'];

        // Rediriger vers la page principale après la connexion réussie
        header('Location: keep.php');
        exit();
    } else {
        // Informations d'identification incorrectes, afficher un message d'erreur
        $error_message = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WacKeep - Connexion</title>
</head>

<body>
    <h2>Connexion</h2>

    <?php
    if (isset($error_message)) {
        echo '<p style="color: red;">' . $error_message . '</p>';
    }
    ?>

    <form action="login.php" method="post">
        <label for="username">Nom d'utilisateur:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Se connecter</button>
        <p>Vous n'avez pas encore de compte ? <a href="register.php">Créer un compte</a></p>
    </form>
</body>

</html>