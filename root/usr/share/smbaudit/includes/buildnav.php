<?php
 require_once("Pager/Pager.php");

 if(!isset($start) or $start<0)
        $start=0;

 $q=smb_audit_query("select count(*) ".$qtxt);
 $sstr="";
 if(smb_audit_num_rows($q) and $f=smb_audit_fetch_array($q) and $f[0]>0)
 {
  $n=$f[0];
  $sstr="<div class='results'>".$n." ".$my_text['results were found']."<div>";

  if(!isset($num) || $num == 0)
    $num = 20;
  if($num==-1)
    $perPage = $n;
  else
    $perPage = $num;

  $params = array(
    'totalItems' => $n,
    'httpMethod' => 'GET',
    'perPage' => $perPage,      
    'delta' => 2,             // for 'Jumping'-style a lower number is better
    'append' => true,                                                        
    //'separator' => ' | ',                                                  
    'clearIfVoid' => false,                                                  
    'urlVar' => 'entrant',                                                   
    'useSessions' => true,                                                   
    'closeSession' => true,                                                  
    'mode'  => 'Sliding',    //try switching modes                         
    'extraVars' => array("username"=>$username,"sharenum"=>$sharenum,"num"=>$num,"useraddr"=>$useraddr,"type_act"=>$type_act,"message"=>str_replace(" ","%20",$message),
			 "fday"=>$fday, "fmon"=>$fmon, "fyear"=>$fyear, "tday"=>$tday, "tmon"=>$tmon, "tyear"=>$tyear, "from"=>$from, "tod"=>$tod )  
  );


  $pager = & Pager::factory($params);
  $links = $pager->getLinks();
  $sstr="<div class='results'>{$my_text['Pages']}:&nbsp;&nbsp;&nbsp;&nbsp; {$links['all']}</div>";
 }
 else
 {
  $sstr="<div class='results'>".$my_text['No results']." ".$my_text['were found']."</div>";
 }

?>
