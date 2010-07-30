#!/bin/bash

USERNAME=$USER

sudo chown -R ${USERNAME}:${USERNAME} *
php symfony doctrine:insert-sql 
php symfony doctrine:data-load --env=prod
sudo chmod -R 777 log/ cache/
sudo chown -R www-data:www-data cache log data web
