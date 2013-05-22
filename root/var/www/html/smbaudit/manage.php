<?php

  include('includes/header.php');
   
  $go    = get_var('go');
  $purge = get_var('purge');
  $from  = get_var('from');
  $tod   = get_var('tod');

  $fday  = get_var('fday');
  $fmon  = get_var('fmon');
  $fyear = get_var('fyear');

  $tday  = get_var('tday');
  $tmon  = get_var('tmon');
  $tyear = get_var('tyear');


  //We are going to purge something
  if($purge>0)
  {
    $qtxt = "DELETE FROM audit WHERE id>0 ";
    if($purge==2)
    {
	$qtxt.=" AND `when`>='$fyear-$fmon-$fday 00:00:00'"; 
	$qtxt.=" AND `when`<='$tyear-$tmon-$tday 23:59:59'";
    }
     $r = smb_audit_query($qtxt);

    //Debugging built query output 
    #echo "<pre>$qtxt</pre>";
    echo "<div class='message'>".$my_text["Deleted"]." ".smb_audit_affected_rows()." ".$my_text["log rows"]."</div>";
  }
  $min_year = date("Y")-5; 
?>
<script>
 function disable()
 {
    document.getElementById('fday').disabled=true;
    document.getElementById('fmon').disabled=true;
    document.getElementById('fyear').disabled=true;
    document.getElementById('tday').disabled=true;
    document.getElementById('tmon').disabled=true;
    document.getElementById('tyear').disabled=true;
  
 }
 
  function enable()
 {
 
    document.getElementById('fday').disabled=false;
    document.getElementById('fmon').disabled=false;
    document.getElementById('fyear').disabled=false;
    document.getElementById('tday').disabled=false;
    document.getElementById('tmon').disabled=false;
    document.getElementById('tyear').disabled=false;
  
 }
</script>
<form method='post' style='width: 30%' name='search' id='search' action='?'>
<fieldset><legend><?php echo $my_text["Delete log"]; ?></legend>
<table id='search' >
<tr>
<td colspan='2'>
<input type='radio' name='purge' id='purge' value='1' checked='checked' onclick='disable()' > <?php echo $my_text['Everything']?>
</td>
</tr>
<tr>
<td >
<input type='radio' name='purge' value='2' onclick="enable()"><?php echo $my_text['Only']?></td></tr><tr><td>
<?php echo $my_text['From'];?></td><td>
        <select name="fday" id="fday"><?php
  for($i=1;$i<32;$i++)
  {
   echo "<option value=".$i;
   if($i==$fday) 
        echo " selected";
   echo ">".$i."</option>";
  }
        ?></select><select name="fmon"  id="fmon"><?php
  for($i=1;$i<13;$i++)
  {
   echo "<option value=".$i;
   if($i==$fmon) 
        echo " selected";
   echo ">".$months[$i]."</option>";
  }
        ?></select><select name="fyear" id="fyear"><?php
  $fy=date("Y");
  for($i=$fy;$i>=$min_year;$i--)
  {
   echo "<option value=".$i;
   if($i==$fyear) 
        echo " selected";
   echo ">".$i."</option>";
  }
        ?></select></td>
	</tr>
	<tr>
        <td>
<?php echo $my_text['To'];?></td><td>
        <select name="tday" id="tday"><?php 
  for($i=1;$i<32;$i++)
  {
   echo "<option value=".$i;
   if($i==$tday) 
        echo " selected";
   echo ">".$i."</option>";
  }
        ?></select><select name="tmon" id="tmon"><?php
  for($i=1;$i<13;$i++)
  {
   echo "<option value=".$i;
   if($i==$tmon) 
        echo " selected";
   echo ">".$months[$i]."</option>";
  }
        ?></select><select name="tyear" id="tyear"><?php
  $fy=date("Y");
  for($i=$fy;$i>=$min_year;$i--)
  {
   echo "<option value=".$i;
   if($i==$tyear) 
        echo " selected";
   echo ">".$i."</option>";
  }
        ?></select></td>
</tr>
</table>
</td>
</tr>
</table>

<script language="JavaScript">
 disable();
</script>
<input type='submit' value='<?php echo $my_text['Delete']; ?>' onclick="return confirm('<?php echo $my_text['Delete selected log']; ?>?');">
</fieldset>
</form>
<div class="push"></div>
</div>
<?php
//Show footer
   include("includes/footer.php"); 
?>
</body>
</html>

