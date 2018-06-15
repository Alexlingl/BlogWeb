<?php
  
  require("config.php");
  
  error_reporting(0);

  if(isset($_GET['id'])==TRUE){
    if(is_numeric($_GET['id'])==FALSE){
      $error=1;
    }
    if($error==1){
      header("Location:".$config_basedir);
    }
    else {
      $validentry = $_GET['id'];
    }
  }
  else {
    $validentry = 0;
  }
  
  if($_POST['submit']){
    $db = mysql_connect($dbhost,$dbuser,$dbpassword);
    mysql_select_db($dbdatabase,$db);
    mysql_query("set names 'utf8'");  

    $sql = "INSERT INTO comments(blog_id,dateposted,name,comment) VALUES(" .$validentry . 
           ", NOW(),'" . $_POST['name'] . "','" . $_POST['comment'] . "');";
    mysql_query($sql);

    header("Location:" .$config_basedir);
  }
  else {


  require("header.php");
  if($validentry == 0){
    $sql = "select entris.*,categories.cat from entries,categories ".
           "where entries.cat_id = categories.id ".
           "order by dateposted desc ".
           " limit 1;";
  }
  else {
    $sql = "select entries.*,categories.cat from entries,categories ".
           " where entries.cat_id = categories.id and entries.id = ".$validentry.
           " order by dateposted desc limit 1;";
  }
  $result = mysql_query($sql);
  
  $row = mysql_fetch_assoc($result);
  echo "<h2>" . $row['subject'] . "</h2><br />";
  echo "<i>In <a href='viewcat.php?id=" . $row['cat_id'] . "'>" . 
       $row['cat'] ."</a> - Posted on " .
       date("D JS F Y g.iA", strtotime($row['dateposted'])) ."</i>";
  echo "<p>";
  echo nl2br($row['body']);
  echo "</p>";

  $commsql = "select * from comments where blog_id=".$validentry." order by dateposted desc;";
  $commresult= mysql_query($commsql);
  $numrows_comm=mysql_num_rows($commresult);
  
  if($numrows_comm == 0) {
    echo "<p>No comments.</p>";
  }
  else {
    $i = 1;
   
    while($commrow = mysql_fetch_assoc($commresult)){
      echo "<a name='comment" . $i . "'>";
      echo "<h3>Comment by " . $commrow['name'] . " on " . date("D JS F Y g.iA",
           strtotime($commrow['dateposted'])) . "</h3>";
      echo $commrow['comment'];
      $i++;
    }
  }


?>

<h3>Leave a comment</h3>

<form action="<?php echo $_SERVER['SCRIPT_NAME'] . "?id=" . $validentry; ?>" method="post">
<table>
<tr>
  <td>Your name</td>
  <td><input type="text" name="name"></td>
</tr>
<tr>
  <td>Comments</td>
  <td><textarea name="comment" rows="10" cols="50"></textarea></td>
</tr>
<tr>
  <td></td>
  <td><input type="submit" name="submit" value="Login"></td>
</tr>
</table>
</form>

<?php
}
  require("footer.php");
?>