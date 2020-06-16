<?php
require 'User.php';
session_start();
    if (isset($_SESSION["is_logged_in"])
        && $_SESSION["is_logged_in"] == "1"
        && isset($_SESSION["user_id"]))
    {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link href="style/style.css" rel="stylesheet">
</head>
<body>
<a href="index.php?logout">Logout</a>
<?php


$user_id = $_SESSION['user_id'];
$user = new User();
$data = $user->getUserData($user_id);
foreach ($data as $key => $value) {
    if ($key == "image") {
        ?>
        <img src="images/<?= $value ?>">
        <?php
    }
    ?>
    <div>
        <span><?php echo ucfirst($key) ?>:</span>
        <span><?php echo $value ?></span>

    </div>
    <a href="admin_panel.php"></a>
    <?php
}

echo $user->drawUpdateForm();

if (isset($_POST["submit_update"])) {

    $user->updateUser($_POST, $user_id);

}

} else {
    header("location: index.php");
}

?>
</body>
</html>
