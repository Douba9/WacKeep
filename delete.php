<!-- delete.php -->
<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $noteId = $_GET['id'];

    // Vous devez ajouter le code ici pour supprimer la note de la base de données
    // Assurez-vous d'utiliser des requêtes préparées pour éviter les injections SQL

    // Exemple : Connexion à la base de données (vous devrez remplacer ces détails avec les vôtres)
    $pdo = new PDO('mysql:host=localhost;dbname=keep', 'marius', 'devauber');

    // Exemple : Préparer et exécuter une requête pour supprimer la note de la base de données
    $stmt = $pdo->prepare("DELETE FROM notes WHERE id = :id");
    $stmt->bindParam(':id', $noteId);
    $stmt->execute();

    // Redirection vers la page principale après avoir supprimé la note
    header('Location: keep.php');
    exit();
} else {
    // Si la requête n'est pas de type GET ou si l'ID de la note n'est pas fourni, rediriger vers la page principale
    header('Location: keep.php');
    exit();
}
?>
