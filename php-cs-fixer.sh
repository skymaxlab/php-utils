#!/usr/bin/env bash

# To install php-cs-fixer

echo "Running php-cs-fixer..."
./vendor/bin/php-cs-fixer fix --allow-risky=yes
rm .php_cs.cache
