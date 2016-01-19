<?php 
system ("sudo /usr/sbin/logrotate -f /etc/logrotate.d/smbaudit");
header("Location: index.php");
?>

