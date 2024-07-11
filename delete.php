<?php
include 'includes/db.php';

if (isset($_GET['id']) && isset($_GET['database'])) {
    $id = $_GET['id'];
    $selected_db = $_GET['database'];

    $conn = getDbConnection($selected_db);

    $stmt = $conn->prepare("DELETE FROM users WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    header("Location: index.php?database=$selected_db");
}
