<?php
include 'includes/db.php';
include 'partials/header.php';

$selected_db = isset($_GET['database']) ? $_GET['database'] : 'database1';
$conn = getDbConnection($selected_db);

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $user = $stmt->fetch();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    header("Location: index.php?database=$selected_db");
}
?>
<div class="container">
    <h2>Edit User</h2>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $user['name']; ?>" required><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required><br>
        <input type="submit" value="Update">
    </form>
</div>

<?php include 'partials/footer.php'; ?>