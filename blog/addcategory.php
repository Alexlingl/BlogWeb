<?php
  
  session_start(); 
  error_reporting(0);

  require("config.php");

    $db = mysql_connect($dbhost,$dbuser,$dbpassword);
    mysql_select_db($dbdatabase,$db);
    mysql_query("set names 'utf8'");
  if(!isset($_SESSION['USERNMAE'])){
    header("Location :" . $config_basedir);
  }

  if($_POST['submit']){
   
    $sql = "insert into categories (cat) VALUES ('" . $_POST['category'] ."');";
  
    mysql_query($sql);

    header("Location: " . $config_basedir);
  }
  else{
    require("header.php"); 
  ?>


<h1>Add new categries</h1>
<form action="<?php echo $_SERVER['SCRIPT_NAME'] ?>" method="post">

<table>
<tr>
  <td>Categoties</td>
  <td><input type="text" name="category"></td>
</tr>
<tr>
  <td></td>
  <td><input type="submit" name="submit" value="Add Category"></td>
</tr>
</table>
</form>

<?php
}
  require("footer.php");
?>