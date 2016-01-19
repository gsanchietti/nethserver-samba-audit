
SambaAudit is based on a Samb Audit project. See: http://sourceforge.net/projects/smbdaudit/

Current implementation uses standard full_audit vfs module instead of mysql_audit.

See: http://dev.nethesis.it

This software is freely distributable under the GNU public license, a
copy of which you should have received with this software (in a file
called COPYING). 


WHAT IS Samba Audit?
===================

Samba audit is a simple audit module for samba which uses vfs_full_audit module.
All operations are logged in a file and a logrotate job parses all entries and store it into a MySQL db.
Logs are browseable using web interface.


REQUIREMENTS
============

1. Samba - with VFS enabled(http://www.samba.org)

2. Database: MySQL(http://www.mysql.com)

3. Apache(http://httpd.apache.org/) or other PHP-capable browser

4. PHP(http://www.php.net)

5. Syslog or rsyslog


HOW IT WORKS
============

1) Enable samba full_audit: example of configuration in smb.conf
2) Configure rsyslog to store audit lines in a separate file: copy smbaudit-rsyslog.conf in /etc/rsyslog.d
3) Create the db: from the sql dir, execute mysql < smbaudit.sql
4) Enable the web interface: copy smbaudit.conf in /etc/httpd/conf.d
5) Copy sudeors config into /etc/sudoers.d directory
7) Create a cron or logrotate job to invoke the parser on files

QUESTIONS
=========

Original author:
Mail author Anatoliy Okhotnikov <acidumirae@yandex.ru>

New implementation:
Giacomo Sanchietti <giacomo.sanchietti@nethesis.it>

ORIGINAL CREDITS
=======

* PostgreSQL support and Portuguese translation by Jonis Maurin Ceara 
  http://softwarelivre.mouralacerda.edu.br/conteudo.php?pid=13
* Polish translation by Marcin Sołoguba <marsol@o2.pl>
* Spanish translation by Fabio Bettiol <fabiobettiolm@cantv.net> 
* German translation by Axel Gembe aka xagox
