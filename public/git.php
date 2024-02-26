<?php
//su -s /bin/sh root -c 'cd /var/www/cpalevel.com/html && git pull -q origin master'
function execPrint($command) {
    $result = array();
    exec($command, $result);
    print("<pre>");
    foreach ($result as $line) {
        print($line . "\n");
    }
    print("</pre>");
}
// Print the exec output inside of a pre element

execPrint("cd /var/www/chepapest.com/public");
execPrint("git pull origin master");
execPrint("cd /var/www/chepapest.com && php artisan cache:clear");
execPrint("cd /var/www/chepapest.com && php artisan config:clear");
execPrint("cd /var/www/chepapest.com && php artisan view:clear");
