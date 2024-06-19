<?php
include_once "../models/functions.php";
$name_category=$_POST["name_category"];
$status=1;



if(add_category($name_category, $status))
{
    echo '<script>alert("Se creó exitosamente");</script>';
    echo '<script>window.location.href = "../views/crud_category.php";</script>';
}