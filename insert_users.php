<?php
require_once "config.php";
//
$disName = "Sarah McLennan";
$uName = "sarah";
$password = "sarah123";
//
$sql = "INSERT INTO users (u_name, dis_name, pass_h) VALUES (?, ?, ?)";
//
if($stmt = mysqli_prepare($link, $sql))
{
    mysqli_stmt_bind_param($stmt, "sss", $param_u_name, $param_dis_name, $param_pass_h);
    //
    $param_u_name = $uName;
    $param_dis_name =$disName;
    $param_pass_h = password_hash($password, PASSWORD_DEFAULT);
    //
    if(mysqli_stmt_execute($stmt))
    {
        echo "Successful";
    }
    else
    {
        echo "DB unreachable";
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($link);
?>