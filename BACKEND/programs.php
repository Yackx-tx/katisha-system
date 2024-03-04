<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Product</title>
</head>
<body>
    <center>
    <h1><u>Get Bus</u></h1>
    <form method="post">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label for="bus">Number of tickets:</label>

    <input type="number" name="num"><br><br>

        <label for="bus">Choose Bus:</label>
        <select name="bus">
            <option value="horizon">horizon</option>
            <option value="volcano">volcano</option>
            <option value="stera">stera</option>
        </select><br><br>
        <input type="submit" name="submit" value="GET BUS">
    </form>
    </center>
    <?php
// Define the database connection parameters
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'katisha';

// Create a new database connection
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check for errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// You can now use the `$conn` object to interact with the 

if (isset($_POST['submit'])) {
    $ticket = $_POST['num'];
    $busname = $_POST['bus']; 
   
// Fetch the current number of customers for the selected bus
$sql = "SELECT num_customers FROM buses WHERE bus_p='" . $busname . "'";
$result = $conn->query($sql);

if (!$result) {
    die("Invalid query: " . $conn->error);
}

// Update the number of customers for the selected bus
$row = $result->fetch_assoc();
$current_customers = $row['num_customers'];
$new_customers = $current_customers - $ticket;

$sql = "UPDATE buses SET num_customers=$new_customers WHERE bus_p='" . $busname . "'";

if ($conn->query($sql) === TRUE) {
    echo "Number of customers for " . $busname . " has been updated to " . $new_customers;
} else {
    echo "Error updating number of customers: " . $conn->error;
}
}




?>
    
</body>
</html>