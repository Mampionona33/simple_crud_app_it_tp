<?php
function connect_db()
{
    $user = "root";
    $pass = "";
    $dbname = "myproject";
    $host = "127.0.0.1";
    $dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;
    try {
        return new PDO($dsn, $user, $pass);
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
}
