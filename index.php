<?php
@ob_start();
session_start();
require "Register.php";
$object = new Register();
    if (isset($_GET["logout"])) {
    $object->logOut();
    }
if (isset($_POST["submit_register"])) {
    $a = $object->registerUser($_POST);
    if ($a == "OK") {
        header("Location: account.php");

    } else {
        echo $a;
    }
} elseif (isset($_POST["submit_login"])) {
    $a = $object->login($_POST["email"], $_POST["password"]);
    if ($a) {
        header("Location: account.php");
    }
} else {
    echo $object->drawRegisterForm();
} ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link href="style/style.css" rel="stylesheet">
</head>
<body>
<?php


//  echo  $object->drawRegisterForm();


?>
</body>
</html>





