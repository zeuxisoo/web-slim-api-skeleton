all:
	@echo "make configs"
	@echo "make composer"
	@echo "make deps"
	@echo "make phpmig"
	@echo "make server"

configs:
	cp config/default.php.sample config/default.php

composer:
	curl -sS https://getcomposer.org/installer | php

deps:
	php composer.phar install

phpmig:
	php vendor/bin/phpmig init

server:
	php -S localhost:8080
