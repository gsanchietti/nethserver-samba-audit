#!/usr/bin/perl
use DBI;
use warnings;
use strict;

my $username = "root";
my $password = `cat /etc/my.pwd`;
$password =~ s/\n//g;
my $dsn = "dbi:mysql:smbd:localhost";
my $dbh = DBI->connect($dsn,$username,$password) or die "Cannot connect to database: $DBI::errstr";

my $LOGFILE='/var/log/smbaudit.log';
my $TAG;
my $DATE;
my $USER;
my $USER2;
my $IP;
my $SHAREPATH;
my $OPERATION;
my $RESULT;
my @SHARE;
my $FILEPATH;
my $sth;
my $MODE;
my $ARG;
my $op_msg = "";
open FILE, $LOGFILE or die $!;
while (<FILE>) {
	if ($_ =~ /smbauditlog/ )
                {
                ($TAG,$DATE,$USER,$IP,$SHAREPATH,$USER2,$OPERATION,$RESULT,$MODE,$ARG) = split (/\|/, $_);
                $ARG =~ s/\n//g unless !defined($ARG);
                @SHARE = split (/\//,$SHAREPATH);
	 	
		$sth = $dbh->prepare("INSERT INTO audit SET `when`=?,share=?,ip=?,unix_name=?,connectpath=?,sanitized_username=?,op=?,result=?,mode=?,arg=?");
		$sth->execute($DATE,$SHARE[5],$IP,$USER,$SHAREPATH,$USER2,$OPERATION,$RESULT,$MODE,$ARG) or die "Cannot execute sth: $DBI::errstr";
                }
}

$sth = $dbh->prepare("TRUNCATE TABLE last_update");
$sth->execute() or die "Cannot truncate last_update: $DBI::errstr";
$sth = $dbh->prepare("INSERT INTO last_update SET lastupdate=now()");
$sth->execute() or die "Cannot update last_update time: $DBI::errstr";

$dbh->disconnect();


