<?php
$out = shell_exec('sudo git pull');
$file = 'gitpull.txt';
// Open the file to get existing content
$current = file_get_contents($file);
// Append a new person to the file
$current .= date('Y-m-d H:i:s') . $out . "\n";
// Write the contents back to the file
file_put_contents($file, $current);
$second = shell_exec('sudo chown -R www-data:www-data *');

