======================
nethserver-samba-audit
======================

Samba audit is a simple audit module for samba which uses vfs_full_audit module.
All operations are logged in a file and a logrotate job parses all entries and store it into a MySQL db.
Logs are browseable using web interface.

SambaAudit is based on a Samb Audit project. See: http://sourceforge.net/projects/smbdaudit/
Current implementation uses standard full_audit vfs module instead of mysql_audit.


Configuration
=============

The nethserver-samba-audit package configure Samba standard vfs audit and save the log on ``/var/log/smbaudit.log``.
Every night a script parses the log file and puts all data into a MySQL database. The database can be explored using a simple web interface.

The packages adds the following properties to the ``smb`` key:

- ``AuditAlias``: auto-generate alias to access the legacy UI
- ``AuditLogRead``: can be ``enabled`` or ``disabled``. If ``enabled`` read actions are saved inside the database, otherwise
  read actions are present only inside the log. 

Example: ::

  smb=service
    AuditAlias=43d5xxxxxxxxxxxxxxxxf023e46a11a4b7cb233a
    AuditLogRead=disabled
    DeadTime=10080
    HomeAdmStatus=disabled
    InheritOwner=no
    NetbiosAliasList=
    ShareAdmStatus=disabled
    TCPPorts=139,445
    UseClientDriver=yes
    UseCups=enabled
    WinsServerIP=
    access=green
    status=enabled


To enable the audit for a shared folder, use the ``SmbAuditStatus`` property to the ``ibay`` record.
Example: ::

 test=ibay
    ...
    SmbAuditStatus=enabled
    ...


