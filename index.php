<html lang="en"> 
<head>
    <title>Number Guessing Game</title>
</head>
<body>
    <h1>Guess the Number Game</h1>

    <form method="post">
        <label for="guess">Enter your guess (between 1 and 100):</label>
        <input type="number" id="guess" name="guess" min="1" max="100" step="1" value="<?php if (isset($_POST['guess'])) echo $_POST['guess']; ?>" required>
        <input type="submit" value="Submit">
        <input type="submit" name="give_up" value="Give up" style="margin-left: 10px;">
    </form>

    <?php
    session_start();


    if (!isset($_SESSION['target_number'])) {
        $_SESSION['target_number'] = rand(1, 100);
        $_SESSION['guess_count'] = 0;
    }

    if (isset($_POST['guess'])) {
        $_SESSION['guess_count']++;
        $guess = intval($_POST['guess']);
        $target_number = $_SESSION['target_number'];

        if ($guess < $target_number) {
            $message = "Your guess is too low.";
        } elseif ($guess > $target_number) {
            $message = "Your guess is too high.";
        } else {
            $message = "Congratulations! You guessed the number $target_number in {$_SESSION['guess_count']} attempts!";

            session_destroy();
        }
    }

    if (isset($_POST['give_up'])) {
        $message = "You gave up! The correct number was " . $_SESSION['target_number'] . ".";

        session_destroy();
    }


    if (isset($message) && !empty($message)) {
        echo "<p>$message</p>";
    }
    ?>
</body>
</html>
