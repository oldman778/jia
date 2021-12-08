<?php
session_start();
$_SESSION['user']=null;
echo "<script>alert('退出成功');window.location.href='index.php';</script>";exit;