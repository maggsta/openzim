#!/bin/bash

USERNAME=$USER
GROUPNAME=$GROUPS
WWWUSER=$(ps axho user,comm|grep -E "httpd|apache"|uniq|grep -v "root"|awk 'END {if ($1) print $1}')

sudo chown -R ${USERNAME}:${GROUPNAME} cache log data web

php symfony cc
git pull

sudo chmod -R 777 log/ cache/
sudo chown -R ${WWWUSER}:${WWWUSER} cache log data web
