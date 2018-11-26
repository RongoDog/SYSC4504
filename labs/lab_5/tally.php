<?php
$page = $_SERVER['PHP_SELF'];
if (!isset($_COOKIE["yes"]) || !isset($_COOKIE["no"])) {
  throw new Error("Invalid header information");
} else if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST["vote"])) {
  throw new Error("Invalid post vote request");
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if ($_POST["vote"] !== "yes" && $_POST["vote"] !== "no") {
    throw new Error("Invalid vote parameters");
  } else {
    if ($_POST["vote"] == "yes") {
      $yes = $_COOKIE["yes"] + 1;
      $no = $_COOKIE["no"];
    } else {
      $yes = $_COOKIE["yes"];
      $no = $_COOKIE["no"] + 1;
    }
    $expiryTime = time()+60*60*24;
    setcookie("yes", $yes, $expiryTime);
    setcookie("yes", $no, $expiryTime);
  }
} else if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $yes = $_COOKIE["yes"];
  $no = $_COOKIE["no"];
}

?>

<!DOCTYPE html> 
<html lang="en-US">
  <head lang="en">
    <meta charset="UTF-8">
    <title>SYSC 4504 - Managing State</title>
  </head>
  <body>
    <header>
      <h1>QuickPoll Tally</h1>
    </header>
    <main>
      <p>You answer has been registered. The current totals are:</p>
      <p>Yes: <?php echo $yes ?></p>
      <p>No: <?php echo $no ?></p>
      <a href="vote.php">Vote again</a><br>
      <a href="register.html">Register a new question</a>
    </main>
  </body>
</html>
