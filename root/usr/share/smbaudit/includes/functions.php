<?php

function get_var($var,$def='') {
 global $_REQUEST;
 if(isset($_REQUEST[$var]))
    return str_replace("'","\\'",trim($_REQUEST[$var]));
 else
    return $def;
}

function get_var_u($var,$def='') {
 global $_REQUEST;
 if(isset($_REQUEST[$var]))
    return $_REQUEST[$var];
 else
    return $def;
}

function smb_audit_pconnect($host, $user, $pass, $database) {
	$c = mysql_pconnect($host, $user, $pass);
	if($c) {
	    mysql_select_db($database);
	}
	return $c;
}

function  smb_audit_query($q) {
	return mysql_query($q);
}

function  smb_audit_num_rows($q) {
	if($q)
		return mysql_num_rows($q);
	return 0;
}

function  smb_audit_fetch_assoc($q) {
	return mysql_fetch_assoc($q);
}

function  smb_audit_fetch_array($q) {
	return mysql_fetch_array($q);
}

function  smb_audit_close($c) {
	return mysql_close($c);
}

function  smb_audit_affected_rows() {
	return mysql_affected_rows();
}

function  smb_audit_error() {
	return mysql_error();
}
?>
