<?php
$otherId=$_GET['otherId'];
session_start();
$uid=$_SESSION['user']['id'];
$link=mysqli_connect('localhost','root','Jia123..','wssjk');
$sql="delete from my_other where uid=$uid and otherId=$otherId";
$query=mysqli_query($link,$sql);
$row=mysqli_affected_rows($link);
if ($row) {
    echo "<script>alert('取关成功');history.back();</script>";exit;
}else{
    echo "<script>alert('取关失败');history.back();</script>";exit;
}