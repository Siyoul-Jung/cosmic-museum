  <footer>
    <p>© 2025 Designed by Woongbin</p>
    <p class="project-context">
      This site re-imagines <em>The Power of Stars</em> as a digital exhibition —
      where astronomy and anthropology meet to reveal how celestial observation
      shaped civilization.
    </p>    
  </footer>
  <script src="js/script.js"></script>
  <script>
    // Generate individual stars for the background
        const starfield = document.getElementById('starfield');
        if (starfield) {
          const count = 150;
          for (let i = 0; i < count; i++) {
            const star = document.createElement('div');
            star.className = 'star';
            const size = (Math.random() * 2 + 1) + 'px';
            star.style.width = size;
            star.style.height = size;
            star.style.left = (Math.random() * 100) + '%';
            star.style.top = (Math.random() * 100) + '%';
            star.style.setProperty('--duration', (Math.random() * 3 + 2) + 's');
            star.style.animationDelay = (Math.random() * 5) + 's';
            starfield.appendChild(star);
          }

          // Random Shooting Star Generator
          function createShootingStar() {
            const shootingStar = document.createElement('div');
            shootingStar.className = 'shooting-star';
            shootingStar.style.left = (Math.random() * 80 + 20) + '%';
            shootingStar.style.top = (Math.random() * 50) + '%';
            starfield.appendChild(shootingStar);
            
            // Clean up after animation ends
            setTimeout(() => {
              shootingStar.remove();
            }, 3000);
          }

          // Shoot a star occasionally (every 4-10 seconds)
          function spawnRandom() {
            createShootingStar();
            setTimeout(spawnRandom, Math.random() * 6000 + 4000);
          }
          spawnRandom();
        }
  </script>
</body>
</html>
