<?php

session_start();

unset($_SESSION["id"]);

header("Location: /sign.php");