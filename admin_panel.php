<?php
require "Ebey.php";
$obj = new Ebay();

if (isset($_POST["create_shop"])){
    $obj->CreateShop($_POST);
}else{
    $obj->CreateShop();
}