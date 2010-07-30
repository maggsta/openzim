php symfony doctrine:insert-sql 
php symfony doctrine:data-load --env=prod
sudo chmod -R 777 log/ cache/
sudo chown -R www-data:www-data cache
sudo chown -R www-data:www-data log
sudo chown -R www-data:www-data data
sudo chown -R www-data:www-data web
