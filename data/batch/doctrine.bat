call vendor/bin/doctrine-module orm:generate-proxies
call vendor/bin/doctrine-module orm:schema-tool:update --force --dump-sql