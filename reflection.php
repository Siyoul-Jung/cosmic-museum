<?php
$pageTitle = "Reflection";
include 'includes/header.php';
require_once 'includes/db_connect.php';

// Get all feedback
$stmt = $pdo->query("SELECT f.message, f.rating, f.created_at, u.username 
                     FROM feedback f 
                     JOIN users u ON f.user_id = u.id 
                     ORDER BY f.created_at DESC");
$reflections = $stmt->fetchAll();
?>

<main>
  <section id="reflection-intro">
    <h2>Cosmic Reflections</h2>
    <p>
      See how others have experienced the connection between humanity and the stars.
      <br>Share your own story in the <a href="feedback.php">Feedback</a> section.
    </p>
  </section>

  <section id="reflection-wall">
    <?php if (count($reflections) > 0): ?>
      <div class="reflection-grid">
        <?php $i = 0; foreach ($reflections as $item): ?>
          <article class="reflection-card fade-up" style="animation-delay: <?php echo ($i * 0.1); ?>s">
            <div class="stars">
              <?php for ($j = 0; $j < $item['rating']; $j++) echo "★"; ?>
            </div>
            <p class="message">"<?php echo htmlspecialchars($item['message']); ?>"</p>
            <div class="author">
              — <?php echo htmlspecialchars($item['username']); ?>
              <span class="date"><?php echo date('M d, Y', strtotime($item['created_at'])); ?></span>
            </div>
          </article>
        <?php $i++; endforeach; ?>
      </div>
    <?php else: ?>
      <p class="no-reflections">No reflections yet. Be the first to share yours!</p>
    <?php endif; ?>
  </section>
</main>

<?php include 'includes/footer.php'; ?>
