<?php

// Database credentials
$host = "localhost";
$db_name = "tax_bd";
$username = "root";
$password = "";

// Set the backup file path
$backup_dir = $_SERVER['DOCUMENT_ROOT'] . "/backups/";  // You can adjust this path
if (!file_exists($backup_dir)) {
    mkdir($backup_dir, 0777, true);  // Create backups folder if it doesn't exist
}

// Format backup filename with date and time
$backup_file = $backup_dir . $db_name . "_backup_" . date("Y-m-d_H-i-s") . ".sql";

// Path to mysqldump command (check if it is installed and update accordingly)
$mysqldump = "/usr/bin/mysqldump";  // Change this to the path of mysqldump on your server
// For Windows, it might look like this:
// $mysqldump = "C:\\Program Files\\MySQL\\MySQL Server X.X\\bin\\mysqldump.exe";

// Ensure mysqldump is available
if (!file_exists($mysqldump)) {
    die("Error: mysqldump command not found. Please check the path.");
}

// Create the backup command
$command = "$mysqldump --user=$username --password=$password --host=$host $db_name > $backup_file";

// Execute the command
exec($command, $output, $result);

// Check for errors
if ($result !== 0) {
    echo "Failed to create database backup. Error: " . implode("\n", $output);
} else {
    echo "Database backup created successfully: <a href='/backups/" . basename($backup_file) . "' download>Download Backup</a>";
}
?>
