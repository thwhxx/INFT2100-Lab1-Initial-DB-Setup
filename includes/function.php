<?php

function redirect($url) {
    header("Location:". $url);
    ob_flush();
    exit;
}

function is_logged_in() {
    if(!isset($_SESSION['user_id'])) {
        header("Location: sign-in.php"); // Redirect to sign-in.php
        ob_flush();
        exit();
    }
}

function displayMessageOnce() {
    if(isset($_SESSION['message'])) {
        echo '<div class="alert alert-success">'.$_SESSION['message'].'</div>';
        unset($_SESSION['message']); // Clear the error message
    }
}


function generate_dynamic_nav() {
    // Check if a user is logged in
    if(isset($_SESSION['user_id'])) {
        // If user is logged in, display link to dashboard.php and logout.php
        echo '<a class="nav-link" href="dashboard.php">Dashboard</a>';
        echo '<a class="nav-link" href="logout.php">Logout</a>';
    } else {
        // If user is not logged in, display link to sign-in.php
        echo '<a class="nav-link" href="sign-in.php">Sign In</a>';
    }

    // Always display link to index.php (Home)
    echo '<a class="nav-link" href="index.php">Home</a>';
}


function log_activity($userSelected) {
    $updateFile = fopen("DATA_LOG.txt", "a");
    $text = "Sign in success at " . date('Y-m-d h:i:s') . " for user " . $userSelected['email'] . "\n";
    fwrite($updateFile, $text);
    fclose($updateFile);
}

?>


