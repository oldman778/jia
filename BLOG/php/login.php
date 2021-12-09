
<?php
$code=trim($_POST['code']);
$email=trim($_POST['email']);
$password=trim($_POST['password']);
if (empty($email) || empty($password) || empty($code)){
    echo "<script>alert('邮箱或者密码为空 请重新填写');history.back();</script>";exit;
}
session_start();
if (strtolower($code) != strtolower($_SESSION['code'])){
    echo "<script>alert('验证码不正确，请重新输入');history.back();</script>";exit;
}
$link=mysqli_connect('localhost','root','Jia123..','wssjk');
$sql="select id,email,password,name from my_user where email='$email' limit 1";
$query=mysqli_query($link,$sql);
$row=mysqli_fetch_assoc($query);
if (!$row){
    echo "<script>alert('你输入的邮箱有误，请重新确认');history.back();</script>";exit;
}else{
    if ($row['password']==md5($password)){
        $_SESSION['user']=$row;
        echo "<script>alert('登录成功');window.location.href='public_blog.php';</script>";exit;
    }else{
        echo "<script>alert('密码错误');history.back();</script>";exit;
    }
}