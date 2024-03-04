<?php
session_start();

$time_limit = 3600; // 1 hour

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['booking_data'] = $_POST;
    $_SESSION['submission_time'] = time();
    header("Location: confirmation.php");
    exit();
}

if (isset($_SESSION['submission_time'])) {
    $elapsed_time = time() - $_SESSION['submission_time'];
    if ($elapsed_time > $time_limit) {
        unset($_SESSION['booking_data']);
        unset($_SESSION['submission_time']);
        header("Location: time_limit_expired.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Booking</title>
</head>
<body>
    <h2>Bus Booking Form</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <!-- More fields as needed -->
        <button type="submit">Submit</button>
    </form>
</body>
</html>
