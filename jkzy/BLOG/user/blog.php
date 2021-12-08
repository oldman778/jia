<?php
$id=$_GET['uid'];
$link=mysqli_connect('localhost','root','Jia123..','wssjk');
$sql="select * from my_wb where uid=$id order by id desc";
$query1=mysqli_query($link,$sql);

$data=[];
while ($row=mysqli_fetch_assoc($query1)){
    array_push($data,$row);
}

session_start();
if ($_SESSION['user']) {
    $sql2="select otherId from my_other where uid={$_SESSION['user']['id']}";
    $query2=mysqli_query($link,$sql2);
    $others=[];
    while ($other=mysqli_fetch_assoc($query2)){
        array_push($others,$other['otherId']);
    }
}  
$sql3="SELECT o.otherId,u.name from my_other as o left JOIN my_user as u on o.otherId=u.id where o.uid=$id";
$query3=mysqli_query($link,$sql3);
$gZDate=[];
while ($gz=mysqli_fetch_assoc($query3)){
    array_push($gZDate,$gz);
}

$sql4="SELECT o.otherId,o.uid,u.name from my_other as o left JOIN my_user as u on o.uid=u.id where o.otherId=$id;";
$query4=mysqli_query($link,$sql4);
$fsDate=[];
while ($fs=mysqli_fetch_assoc($query4)) {
    array_push($fsDate,$fs);
}

mysqli_close($link);

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Document</title>
	<link rel="stylesheet" href="../css/common.css" />
	<link rel="stylesheet" href="../css/blog.css" />
</head>
<body>
	<header>
		<nav>
			<span class="class">
                <a href="../php/public_blog.php">网络2032</a>
            </span>
			<ul class="user">
            <?php if ($_SESSION['user']){ ?>
                    <li><a href="../php/logout.php">退出</a></li>
                    <li><a href="../user/blog.php?uid=<?php echo $_SESSION['user']['id']?>"> 动态 </a></li>
                    <?php if ($_SESSION['user']['id']!=$id) { ?>
                        <?php if (in_array($id,$others)) { ?>
                            <li><a href="unsubscribe.php?otherId=<?php echo $id ?>">取关</a></li>
                        <?php }else{ ?>
                            <li><a href="subscribe.php?otherId=<?php echo $id ?>">关注</a></li>
                        <?php } ?>
                    <?php } ?>
                    <li><a href=""><?php echo $_SESSION['user']['name'] ?></a></li>
                <?php }else{ ?>
                    <li><a href="../login.html">登录</a></li>
                    <li><a href="../regedit.html">注册</a></li>
                <?php } ?>
			</ul>
		</nav>
	</header>
	<div class="message_box">
		<div class="bigbox">
			<h1>动态展示</h1>
            <?php if ($id==$_SESSION['user']['id']) { ?> 
			<form action="publish.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $_SESSION['user']['id'] ?>">
                    <textarea name="content" cols="120" rows="10" class="textarea"></textarea>
                    <button type="submit" class="publish">发表</button>                
			</form>
            <?php }?>
			<div class="mess">
                <ul class="my_blog">
                    <?php foreach ($data as $value){ ?>
                    <li>
                        <?php echo $value['content']; ?>
                    </li>
                    <li class="blogDelete">
                        <?php echo $value['create_time'] ?>
                        <?php if ($_SESSION['user'] && $_SESSION['user']['id']==$id) { ?>
                        <a href="blogDelete.php?wid=<?php echo$value['id'] ?>">删除</a>
                    </li>
                    <?php } ?>
                    <?php } ?>
                </ul>
			</div>
		</div>
		<div class="list_box">
			<ul class="btns">
				<li class="active_1" tabindex="1">粉丝列表</li>
				<li class="active_2" tabindex="2">关注列表</li>
			</ul>
			<div class="list_inner">
				<div>
                    <ul>
                        <?php foreach ($fsDate as $val) { ?>
                        <li><a href="?uid=<?php echo $val['uid'] ?>"><?php echo $val['name'] ?></a></li>
                        <?php } ?>
                    </ul>
				</div>
				<div>
                    <ul>
                        <?php foreach ($gZDate as $val) { ?>
                        <li><a href="?uid=<?php echo $val['otherId'] ?>"><?php echo $val['name'] ?></a></li>
                        <?php } ?>
                    </ul>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<script>
	var ul = document.getElementsByClassName("btns")[0];
	var lis = ul.getElementsByTagName("li");
	var div = document.getElementsByClassName("list_inner")[0];
	var divs = div.getElementsByTagName("div");
	for(var i = 0; i<lis.length;i++){
		lis[i].index = i;
		lis[i].onclick = function (){
			console.log(this.index);
			for(var j=0;j<divs.length;j++){
				divs[j].style.display="none";
			}
			divs[this.index].style.display="block";
		}
	}
</script>