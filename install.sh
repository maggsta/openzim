#!/bin/bash

USERNAME=$USER
GROUPNAME=$GROUPS
WWWUSER=`grep www /etc/passwd | cut -d : -f 1`

sudo chown -R ${USERNAME}:${GROUPNAME} .
php symfony doctrine:insert-sql 
php symfony doctrine:data-load --env=prod
sudo chmod -R 777 log/ cache/
sudo chown -R ${WWWUSER}:${WWWUSER} cache log data web
