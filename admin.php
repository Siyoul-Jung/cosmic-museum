<?php
require_once 'includes/db_connect.php';
require_once 'includes/auth_session.php';

requireAdmin();

$pageTitle = "Admin Dashboard";
include 'includes/header.php';

// Fetch all feedback
$stmt = $pdo->query("SELECT f.*, u.username FROM feedback f JOIN users u ON f.user_id = u.id ORDER BY f.created_at DESC");
$feedbacks = $stmt->fetchAll();
?>

<main>
    <section class="admin-dashboard">
        <h2>Admin Dashboard</h2>
        <div style="text-align: right; margin-bottom: 1rem;">
            <a href="add_exhibit.php" class="btn" style="width: auto; padding: 0.5rem 1rem;">+ Add New Exhibit</a>
        </div>
        <h3>User Feedback</h3>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>User</th>
                    <th>Rating</th>
                    <th>Message</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($feedbacks as $feedback): ?>
                <tr>
                    <td><?php echo htmlspecialchars($feedback['created_at']); ?></td>
                    <td><?php echo htmlspecialchars($feedback['username']); ?></td>
                    <td><?php echo htmlspecialchars($feedback['rating']); ?></td>
                    <td><?php echo htmlspecialchars($feedback['message']); ?></td>
                    <td>
                        <form action="delete_feedback.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this feedback?');" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $feedback['id']; ?>">
                            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                            <button type="submit" class="btn-delete" style="border:none; cursor:pointer;">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</main>

<?php include 'includes/footer.php'; ?>
