<?php
  session_start();
  
  error_reporting(0);

  require("config.php");
  $db=mysql_connect($dbhost,$dbuser,$dbpassword);
  mysql_select_db($dbdatabase,$db);
  mysql_query("set names 'utf8'");
?>
<!doctype html public "-//w3c//dtd html 4.01 transitional//en" "http://www.w3.org/tr/html4/loose.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title><?php echo $config_blogname;?></title>
  <link href="stylesheet.css" rel="stylesheet">
</head>
<body>
  <div id="header">
  <h1><?php echo $config_blogname;?></h1>
  </div>
 
  <div id="menu">
    <a href="<?php echo $config_basedir;?>">主页</a>
    &bull;
    <a href="<?php echo $config_basedir;?>about.php">关于</a>
    &bull;
    <a href="<?php echo $config_basedir;?>faq.php">常见问题</a>
    &bull;
    <a href="<?php echo $config_basedir;?>tech.php">技术细节</a>
    
    <?php
    if(isset($_SESSION['USERNAME'])){
      echo "[<a href='logout.php'>退出</a>]";
    }
    else {
      echo "[<a href='login.php'>登录</a>]";
    }
    
    if(isset($_SESSION['USERNAME'])){
      echo " - ";
      echo "[<a href='addentry.php'>添加文章</a>]";
      echo "[<a href='addcategory.php'>添加目录</a>]";
    }
    ?>


  </div>

  <div id="container">
     <div id="bar">
        <?php
             require("bar.php");
         ?>
     </div>
     <div id="main">

