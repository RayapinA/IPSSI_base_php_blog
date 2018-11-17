FROM php:7.2-apache
MAINTAINER Ipssi_Rayapin <Rayapin@localhost>
RUN apt-get update \
  && docker-php-ext-install pdo_mysql mysqli 
RUN set -x ; \

adduser --force-badname www-sgroup-User

EXPOSE 30000

CMD /usr/sbin/apache2ctl -D FOREGROUND
