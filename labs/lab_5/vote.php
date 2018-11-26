<?php
$page = $_SERVER['PHP_SELF'];
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["question"])) {
  $question = $_POST["question"];
  $yes = 0;
  $no = 0;
  $expiryTime = time()+60*60*24;
  setcookie("question", $question, $expiryTime);
  setcookie("yes", $yes, $expiryTime);
  setcookie("no", $no, $expiryTime);
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
  throw new Error("Invalid post request");
} else if (
  $_SERVER["REQUEST_METHOD"] == "GET" && 
  !(isset($_COOKIE["question"]) && isset($_COOKIE["yes"]) && isset($_COOKIE["no"]))
) {
  throw new Error("Question not yet registered");
} else if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $question = $_COOKIE["question"];
} else {
  throw new Error("Invalid request method");
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
      <h1>QuickPoll Vote</h1>
    </header>
    <main>
      <p><?php echo $question ?></p>
      <form action="tally.php" method="POST">
        <input type="radio" name="vote" value="yes" checked> Yes<br>
        <input type="radio" name="vote" value="no"> No<br>
        <input type="submit" value="Register my vote">
      </form>
    </main>
  </body>
</html>
