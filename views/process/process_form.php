<?php
session_start();

// Check if the form is submitted and the user is logged in
if (isset($_POST['buy_card']) && isset($_SESSION['user_id'])) {
    // Extract card ID and quantity from the form submission
    $card_id = $_POST['buy_card'];
    $slot_key = 'slot_' . $card_id;
    $slot = $_POST[$slot_key];

    // Check if the slot quantity is provided and not empty
    if (isset($_POST[$slot_key]) && $_POST[$slot_key] !== '') {
        $slot = $_POST[$slot_key];
        // Database connection details
        $dsn = 'mysql:host=localhost;dbname=pokeshop_v2';
        $username = 'root';
        $password = '';
        $card_id=str_replace('=', '.', $card_id);
        $slot_key=str_replace('=', '.', $slot_key);
        try {
            // Connect to the database
            $dbh = new PDO($dsn, $username, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Check if the user already has the card
            $stmt = $dbh->query("SELECT * FROM user_cards WHERE user_id = {$_SESSION['user_id']} AND card_id = '{$card_id}'");
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                // User already has the card, update the quantity
                $quantity = $result['quantity'] + $slot;
                $dbh->exec("UPDATE user_cards SET quantity = {$quantity} WHERE user_id = {$_SESSION['user_id']} AND card_id = '{$card_id}'");
            } else {
                // User doesn't have the card, insert a new row
                $dbh->exec("INSERT INTO user_cards (user_id, card_id, quantity) VALUES ({$_SESSION['user_id']}, '{$card_id}', {$slot})");
            }

            // Close connection
            $dbh = null;

            echo "Value inserted/updated into database successfully.";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        // Handle case where 'quantity' value is missing or empty
        echo "Quantity value is missing or empty.";
    }
} else {
    // User is not logged in or form not submitted, display a message
    echo "You need to login to buy a card";
}
?>
