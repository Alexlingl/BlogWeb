<?php
  require("header.php");
  
  $sql = "select entries.*, categories.cat from entries,categories
    where entries.cat_id=categories.id
    order by dateposted desc
    limit 1;";
  $result = mysql_query($sql);
  $row = mysql_fetch_assoc($result);
  //print_r($row);

  echo "<h2><a href='viewentry.php?id=".$row['id']."'>".$row['subject']."</a></h2><br />";
  echo "<i>In <a href='viewcat.php?id=".$row['cat_id']."'>".$row['cat']."</a>-Posted on " .     date("D JS F Y g.iA",strtotime($row['dateposted']))."</i>";
 
  if(isset($_SESSION['USERNAME'])){
    echo " [<a href='updateentry.php?id=" . $row['id'] ."'>修改编辑文章</a>]";
  }
  

  echo "<p>";
  echo nl2br($row['body']);
  echo "</p>";

  echo "<p>";
  $commsql = "select name from comments where blog_id=".$row['id']." order by dateposted;";
  $commresult= mysql_query($commsql);
  $numrows_comm=mysql_num_rows($commresult);

  if($numrows_comm==0){
    echo "<p>No comments.</p>";
  }
  else{
    echo "(<strong>".$numrows_comm."</strong>) commments : ";
    $i=1;
    while($commrow=mysql_fetch_assoc($commresult)){
      echo "<a href='viewentry.php?id=".$row['id']."#comment".$i."'>".$commrow['name']."</a> "; 

    $i++;
    }
  }
  echo"</p>";
  
  $prevsql = "select entries.*, categories.cat from entries,categories
    where entries.cat_id=categories.id
    order by dateposted desc
    limit 1,5;";
  $prevresult=mysql_query($prevsql);
  $numrows_prev=mysql_num_rows($prevresult);

  if($numrows_prev==0){
    echo"<p>No previous entries.</p>";
  }
  else {
    echo "<ul>";
    
    while($prevrow = mysql_fetch_assoc($prevresult)){
    echo "<li><a href='viewentry.php?id=".$prevrow['id']."'>".$prevrow['subject']."</a></li>";
    }
  }
  echo "</ul>";


  require("footer.php");
?>

