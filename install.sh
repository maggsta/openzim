#!/bin/bash

USERNAME=$1

sudo chown -R ${USERNAME}:${USERNAME} cache log data web
php symfony doctrine:insert-sql 
php symfony doctrine:data-load --env=prod
sudo chmod -R 777 log/ cache/
sudo chown -R www-data:www-data cache log data web
