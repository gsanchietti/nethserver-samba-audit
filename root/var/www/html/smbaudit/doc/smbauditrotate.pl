#!/usr/bin/suidperl
$ENV{PATH} = '/usr/local/bin:/usr/sbin:/bin'; 
$< = $>; 
my $res =system "/usr/sbin/logrotate -f /etc/logrotate.d/smbaudit 2>&1";
($res) = ($res =~ /^(.*)$/g);
`/bin/logger -p local0.notice Rotating smbaudit logs \"$res\"`;

