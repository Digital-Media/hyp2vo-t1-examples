<?php
session_start();

define ("TOKEN", "_token");

function printToken() {
    $token = uniqid(session_id());
    $_SESSION[TOKEN] = $token;
    echo '<input type="hidden" name="' . TOKEN . '" value="' . $token . '">' . PHP_EOL;
}

function isTokenValid() {
    return (strlen($_POST[TOKEN]) > 0 && isset($_SESSION[TOKEN]) && strcmp($_POST[TOKEN], $_SESSION[TOKEN]) === 0);
}

function invalidateToken() {
    unset($_SESSION[TOKEN]);
}