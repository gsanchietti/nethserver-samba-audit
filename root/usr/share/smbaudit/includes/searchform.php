<form name="search_audit" id="search_audit" method="post">
<fieldset><legend><?php echo $my_text['Search'];?></legend>
<table id='search'>
<input type="hidden" name="qtxt" value="<?php echo $qtxt;?>">
<tr>
        <td><label><?php echo $my_text['User'];?>:</label></td>
        <td> <input type='text' name='username' value="<?php echo $username ?>"/></td>
        <td><label><?php echo $my_text['Address'];?>:</td>
        <td><input type="text" name="useraddr" value="<?php echo $useraddr;?>"></td><!-- " -->
</tr>
<tr>
        <td><label><?php echo $my_text['Share'];?>:</label></td>
        <td><input type='text' name="sharenum" value="<?php echo urldecode($sharenum) ?> "></td>
<td><label><?php echo $my_text['Action']; ;?>:</label></td>
<td><select name='type_act'>
<option value='0' <?php echo ($type_act==0?'selected':'')?>><?php echo $my_text['All_f'];?></option>
<?php
  require_once("config/actions.php");

  foreach($select_actions as $value)
  {
    if($value == $type_act)
	$selected = " selected='selected' ";
    else
	$selected="";

    echo "<option $selected value='$value'>".$my_text[$value]."</option>";
  }
?>
</select></td>
</tr>
<tr>
        <td><label><?php echo $my_text['Path'];?>:</label></td>
        <td><input type=text name="message" style='width: 250px' value="<?php echo urldecode($message);?>"> </td><!-- " -->
        <td><label><?php echo $my_text['Show'];?></label></td>
        <td><select name="num">
<?php
	$min_year = date("Y")-5; 
	
  for($i=20;$i<60;$i+=10)
  {
   echo "<option value=".$i;
   if($i==$num)
        echo " selected='selected'";
   echo ">".$i."</option>";
  }
?>
<option value='-1' <?php echo ($num==-1)?'selected="selected"':''; ?>><?php echo $my_text['All_m'];?></option>
</select><span class='small'> <?php echo $my_text['results']." ".$my_text['per page'];?></span>
</td>
</tr>
<tr>
        <td><input type="checkbox"
                   name="from"
                   value="1"
                   <?php if(isset($from) and $from==1) echo "checked";?>
                   onclick="{
 if(this.checked)
 {
  document.getElementById('fday').disabled=false;
  document.getElementById('fmon').disabled=false;
  document.getElementById('fyear').disabled=false;
 }
 else
 {
  document.getElementById('fday').disabled=true;
  document.getElementById('fmon').disabled=true;
  document.getElementById('fyear').disabled=true;
 }
}"> <label><?php echo $my_text['From'];?><label></td>
        <td><select id='fday' name="fday"><?php
  for($i=1;$i<32;$i++)
  {
   echo "<option value=".$i;
   if($i==$fday)
        echo " selected";
   echo ">".$i."</option>";
  }
        ?></select><select id="fmon" name="fmon"><?php
  for($i=1;$i<13;$i++)
  {
   echo "<option value=".$i;
   if($i==$fmon)
        echo " selected";
   echo ">".$months[$i]."</option>";
  }
        ?></select><select id="fyear" name="fyear"><?php
  $fy=date("Y");
  for($i=$fy;$i>=$min_year;$i--)
  {
   echo "<option value=".$i;
   if($i==$fyear)
        echo " selected";
   echo ">".$i."</option>";
  }
        ?></select></td>
        <td><input type="checkbox"
                   name="tod"
                   value="1"
                   <?php if(isset($tod) and $tod==1) echo "checked";?>
                                      onclick="{
 if(this.checked)
 {
  document.getElementById('tday').disabled=false;
  document.getElementById('tmon').disabled=false;
  document.getElementById('tyear').disabled=false;
 }
 else
 {
  document.getElementById('tday').disabled=true;
  document.getElementById('tmon').disabled=true;
  document.getElementById('tyear').disabled=true;
 }
}"> <label><?php echo $my_text['To'];?></label></td>
        <td><select id="tday" name="tday"><?php
  for($i=1;$i<32;$i++)
  {
   echo "<option value=".$i;
   if($i==$tday)
        echo " selected";
   echo ">".$i."</option>";
  }
        ?></select><select id="tmon" name="tmon"><?php
  for($i=1;$i<13;$i++)
  {
   echo "<option value=".$i;
   if($i==$tmon)
        echo " selected";
   echo ">".$months[$i]."</option>";
  }
        ?></select><select id="tyear" name="tyear"><?php
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
<tr>
        <td colspan="4" class='button'><input type='hidden' name='entrant' value='1'/><input type="submit" value="<?php echo $my_text['Search'];?>"></td><!-- " -->
</tr>
</table>
</fieldset>
</form>
