php composer.phar self-update
php composer.phar update

php vendor/zendframework/zendframework/bin/classmap_generator.php -l "module/Application"
php vendor/zendframework/zendframework/bin/classmap_generator.php -l "module/Base"
php vendor/zendframework/zendframework/bin/classmap_generator.php -l "module/User"

cd module/Application
php ../../data/bin/templatemap_generator.php

cd ../User
php ../../data/bin/templatemap_generator.php

cd ../../data/bin
php php-cs-fixer.phar self-update
php php-cs-fixer.phar fix ../../config
php php-cs-fixer.phar fix ../../module
