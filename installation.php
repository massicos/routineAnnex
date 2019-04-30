<?php

define("PATH_GITANGULAR", "/vagrant/angular/routineAngular");
define("PATH_INSTALLATIONANGULAR", "/vagrant/www");
define("PATH_GITWEBSERVICE", "/vagrant/slim");
define("PATH_INSTALLATIONWEBSERVICE", "/vagrant/www/webservices");

$level = $argv[1];

echo "================================================\n";
echo "==== BUILD ROUTINE - Level : " . $level . " ====\n";
echo "================================================\n";


echo "==== WEB SERVICES ====\n";

$command = "cd " . PATH_GITWEBSERVICE . ";\n" .
           //"git pull;\n" .
"cp index.php " . PATH_INSTALLATIONWEBSERVICE . ";\n" .
"cp .htaccess " . PATH_INSTALLATIONWEBSERVICE . ";\n" .
"php composer.phar require slim/slim\n" .
"php composer.phar require monolog/monolog\n";

echo $command . "\n";

exec($command, $output, $return_var);
var_dump($output);
echo "\n";
var_dump($return_var);           

echo shell_exec("sudo systemctl restart apache2");

echo "==== ANGULAR ====\n";

$command = "cd " . PATH_GITANGULAR . ";\n" .
           //"git pull;\n" .
           "ng build --configuration=" . $level . ";\n" .
           "cp dist/routine/*.* " . PATH_INSTALLATIONANGULAR;

           
exec($command, $output, $return_var);
var_dump($output);
echo "\n";
var_dump($return_var);           

echo "\n==== END ====\n";