<?php
$pageTitle = "Cosmic Order";
$extraCss = "css/timeline.css";
include 'includes/header.php';
require_once 'includes/db_connect.php';

// Fetch timeline events from database
try {
    $stmt = $pdo->query("SELECT era, discovery, impact FROM timeline_events ORDER BY sort_order ASC");
    $events = $stmt->fetchAll();
} catch (PDOException $e) {
    $events = [];
    error_log("Error fetching timeline events: " . $e->getMessage());
}
?>

  <main>
    <section id="timeline">
      <h2>From Cosmic Models to Calendars</h2>
      <p>
        From the ancient sky gods of Egypt and Babylon to atomic clocks,
        humanity has sought to translate the heavens into order and time.
      </p>
      <img src="images/timewheel.jpg" alt="Ancient timewheel" class="center-img">

      <div class="timeline-container">
        <?php if (!empty($events)): ?>
            <?php $i = 0; foreach ($events as $event): ?>
                <div class="timeline-item <?php echo ($i % 2 == 0) ? 'left' : 'right'; ?> fade-up" style="animation-delay: <?php echo ($i * 0.15); ?>s">
                    <div class="timeline-content">
                        <span class="era"><?php echo htmlspecialchars($event['era']); ?></span>
                        <h4><?php echo htmlspecialchars($event['discovery']); ?></h4>
                        <p><?php echo htmlspecialchars($event['impact']); ?></p>
                    </div>
                </div>
            <?php $i++; endforeach; ?>
        <?php else: ?>
            <p class="no-events">No events found in the database.</p>
        <?php endif; ?>
      </div>

      <p class="desc">
        Today’s atomic clocks still echo the rhythm of the cosmos — a reminder
        that our measurement of time began with the stars.
      </p>
    </section>
  </main>

<?php include 'includes/footer.php'; ?>
