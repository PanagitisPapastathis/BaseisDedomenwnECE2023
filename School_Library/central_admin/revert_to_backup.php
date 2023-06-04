<?php
$dbhost = 'localhost';  // Host
$dbuser = 'root';  // User
$dbpass = '';  // Password
$dbname = 'library_network';  // Database

// Backup file path
$backup_file = '/opt/lampp/htdocs/School_Library/library_network_backup.sql';

// Command to restore the database
$command = '/opt/lampp/bin/mysql --user=' . $dbuser . ' --password=' . $dbpass . ' --host=' . $dbhost . ' ' . $dbname . ' < ' . $backup_file;

$output = shell_exec($command . ' 2>&1');

if (strpos(strtolower($output), 'error') !== false) {
    die('Database restore failed with error: ' . $output);
} else {
    echo 'Database successfully restored from: ' . $backup_file;
}
?>
