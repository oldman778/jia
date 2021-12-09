<?php
$name=trim($_POST['username']);
$email=trim($_POST['email']);
$pass=trim($_POST['password']);
$new_pass=trim($_POST['new_password']);
if (empty($name) || empty($email) || empty($pass) || empty($new_pass)) {
    echo "<script>alert('有空值');history.back();</script>"; exit;
}else{
    if ($pass!= $new_pass) {
        echo "<script>alert('你两次输入的密码不相同');history.back();</script>"; exit;
    }else{
        $link=mysqli_connect('localhost','root','Jia123..','wssjk');
        $sql="select * from my_user where email='$email'";
        $query=mysqli_query($link,$sql);
        $row=mysqli_fetch_row($query);
        $password=md5(trim($pass));
        if (!$row) {
            $sql="insert into my_user(name,email,password) value('$name','$email','$password')";
            $query=mysqli_query($link,$sql);
            $row=mysqli_affected_rows($link);
            if ($row>0) {
                echo "<script>alert('注册成功');window.location.href='../login.html';</script>"; exit;
            }else{
                echo "<script>alert('注册失败');history.back();</script>"; exit;
            }
        }else{
                echo "<script>alert('你输入的邮箱已经注册');history.back(lo);</script>"; exit;
        }
    }
}