<?php
$content=$_POST['content'];
$id=$_POST['id'];
$time=date('Y-m-d H:i;s',time());
if (empty($id)) {
    echo "<script>alert('请登录');window.location.href='../login.html';</script>";exit;
}else{
    if (empty($content)) {echo "<script>alert('请填写内容');history.back();</script>";exit;}
}
session_start();
if ($id!==$_SESSION['user']['id']) {
        echo "<script>alert('请登录');window.location.href='../login.html';</script>";exit;
}
$link=mysqli_connect('localhost','root','root','wssjk');
$sql="insert into my_wb(content,uid,create_time) value ('$content','$id','$time')";
$query=mysqli_query($link,$sql);
$row=mysqli_affected_rows($link);
if ($row==1) {
    echo "<script>alert('发表成功');history.back();</script>";exit;
}else{
    echo "<script>alert('发表失败');history.back();</script>";exit;
}