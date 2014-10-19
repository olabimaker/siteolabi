#!/usr/bin/env bash

service apache2 start
service mysql start

rm -rf /var/www/html
ln -fs /vagrant/src /var/www/html