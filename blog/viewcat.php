<?php
  
  require("config.php");
  
  if(isset($_GET['id'])==TRUE){
    if(is_numeric($_GET['id'])==FALSE){
      $error=1;
    }
    if($error==1){
      header("Location:".$config_basedir . "/viewcat.php");
    }
    else {
      $validcat = $_GET['id'];
    }
  }
  else {
    $validcat = 0;
  }
  
  require("header.php");
  
  $sql = "select * from categories ";
  $result = mysql_query($sql);
   

while($row = mysql_fetch_assoc($result)){
  if($validcat == $row['id']){
    echo "<strong>" . $row['cat'] . "</strong><br />";
    $entriessql = "select * from entries where cat_id = " . $validcat . " order by 
                  dateposted desc;";
    $entriesres = mysql_query($entriessql);
    $numrows_entries = mysql_num_rows($entriesres);

    echo "<ul>";
    if($numrows_entries == 0){
      echo "<li>No entries!</li>";
    }
    else {
      while($entriesrow = mysql_fetch_assoc($entriesres)){
        echo "<li>" . date("D JS F Y g.iA", strtotime($entriesrow['dateposted'])) . 
             " - <a href='viewentries.php?id=" . $entriesrow['id'] . "'>" . 
             $entriesrow['subject'] . "</a></li>";
      }
    }
    echo "</ul>";
  }
  else {
    echo "<a href='viewcat.php?id=" . $row['id'] . "'>" . $row['cat'] . "</a><br />";
  }
}

  require("footer.php");
?>