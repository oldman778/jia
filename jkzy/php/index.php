<?php
$link=mysqli_connect('localhost','root','root','wssjk');
$sql='select w.id,w.content,w.create_time,u.name,u.id as uid
from my_wb as w left join my_user as u on w.uid=u.id order by w.id desc';
$query=mysqli_query($link,$sql);
$data=[];
while ($row=mysqli_fetch_assoc($query)){
    array_push($data,$row);
}
mysqli_close($link);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/index.css">
</head>
<body>
    <div class="header">
        <div class="header_center">
            <div class="left">
                <a href="">网络2032</a>
            </div>
            <?php session_start(); ?>
            <div class="right">
                <ul class="right_ul">
                <?php if ($_SESSION['user']){ ?>
                    <li><a href="logout.php">退出</a></li>
                    <li><a href="../user/gerendt.php?uid=<?php echo $_SESSION['user']['id']?>"> 动态 </a></li>
                    <li><a href=""><?php echo $_SESSION['user']['name'] ?></a></li>
                <?php }else{ ?>
                    <li><a href="../login.html">登录</a></li>
                    <li><a href="../enroll.html">注册</a></li>
                <?php } ?>
                </ul>
            </div>
        </div>
            <h1>动态</h1>
            <div class="content">
                <div class="kernel">
                    <ul>
                        <?php foreach ($data as $value) { ?>
                            <a href="../user/gerendt.php?uid=<?php echo $value['uid']?>"><?php echo $value['name'] ?></a>
                            <li class="create_time"><?php echo $value['create_time']; ?></li>
                            <li class="content"><?php echo $value['content']; ?></li>
                    <?php }?>
                    </ul>
                </div>
                
            </div>
    </div>
</body>
</html>