<?php
    $data = $_SESSION;
    unset($_SESSION["fn"]);
    unset($_SESSION["ln"]);
    unset($_SESSION["login"]);
    unset($_SESSION["user_id"]);
    unset($_SESSION["crud_editing_id"]);
?>