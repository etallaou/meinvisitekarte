# php image provided by Docker Hub
FROM php:7-apache

#ENV http_proxy http://10.0.2.2:3128
#ENV https_proxy http://10.0.2.2:3128

# copy all from our src folder, into the html folder of the Docker container
COPY src/ /var/www/html/
EXPOSE 83