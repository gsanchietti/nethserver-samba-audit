<?php
  session_start();
  header ('Content-type: text/html; charset=utf-8');

//Load Main config file
  require("config/config.php");
//Include main Info arrays
  include("config/actions.php");
//Include functions
  include("includes/functions.php");

//Include International Language support
$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
if(isset($lang) and file_exists("lang/$lang.php"))
   include("lang/$lang.php");
else
   include("lang/en.php");

//Connect to MySQL DataBase
  $db = smb_audit_pconnect($db_host, $db_user, $db_pass, $db_name);

//Debugging built query output
// echo "<br>select * ".$qtxt."<br>";

?>
<html>
<head>
<title><?php echo $title?></title>
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body  class='body' onload="{Init();}">
<?php @include("includes/functions.js"); ?>
<div class='wrapper'>
<div id='header'><h1><?php echo $title?></h1></div>
<div id='menu'>
<?php

 $cf = strtolower($_SERVER["SCRIPT_FILENAME"]);
 $ps = strrpos($cf,"/");
 if($ps===false)
 {
  $cf = trim($cf);
 }
 else
 {
  $cf = substr($cf,$ps+1);
 }

 echo " | ";
 foreach($my_menu as $key=>$val)
 {
  if($val==$cf)
    echo "<span class='current'>".$my_text[$key]."</span>";
  else
    echo "<a href=\"$val\">".$my_text[$key]."</a>";
  echo " | \n";
 }


#$last_update
$result = smb_audit_query("SELECT lastupdate FROM last_update LIMIT 1;");
if (!$result) $last_update="Unknow";
else {
	$row = mysql_fetch_assoc($result);
	$last_update = $row['lastupdate'];
	#hide year/month/day
	$last_update_splitted = split(" ", $last_update);
	if ( date("Y-m-d")==$last_update_splitted[0]) {$time = split(":",$last_update_splitted[1]); $last_update = $time[0].":".$time[1]; }
	else $last_update = $last_update_splitted[0];
}
?>

<a href='reload.php'><?php echo $my_text['Reload']; ?></a>

<span style="float: right; margin-right: 10px; color: #666"><?php echo $my_text['Last_update'].": ".$last_update ; ?></span>
</div>

