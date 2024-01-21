<!-- process.php -->
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $noteContent = $_POST['note_content'];
    $reminderDate = $_POST['reminder_date'];
    $userId = $_POST['userId'];

    // Vous devez ajouter le code ici pour insérer la nouvelle note et la date de rappel dans la base de données
    // Assurez-vous d'utiliser des requêtes préparées pour éviter les injections SQL

    // Exemple : Connexion à la base de données (vous devrez remplacer ces détails avec les vôtres)
    $pdo = new PDO('mysql:host=localhost;dbname=keep', 'marius', 'devauber');

    // Exemple : Préparer et exécuter une requête pour insérer la nouvelle note et la date de rappel dans la base de données
    $stmt = $pdo->prepare("INSERT INTO notes (user_id, content, reminder_date) VALUES (:user_id, :content, :reminder_date)");
    $stmt->bindParam(':user_id', $userId);
    $stmt->bindParam(':content', $noteContent);
    $stmt->bindParam(':reminder_date', $reminderDate);
    $stmt->execute();

    // Envoi du rappel par e-mail (vous devrez implémenter cette fonctionnalité)
    sendEmailReminder($reminderDate);

    // Redirection vers la page principale après avoir ajouté la note
    header('Location: keep.php');
    exit();
} else {
    // Si la requête n'est pas de type POST, rediriger vers la page principale
    header('Location: keep.php');
    exit();
}

function sendEmailReminder($reminderDate)
{
    // Implémenter la logique pour envoyer un rappel par e-mail
    // Cela dépendra de votre méthode d'envoi d'e-mails (par exemple, PHPMailer, fonction mail() de PHP, etc.)
    // Assurez-vous de définir cette fonction en fonction de vos besoins.
}
?>