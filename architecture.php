<?php
$pageTitle = "Celestial Monuments";
$extraCss = "css/architecture.css";
include 'includes/header.php';
?>

  <main>
    <section id="intro">
      <h2>When the Sky Became Architecture</h2>
      <p>
        Across ages and civilizations, humans built monuments that aligned with the heavens —
        transforming the movements of the stars into stone, geometry, and sacred space.
      </p>
    </section>

    <section id="monuments">
      <h3>Monuments of the Ancient Sky</h3>
      <div class="card-grid">
        <?php
        require_once 'includes/db_connect.php';
        $stmt = $pdo->query("SELECT * FROM exhibits");
        $i = 0;
        while ($row = $stmt->fetch()) {
            $class = '';
            // Assign Bento classes based on the index
            if ($i % 4 == 0) $class = 'large';
            elseif ($i % 4 == 1) $class = 'wide';
            elseif ($i % 4 == 2) $class = 'tall';
            
            // Add fade-up stagger
            $delay = ($i * 0.1) . 's';
            
            echo '<article class="card ' . $class . ' fade-up" style="animation-delay: ' . $delay . '">';
            echo '<img src="' . htmlspecialchars($row['image_url']) . '" alt="' . htmlspecialchars($row['title']) . '">';
            echo '<h4>' . htmlspecialchars($row['title']) . '</h4>';
            echo '<p>' . htmlspecialchars($row['description']) . '</p>';
            echo '</article>';
            $i++;
        }
        ?>
      </div>
    </section>

    <section id="cities">
      <h3>Celestial Cities and Sacred Landscapes</h3>
      <p>
        From the pyramids of Giza and the Forbidden City to Angkor Wat, civilizations shaped
        their capitals and temples to mirror the heavens — grounding divine order on Earth.
      </p>
      <div class="grid-two">
        <img src="images/pyramid.jpg" alt="Pyramid of Giza aligned with Orion’s Belt">
        <img src="images/angkor.jpg" alt="Angkor Wat aligned with equinox sunrise">
      </div>
    </section>

    <section id="modern">
      <h3>The Archaeoastronomy of Modern Civilization</h3>
      <p>
        The dialogue between sky and structure continues today — from Manhattanhenge’s solar streets
        to James Turrell’s <em>Roden Crater</em>, where light, space, and time merge into a new kind of celestial observatory.
      </p>
      <img src="images/galaxy.jpg" alt="Modern Observatory under the Milky Way" class="center-img" />
    </section>

    <blockquote class="quote">
      “The Earth became a mirror of the heavens.”
    </blockquote>
  </main>

<?php include 'includes/footer.php'; ?>
