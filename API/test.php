<?php include("function.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Test</title>
</head>
<body>
  <?php echo shorten("http://google"); ?>
  <?php echo shorten("http://google", "google"); ?>
  <?php echo shorten("http://google", NULL, "text"); ?>
</body>
</html>
