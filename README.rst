======================
nethserver-samba-audit
======================

SambaAudit is based on a Samb Audit project. See: http://sourceforge.net/projects/smbdaudit/

Current implementation uses standard full_audit vfs module instead of mysql_audit.

See: http://dev.nethesis.it

This software is freely distributable under the GNU public license, a
copy of which you should have received with this software (in a file
called COPYING). 


What is Samba Audit?
====================

Samba audit is a simple audit module for samba which uses vfs_full_audit module.
All operations are logged in a file and a logrotate job parses all entries and store it into a MySQL db.
Logs are browseable using web interface.


Requirements
============

1. Samba - with VFS enabled(http://www.samba.org)

2. Database: MySQL(http://www.mysql.com)

3. Apache(http://httpd.apache.org/) or other PHP-capable browser

4. PHP(http://www.php.net)

5. Syslog or rsyslog


How it works
============

1) Enable samba full_audit: example of configuration in smb.conf
2) Configure rsyslog to store audit lines in a separate file: copy smbaudit-rsyslog.conf in /etc/rsyslog.d
3) Create the db: from the sql dir, execute mysql < smbaudit.sql
4) Enable the web interface: copy smbaudit.conf in /etc/httpd/conf.d
5) Copy sudeors config into /etc/sudoers.d directory
7) Create a cron or logrotate job to invoke the parser on files

Credits
=======

* PostgreSQL support and Portuguese translation by Jonis Maurin Ceara 
  http://softwarelivre.mouralacerda.edu.br/conteudo.php?pid=13
* Polish translation by Marcin Sołoguba <marsol@o2.pl>
* Spanish translation by Fabio Bettiol <fabiobettiolm@cantv.net> 
* German translation by Axel Gembe aka xagox
* Original work by Anatoliy Okhotnikov <acidumirae@yandex.ru>

NethServer integration
======================

The nethserver-samba-audit package configure Samba standard audit and save the log on a special file.
Every night a script parses the log file and puts all data into a MySQL database. The database can be explored using a simple web interface.

After installation, a new enable/disable option is shown inside the i-bay module. The web GUI can be accessed directly from the Dashboard using auto-created random URL.
The GUI is accessible only from local networks.

From the GUI the user can:

* filter log by username, date, i-bay name, path or ip
* remove old logs
* force parsing of log file

**Database example**

:: 

 test=ibay
    ...
    SmbAuditStatus=enabled
    ...


