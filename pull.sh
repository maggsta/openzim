#!/bin/bash

USERNAME=$USER

sudo chown -R ${USERNAME}:${USERNAME} cache log data web

php symfony cc
git pull

sudo chmod -R 777 log/ cache/
sudo chown -R www-data:www-data data cache log web
