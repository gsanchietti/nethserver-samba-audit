<?php
 
 include('includes/header.php');

 $num   = get_var('num');
 
 $from  = get_var('from');
 $fday  = get_var('fday');
 $fmon  = get_var('fmon');
 $fyear = get_var('fyear');
 
 $tod   = get_var('tod');
 $tday  = get_var('tday');
 $tmon  = get_var('tmon');
 $tyear = get_var('tyear');

 $start = get_var('start',0);
 
 $username = get_var('username');
 $useraddr = get_var('useraddr');
 $sharenum = get_var('sharenum');
 $type_act = get_var('type_act',-1);
 $message  = get_var('message');

//Build Query from Search Options    
 require("includes/buildquery.php");
//Build Search Results Navigation Bar
 include("includes/buildnav.php");
//Show Search Form
 include("includes/searchform.php");
//Show Search Results Navigation Bar
echo $sstr;

//Prepare Built Query For Execution
  $qtxt.=" order by `when` DESC";

$currentPage = (!empty($_GET['entrant'])) ? $_GET['entrant'] : 1;
$startOffset = (int) ($currentPage-1) * $perPage;
$range = $num;

//add limit
$qtxt.= " limit ".$startOffset.",".$perPage;

?>

<?php
//Show Results
   require("includes/resultstable.php");
?>
<div class="push"></div>
</div>
<?php

//Show footer
   include("includes/footer.php"); 
?>

</body>
</html>
