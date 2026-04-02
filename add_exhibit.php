<?php
require_once 'includes/db_connect.php';
require_once 'includes/auth_session.php';

requireAdmin();

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $image_url = trim($_POST['image_url']);

    if (empty($title) || empty($description) || empty($image_url)) {
        $error = "All fields are required.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO exhibits (title, description, image_url) VALUES (?, ?, ?)");
        if ($stmt->execute([$title, $description, $image_url])) {
            $success = "Exhibit added successfully!";
        } else {
            $error = "Something went wrong. Please try again.";
        }
    }
}

$pageTitle = "Add Exhibit";
include 'includes/header.php';
?>

<main>
    <section class="admin-dashboard">
        <h2>Add New Exhibit</h2>
        <p><a href="admin.php">← Back to Dashboard</a></p>

        <?php if ($error): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <?php if ($success): ?>
            <p class="success"><?php echo $success; ?></p>
        <?php endif; ?>

        <form action="add_exhibit.php" method="post">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="image_url">Image URL (e.g., images/stonehenge.jpg):</label>
                <input type="text" id="image_url" name="image_url" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn">Add Exhibit</button>
        </form>
    </section>
</main>

<?php include 'includes/footer.php'; ?>
