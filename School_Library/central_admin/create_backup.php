<?php
$dbhost = 'localhost';//Host
$dbuser = 'root';//User
$dbpass = '';//Password
$dbname = 'library_network';//Database

// Backup file path
$backup_file = '/opt/lampp/htdocs/School_Library/library_network_backup.sql';

// Command to backup the database
$command = '/opt/lampp/bin/mysqldump --user=' . $dbuser . ' --password=' . $dbpass . ' --host=' . $dbhost . ' ' . $dbname . ' 2>&1 > ' . $backup_file;


//2>&1 vriskei ta sfalmata
//an vrei kapoio sfalma mallon kalo einai na trekseis ena apo auta:
//sudo chown www-data:www-data /opt/lampp/htdocs/School_Library/ (mou doulepse auto kai mono tou)
//sudo chown www-data:www-data /opt/lampp/htdocs/School_Library/

$output = shell_exec($command . ' 2>&1');

if (strpos(strtolower($output), 'error') !== false) {
    die('Database backup failed with error: ' . $output);
} else {
    echo 'Database backup successfully created at: ' . $backup_file;
}
?>
