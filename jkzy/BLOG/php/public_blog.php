<?php
$link=mysqli_connect('localhost','root','Jia123..','wssjk');
$sql='select w.id,w.content,w.create_time,u.name,u.id as uid
from my_wb as w left join my_user as u on w.uid=u.id order by w.id desc';
$query=mysqli_query($link,$sql);
$data=[];
while ($row=mysqli_fetch_assoc($query)){
    array_push($data,$row);
}
mysqli_close($link);
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Document</title>
	<link rel="stylesheet" href="../css/common.css" />
	<link rel="stylesheet" href="../css/public_blog.css" />
</head>
<body>
	<header>
		<nav>
			<span class="class">
                <a href="../php/public_blog.php">网络2032</a>
            </span>
            <?php session_start(); ?>
			<ul class="user">
            <?php if ($_SESSION['user']){ ?>
                    <li><a href="logout.php">退出</a></li>
                    <li><a href="../user/blog.php?uid=<?php echo $_SESSION['user']['id']?>"> 动态 </a></li>
                    <li><a href=""><?php echo $_SESSION['user']['name'] ?></a></li>
                <?php }else{ ?>
                    <li><a href="../login.html">登录</a></li>
                    <li><a href="../regedit.html">注册</a></li>
                <?php } ?>
			</ul>
		</nav>
	</header>
	<div class="subject">
        <h1>动态展示</h1>
         <div class="kernel">
            <ul>
                <?php foreach ($data as $value) { ?>
                <li class="name">
                        <a href="../user/blog.php?uid=<?php echo $value['uid']?>" ><?php echo $value['name'] ?>
                            <span class="create_time"><?php echo $value['create_time']; ?></span>
                        </a>
                </li>
                    <!-- <li class="create_time"></li> -->
                    <li class="content"><?php echo $value['content']; ?></li>
                <?php }?>
            </ul>     
        </div>
    </div>
</body>
</html>