#!/bin/bash

USERNAME=$1
GROUPNAME=$2
WWWUSER=$3
WWWGROUP=$4

sudo chown -R ${USERNAME}:${GROUPNAME} .
php symfony doctrine:insert-sql 
php symfony doctrine:data-load --env=prod
sudo chmod -R 777 log/ cache/
sudo chown -R ${WWWUSER}:${WWWGROUP} cache log data web
