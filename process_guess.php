<?php
session_start();


if (!isset($_SESSION['target_number'])) {
    $_SESSION['target_number'] = rand(1, 100); 
    $_SESSION['guesses'] = 0; 
}


$target_number = $_SESSION['target_number'];
$guesses = $_SESSION['guesses'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['give_up'])) {

        $message = "You gave up! The correct number was $target_number. The game will now reset.";
        session_unset(); 
        session_destroy(); 
    } else {

        $guess = isset($_POST['guess']) ? (int)$_POST['guess'] : null;
        $guesses++; 

        if ($guess === $target_number) {
            $message = "Congratulations! $target_number is correct. You guessed the number in $guesses guesses.";
            session_unset(); 
            session_destroy(); 
        } elseif ($guess < $target_number) {
            $message = "Too low! Try again. You have already guessed $guesses times.";
        } else {
            $message = "Too high! Try again. You have already guessed $guesses times.";
        }

        $_SESSION['guesses'] = $guesses;
    }
}


if (isset($message)) {
    echo $message;
}
?>
