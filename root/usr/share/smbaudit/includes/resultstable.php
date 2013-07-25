<?php 

function strong($str) 
{
    return "<span style='font-weight: bold'>$str</span>";
}

function getDescription($op,$msg,$arg)
{
  global $my_text;
  switch ($op)
  {
    case 'opendir':
	return $my_text['Open directory']." : ".strong($arg);
    case 'open':
	if($arg[0]=='r')
		return $my_text['Read file']." : ".strong(substr($arg,2));
	else if($arg[0]=='w')
		return $my_text['Write file']." : ".strong(substr($arg,2));
	else
		return $my_text['Other operation']." : ".$arg;
    case 'unlink':
	return $my_text['Delete file']." : ".strong($arg);
    case 'rmdir':
	return $my_text['Delete directory']." : ".strong($arg);
    case 'mkdir':
	return $my_text['Create directory']." : ".strong($arg);
    case 'rename':
        $tmp = explode('|',$arg);
	return $my_text['Rename']." : ".strong($tmp[0])." -> ".strong($tmp[1]);
    default:
	return $my_text['Other operation']." ($op - $arg)";
  }
}

$query="SELECT *,date_format(`when`,'%d/%m/%Y %H:%i:%s') as date ".$qtxt;

// debug query
// echo "<pre>$query</pre>";

$r=smb_audit_query($query); 
if($r and smb_audit_num_rows($r))
{
?>
<div style='padding-right: 10px;'>
<table class='results' cellspacing='0' >
<tr >
<th><?php echo $my_text['Date-Time']?></th>
<th><?php echo $my_text['User']?></th>
<th><?php echo $my_text['Address']?></th>
<th><?php echo $my_text['Share']?></th>
<th class='last'><?php echo $my_text['Action']?></th>
</tr>
<?php
 $i=0;
 while($f=smb_audit_fetch_array($r))
 {
  if($i%2==0)
    echo "<tr class='altrow'>";
  else
    echo "<tr class=''>";

  
  echo "<td>".$f['date']."</td>\n";
  echo "<td>".$f['user']."</td>\n";
  echo "<td>".$f['ip']."</td>\n";
  echo "<td>".$f['share']."</td>\n";
  $desc = getDescription($f['op'],$f['result'],$f['arg']);
  #red if operation fail
  if (strpos ($f['result'],"fail (") !== false ) {
        preg_match('/\(.*\)/',$f['result'],$err);
  	echo "<td class='last'><span style='color: red'>$desc $err[0]</span></td>\n";
  }
  else
  	echo "<td class='last'>$desc</td>\n";
  echo "</tr>\n";
  $i++;
 }
smb_audit_close($db);
echo "</table>
</div>";
} 
?>

