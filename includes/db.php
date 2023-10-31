<?php

$connection = pg_connect("host=".DB_HOST." user=".DB_USER." password=".DB_PASSWORD." dbname=".DB_NAME);

function db_connect() {
    $connection = pg_connect("host=".DB_HOST." user=".DB_USER." password=".DB_PASSWORD." dbname=".DB_NAME);
    return $connection;
}

$getuser = pg_prepare($connection, "getuser", "SELECT * FROM users WHERE email = $1");

function user_select($email) {
    $connection = db_connect();
    $query = "SELECT * FROM users WHERE email = $1";
    $result = pg_prepare($connection, "user_select", $query);
    $result = pg_execute($connection, "user_select", array($email));
    
    $user = pg_fetch_assoc($result);

    if ($user) {
        return $user;
    } else {
        return false;
    }
}
    function user_authenticate($email, $password) {
        $connection = db_connect();
        $query = pg_prepare($connection, "user_authenticate", "SELECT * FROM users WHERE email = $1 AND password_hash = $2");
        if (!$query) {
            echo "Prepare failed: " . pg_last_error($connection);
            exit;
        }
        $result = pg_execute($connection, "user_authenticate", array($email, $password));

        return $result;
    }
    
function is_succesful($email) {
    if (user_select($email)) {
        return true;
    } else {
        return false;
    }
}
?>