<?php
session_start();

// Check for theme preference in session or fallback to cookie
$theme = $_SESSION["theme"] ?? $_COOKIE['theme'] ?? 'light';

if (isset($_SESSION["user_id"])) {
    $mysqli = require __DIR__ . "/database.php";
    $sql = "SELECT * FROM users WHERE id = {$_SESSION["user_id"]}";
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
}

?>
<!DOCTYPE html>
<html data-theme="<?= htmlspecialchars($theme) ?>">
<head>
    <title>Πλατφόρμα διαχείρησης λιστών</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="home.css">
</head>
<body>

    <nav class="navbar">
        <ul>
            <li><a href="login.php" class="btn">Log in</a></li>
            <li><a href="signup.html" class="btn">Sign up</a></li>
            <li><a href="editProfil.php" class="edit-button">Eπεξεργασία Profile</a></li>
            <li><a href="view_tasks.php" class="view-button">Προβολή Tasks</a></li>
            <li><a href="createTask.php?" class="create-button">Δημιουργία Task</a></li>
            
        </ul>
    </nav>

    <header>
        <h1>Πλατφόρμα διαχείρησης λιστών</h1>
        <button id="theme-toggle" class="theme-toggle"><?= $theme === 'dark' ? '☀️' : '🌙' ?></button>
    </header>

    <section>
        <p> Μια σύντομη βασική βοήθεια για την σελίδα.</p>
    </section>

    <div class="accordion">
        <div class="accordion-item">
            <div class="accordion-title"><h2>Σκοπός ιστοτόπου</h2></div>
            <div class="accordion-content">
                <p>Ο σκοπός του ιστοτόπου είναι να δημιουργηθεί μία	πλατφόρμα διαχείρισης λιστών εργασιών (ουσιαστικά ένα δυναμικό ιστότοπο) παρόμοια με γνωστά εργαλεία όπως το Trello
                </p>
            </div>
        </div>
        <div class="accordion-item">
            <div class="accordion-title"><h2>Πως μπορεί κανείς να κάνει εγγραφή και γιατί</h2></div>
            <div class="accordion-content">
                <p>Μπορείς να κάνεις εγγραφή πατώντας το <strong>Sign up </strong> κουμπί και συμπληρώνοντας τα στοιχεία σου!. 
                </p>
            </div>
        </div>
        <div class="accordion-item">
            <div class="accordion-title"><h2>Γιατί να κάνει κάποιος εγγραφή;</h2></div>
            <div class="accordion-content">
                <p>Αυτο γίνεται για να μπορείς να διαχειριστείς προσωπικές
                    λίστες εργασιών,να προσθέσεις/επεξεργαστείς/διαγράψεις εργασίες
                    σε λίστες εργασιών και να αναθέσεις εργασίες σε άλλους χρήστες

                </p>
            </div>
        </div>
    </div>

    <script src="accordion.js"></script>
    <script src="theme-toggle.js"></script>

</body>
</html>