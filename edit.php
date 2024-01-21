<!-- edit.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WacKeep - Éditer la note</title>
</head>
<body>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
        $noteId = $_GET['id'];

        // Vous devez ajouter le code ici pour récupérer les détails de la note à éditer depuis la base de données
        // Assurez-vous d'utiliser des requêtes préparées pour éviter les injections SQL

        // Exemple : Connexion à la base de données (vous devrez remplacer ces détails avec les vôtres)
        $pdo = new PDO('mysql:host=localhost;dbname=keep', 'marius', 'devauber');

        // Exemple : Préparer et exécuter une requête pour récupérer les détails de la note depuis la base de données
        $stmt = $pdo->prepare("SELECT * FROM notes WHERE id = :id");
        $stmt->bindParam(':id', $noteId);
        $stmt->execute();
        $noteDetails = $stmt->fetch();

        // Afficher le formulaire de modification avec les détails de la note
        echo '<form action="update.php" method="post">';
        echo '<textarea name="updated_content">' . $noteDetails['content'] . '</textarea>';
        echo '<input type="hidden" name="note_id" value="' . $noteDetails['id'] . '">';
        echo '<button type="submit">Enregistrer les modifications</button>';
        echo '</form>';
    } else {
        // Si la requête n'est pas de type GET ou si l'ID de la note n'est pas fourni, rediriger vers la page principale
        header('Location: keep.php');
        exit();
    }
    ?>
</body>
</html>
