<!-- keep.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WacKeep - Bonus</title>
</head>

<body>
    <?php
    session_start();

    $userIsLoggedIn = isset($_SESSION['user_id']);

    if ($userIsLoggedIn) {
        $userId = $_SESSION['user_id'];

        echo '<form action="process.php" method="post">';
        echo '<textarea name="note_content" placeholder="Saisissez votre note ici"></textarea>';
        echo '<input type="datetime-local" name="reminder_date" placeholder="Définir une date de rappel">';
        echo "<input type=\"hidden\" name=\"userId\" value=\"" . $userId . "\" />";
        echo '<button type="submit">Ajouter Note</button>';
        echo '</form>';

        $pdo = new PDO('mysql:host=localhost;dbname=keep', 'marius', 'devauber');

        $stmt = $pdo->query("SELECT * FROM notes");
        $notes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo '<div>';
        echo '<h2>Mes Notes</h2>';
        echo '<ul>';

        echo "user id : $userId";

        foreach ($notes as $note) {
            if ($note['user_id'] == $userId) {
                echo '<li>Note ' . $note['id'] . ' - ' . $note['content'] . ' ';
                echo '<a href="edit.php?id=' . $note['id'] . '">Éditer</a>';
                echo '<a href="delete.php?id=' . $note['id'] . '">Supprimer</a>';
                echo '<a href="share.php?id=' . $note['id'] . '">Partager</a></li>';
            }
        }

        echo '</ul>';
        echo '</div>';
    } else {
        echo '<p>Vous devez être connecté pour accéder à cette fonctionnalité.</p> <a href="login.php">Se connecter</a><';
    }
    ?>
</body>

</html>