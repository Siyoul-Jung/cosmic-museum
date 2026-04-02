<?php require_once __DIR__ . '/auth_session.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="A digital museum exploring how celestial observations shaped human civilization.">
  <meta name="author" content="Woongbin" />
  <meta name="keywords" content="astronomy, anthropology, stars, human civilization" /> 
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700&family=Outfit:wght@300;500;700&family=Space+Grotesk:wght@300;500;700&display=swap" rel="stylesheet">
  <title><?php echo isset($pageTitle) ? $pageTitle . ' - ' : ''; ?>The Power of Stars</title>
  <link rel="stylesheet" href="css/base.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="css/index.css?v=<?php echo time(); ?>">
  <!-- Add any additional CSS files here -->
  <?php if (isset($extraCss)) echo '<link rel="stylesheet" href="' . $extraCss . '?v=' . time() . '">'; ?>
</head>
<body>
  <div id="starfield"></div>
  <header>
    <h1><a href="index.php">The Power of Stars</a></h1>
    <nav>
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="timeline.php">Cosmic Order</a></li>
        <li><a href="architecture.php">Celestial Monuments</a></li>
        <li><a href="reflection.php">Reflection</a></li>
        <?php if (isLoggedIn()): ?>
            <li><a href="feedback.php">Feedback</a></li>
            <li><a href="admin.php">Admin</a></li>
            <li><a href="logout.php">Logout</a></li>
        <?php else: ?>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </header>
