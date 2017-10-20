<?php
 require_once("config/actions.php");

 $qtxt=" from audit where id>0 ";

 if($username!="")
        $qtxt.=" and user like '%$username%'";

 if(isset($useraddr) and $useraddr<>"")
        $qtxt.=" and ip like('%".$useraddr."%')";

 if($sharenum) {
  		
        $qtxt.=" and share='".urldecode($sharenum)."'";
 }

  //Map action selection to a set of operations
 if(isset($type_act) and $type_act!="" and $type_act!="0")
 {   
    switch($type_act)
    {
	case 'OPEN_DIR':
		$qtxt.= " and op='opendir' ";
	break;

	case 'OPEN_FILE':
		$qtxt.= " and op='open' ";
	break;
	case 'EDIT_FILE':
		$qtxt.= " and op='write' ";
	break;
	case 'DELETE_FILE':
		$qtxt.= " and op='unlink' ";
	break;
	case 'RENAME':
		$qtxt.= " and op='rename' ";
	break;
	case 'CREATE_DELETE_DIR':
		$qtxt.= " and (op='rmdir' or op='mkdir' ) ";
	break;
    }
 }

 if(isset($message) and $message != "")
        $qtxt.=" and arg like('%".urldecode($message)."%')";

 if(isset($from) and $from==1)
 {
    $qtxt.=" and `when`>='$fyear-$fmon-$fday 00:00:00'";
 }

 if(isset($tod) and $tod==1)
 {
    $qtxt.=" and `when`<='$tyear-$tmon-$tday 23:59:59'";
 }

?>
