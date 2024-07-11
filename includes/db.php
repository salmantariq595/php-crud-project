
<?php
$servername = "localhost";
$username = "root";
$password = "";

// Function to get a connection to the specified database
function getDbConnection($selected_db)
{
    global $servername, $username, $password;
    $dbname = $selected_db == 'database1' ? 'crud_db2' : 'crud_db';
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        exit();
    }
}
