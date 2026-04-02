<?php
require_once 'includes/db_connect.php';
require_once 'includes/auth_session.php';

requireAdmin();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['csrf_token'])) {
    if ($_POST['csrf_token'] === $_SESSION['csrf_token']) {
        $id = (int)$_POST['id'];
        
        // Delete the feedback
        try {
            $stmt = $pdo->prepare("DELETE FROM feedback WHERE id = ?");
            $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log("Error deleting feedback: " . $e->getMessage());
        }
    } else {
        error_log("CSRF token mismatch on delete_feedback.php");
    }
}

header("Location: admin.php");
exit();
?>
