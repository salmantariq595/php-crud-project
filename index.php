<?php
include 'includes/db.php';
include 'partials/header.php';

$selected_db = isset($_GET['database']) ? $_GET['database'] : 'database1';
$conn = getDbConnection($selected_db);

$stmt = $conn->prepare("SELECT * FROM users");
$stmt->execute();
$users = $stmt->fetchAll();
?>

<div class="container">
    <h2>Users</h2>
    <form method="get" action="">
        <label for="database">Select Database:</label>
        <select id="database" name="database" onchange="this.form.submit()">
            <option value="database1" <?php if ($selected_db == 'database1') echo 'selected'; ?>>Database 1</option>
            <option value="database2" <?php if ($selected_db == 'database2') echo 'selected'; ?>>Database 2</option>
        </select>
    </form>
    <a href="create.php">Add User</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($users as $user) : ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['name']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td class="action-buttons">
                    <a href="update.php?id=<?php echo $user['id']; ?>&database=<?php echo $selected_db; ?>"><button>Edit</button></a>
                    <a href="delete.php?id=<?php echo $user['id']; ?>&database=<?php echo $selected_db; ?>"><button>Delete</button></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php include 'partials/footer.php'; ?>