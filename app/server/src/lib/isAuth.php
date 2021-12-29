<?php

/**
 * @return bool check is user is auth by sessions variables
 */
function isAuth(): bool{
    if(!isset($_SESSION['auth']) || !isset($_SESSION['user_id'])) return false;
    else if ($_SESSION['auth'] === true) return true;
    else return false;
}