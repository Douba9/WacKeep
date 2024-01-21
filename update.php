<!-- update.php -->
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updatedContent = $_POST['updated_content'];
    $noteId = $_POST['note_id'];

    // Vous devez ajouter le code ici pour mettre à jour la note dans la base de données
    // Assurez-vous d'utiliser des requêtes préparées pour éviter les injections SQL

    // Exemple : Connexion à la base de données (vous devrez remplacer ces détails avec les vôtres)
    $pdo = new PDO('mysql:host=localhost;dbname=keep', 'marius', 'devauber');

    // Exemple : Préparer et exécuter une requête pour mettre à jour la note dans la base de données
    $stmt = $pdo->prepare("UPDATE notes SET content = :content WHERE id = :id");
    $stmt->bindParam(':content', $updatedContent);
    $stmt->bindParam(':id', $noteId);
    $stmt->execute();

    // Redirection vers la page principale après avoir mis à jour la note
    header('Location: keep.php');
    exit();
} else {
    // Si la requête n'est pas de type POST, rediriger vers la page principale
    header('Location: keep.php');
    exit();
}
?>
