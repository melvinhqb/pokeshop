

<!-- views/set.php -->


<main>
    <div class="content-wrapper">
        <?php require('partials/sidebar.php'); ?>
        <div class="content">
            <h1>Extension <?php echo $set->name; ?></h1>
            <?php

session_start();

// Database connection details
$dsn = 'mysql:host=localhost;dbname=pokeshop_v2';
$username = 'root';
$password = '';
try {
    // Create a new PDO instance
    $dbh = new PDO($dsn, $username, $password);

    // Prepare SQL statement
    $stmt = $dbh->prepare("SELECT card_id, quantity FROM user_cards WHERE user_id = :user_id");
    
    // Bind parameters
    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    
    // Execute statement
    $stmt->execute();

    // Fetch the results
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Output the results
    print_r($result);

    // Close connection
    $dbh = null;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
        </div>
    </div>
</main>
<?php $content = ob_get_clean(); ?>

<?php require('layout.php'); ?>

<script src="ressources/js/imageZoomModal.js"></script>
<script src="ressources/js/accordionSets.js"></script>
