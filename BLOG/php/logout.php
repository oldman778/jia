<?php
session_start();
$_SESSION['user']=null;
echo "<script>alert('ιεΊζε');window.location.href='public_blog.php';</script>";exit;