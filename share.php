<!-- share.php -->
<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $noteId = $_GET['id'];

    // Vous devez ajouter le code ici pour partager la note avec d'autres utilisateurs
    // Assurez-vous d'utiliser des requêtes préparées pour éviter les injections SQL

    // Exemple : Connexion à la base de données (vous devrez remplacer ces détails avec les vôtres)
    $pdo = new PDO('mysql:host=localhost;dbname=your_database_name', 'your_username', 'your_password');

    // Exemple : Préparer et exécuter une requête pour partager la note avec d'autres utilisateurs
    $stmt = $pdo->prepare("INSERT INTO shared_notes (note_id, user_id) VALUES (:note_id, :user_id)");
    $stmt->bindParam(':note_id', $noteId);
    $stmt->bindParam(':user_id', $loggedInUserId); // Vous devez remplacer $loggedInUserId par l'ID de l'utilisateur connecté
    $stmt->execute();

    // Envoi de notification aux utilisateurs partagés (vous devrez implémenter cette fonctionnalité)
    sendNotificationToSharedUsers($noteId);

    // Redirection vers la page principale après avoir partagé la note
    header('Location: keep.php');
    exit();
} else {
    // Si la requête n'est pas de type GET ou si l'ID de la note n'est pas fourni, rediriger vers la page principale
    header('Location: keep.php');
    exit();
}

function sendNotificationToSharedUsers($noteId) {
    // Implémenter la logique pour envoyer une notification aux utilisateurs partagés
    // Cela dépendra de votre méthode de gestion des notifications (par exemple, par e-mail, messagerie interne, etc.)
    // Assurez-vous de définir cette fonction en fonction de vos besoins.
}
?>
