<?php

require_once "connect.php";

session_start();

$id = $_GET["id"];

$sql = "DELETE FROM `task` WHERE id = $id";

$result = mysqli_query($con, $sql);

if ($result) {
    $_SESSION["success_message"] = "Успех!";
    header("Location: /");
} else {
    $_SESSION["success_message"] = mysqli_error($con);
    header("Location: /");
}
