<?php
require_once 'includes/db_connect.php';
require_once 'includes/auth_session.php';

requireLogin(); // Ensure user is logged in

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = trim($_POST['message']);
    $rating = (int)$_POST['rating'];
    $user_id = $_SESSION['user_id'];

    if (empty($message) || $rating < 1 || $rating > 5) {
        $error = "Please provide a message and a valid rating (1-5).";
    } else {
        $stmt = $pdo->prepare("INSERT INTO feedback (user_id, message, rating) VALUES (?, ?, ?)");
        if ($stmt->execute([$user_id, $message, $rating])) {
            $success = "Thank you for your feedback!";
        } else {
            $error = "Something went wrong. Please try again.";
        }
    }
}

$pageTitle = "Feedback";
include 'includes/header.php';
?>

<main>
    <section class="feedback-form">
        <h2>Share Your Thoughts</h2>
        <p>We value your feedback on the Cosmic Museum experience.</p>
        
        <?php if ($error): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <?php if ($success): ?>
            <p class="success"><?php echo $success; ?></p>
        <?php endif; ?>

        <form action="feedback.php" method="post">
            <div class="form-group">
                <label for="rating">Rating (1-5):</label>
                <select id="rating" name="rating" required>
                    <option value="5">5 - Excellent</option>
                    <option value="4">4 - Good</option>
                    <option value="3">3 - Average</option>
                    <option value="2">2 - Poor</option>
                    <option value="1">1 - Terrible</option>
                </select>
            </div>
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn">Submit Feedback</button>
        </form>
    </section>
</main>

<?php include 'includes/footer.php'; ?>
