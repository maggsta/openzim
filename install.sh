#!/bin/bash

USERNAME=$USER
GROUPNAME=$GROUPS
WWWUSER=$(ps axho user,comm|grep -E "httpd|apache"|uniq|grep -v "root"|awk 'END {if ($1) print $1}')

sudo chown -R ${USERNAME}:${GROUPNAME} .
php symfony doctrine:drop-db 
php symfony doctrine:build-db 
php symfony doctrine:insert-sql 
php symfony doctrine:data-load --env=prod
sudo chmod -R 777 log/ cache/
sudo chown -R ${WWWUSER}:${WWWUSER} cache log data web
