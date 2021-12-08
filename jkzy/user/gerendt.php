<?php
$id=$_GET['uid'];
$link=mysqli_connect('localhost','root','root','wssjk');
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/gerendt.css">
    <link rel="stylesheet" href="../css/index.css">
</head>
<body>
    <div class="header">
        <div class="header_center">
            <div class="left">
                <a href="../php/index.php">网络2032</a>
            </div>
            <?php session_start(); ?>
            <div class="right">
                <ul class="right_ul">
                <?php if ($_SESSION['user']){ ?>
                    <li><a href="../php/logout.php">退出</a></li>
                    <li><a href="../user/gerendt.php?uid=<?php echo $_SESSION['user']['id']?>"> 动态 </a></li>
                    <?php if ($_SESSION['user']['id']!=$id) { ?>
                        <?php if (in_array($id,$others)) { ?>
                            <li><a href="quguan.php?otherId=<?php echo $id ?>">取关</a></li>
                        <?php }else{ ?>
                            <li><a href="guanzhu.php?otherId=<?php echo $id ?>">关注</a></li>
                        <?php } ?>
                    <?php } ?>
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
            <div class="gz">
                    <ul>
                        <h3>关注列表</h3>
                        <?php foreach ($gZDate as $val) { ?>
                           <li><a href="?uid=<?php echo $val['otherId'] ?>"><?php echo $val['name'] ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            <div class="fs">
                    <ul>
                        <h3>粉丝列表</h3>
                        <?php foreach ($fsDate as $val) { ?>
                           <li><a href="?uid=<?php echo $val['uid'] ?>"><?php echo $val['name'] ?></a></li>
                        <?php } ?>
                    </ul>
            </div>
                <!--发表动态-->
                <?php if ($id==$_SESSION['user']['id']) { ?> 
                <div class="content_dt">              
                    <form action="publish.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $_SESSION['user']['id'] ?>">
                        <textarea name="content" cols="120" rows="10"></textarea>
                        <button type="submit">发表</button>
                    </form>                  
                </div>
                <?php } ?>
                <ul>
                    <?php foreach ($data as $value){ ?>
                        <li>
                            <?php echo $value['content']; ?>
                            <?php echo $value['create_time'] ?>
                            <?php if ($_SESSION['user'] && $_SESSION['user']['id']==$id) { ?>
                            <a href="DTDelete.php?wid=<?php echo$value['id'] ?>">删除</a>
                        <?php } ?>
                        </li>
                    <?php } ?>
                </ul>
            </div>
    </div>
</body>
</html>