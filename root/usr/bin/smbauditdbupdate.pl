#!/usr/bin/perl

#
# Copyright (C) 2013 Nethesis S.r.l.
# http://www.nethesis.it - support@nethesis.it
# 
# This script is part of NethServer.
# 
# NethServer is free software: you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation, either version 3 of the License,
# or any later version.
# 
# NethServer is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
# 
# You should have received a copy of the GNU General Public License
# along with NethServer.  If not, see <http://www.gnu.org/licenses/>.
#

use DBI;
use warnings;
use strict;

my $username = "smbd";
my $password = "smbpass";
$password =~ s/\n//g;
my $dsn = "dbi:mysql:smbaudit:localhost";
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
                # delete records lack of one field
                if (!defined($ARG)) {
                    $MODE =~ s/\n//g;
                    $ARG = $MODE;
                } else {
                    $ARG =~ s/\n//g;
                    # handle open in read/write
                    if ($MODE eq 'r' || $MODE eq 'w') {
                        $ARG = $MODE."|".$ARG;
                    }
                }
                if ($OPERATION eq 'rename') {
                    my $tmp = (split (/\|/, $_))[-1];
                    chomp $tmp;
                    $ARG = "$MODE|".$tmp;
                }
		$sth = $dbh->prepare("INSERT INTO audit SET `when`=?,share=?,ip=?,user=?,op=?,result=?,arg=?");
		$sth->execute($DATE,$SHAREPATH,$IP,$USER,$OPERATION,$RESULT,$ARG) or die "Cannot execute sth: $DBI::errstr";
                }
}

$sth = $dbh->prepare("TRUNCATE TABLE last_update");
$sth->execute() or die "Cannot truncate last_update: $DBI::errstr";
$sth = $dbh->prepare("INSERT INTO last_update SET lastupdate=now()");
$sth->execute() or die "Cannot update last_update time: $DBI::errstr";

$dbh->disconnect();


