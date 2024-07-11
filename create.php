<?php
include 'includes/db.php';
include 'partials/header.php';
?>

<div class="container">
    <h2>Add User</h2>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $selected_db = $_POST['database']; // Get the selected database

        // Connect to the selected database
        $conn = getDbConnection($selected_db);

        // Prepare and execute the insert statement
        $stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        header("Location: index.php");
    }
    ?>
    <form method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        <label for="database">Select Database:</label>
        <select id="database" name="database" required>
            <option value="database1">Database 1</option>
            <option value="database2">Database 2</option>
        </select><br>
        <input type="submit" value="Add">
    </form>
</div>

<?php include 'partials/footer.php'; ?>