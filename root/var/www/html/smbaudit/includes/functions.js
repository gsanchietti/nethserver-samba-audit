<script language="javascript">
// <!-- 

function Init()
{
 if(!document.getElementById("search_audit"))
  return;
 if(!document.getElementById("search_audit").from.checked)
 {  
  document.getElementById("search_audit").fday.disabled=true;
  document.getElementById("search_audit").fmon.disabled=true;
  document.getElementById("search_audit").fyear.disabled=true;
 }
 if(!document.getElementById("search_audit").tod.checked)
 {
  document.getElementById("search_audit").tday.disabled=true;
  document.getElementById("search_audit").tmon.disabled=true;
  document.getElementById("search_audit").tyear.disabled=true;
 }
}
// -->
</script>
