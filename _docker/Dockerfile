############################################################################################################
# Init Default PHP Image
############################################################################################################
FROM php:8.4-apache

############################################################################################################
# Update APT Library and Upgrade System
############################################################################################################
RUN apt update -y
RUN apt upgrade -y

############################################################################################################
# Install Dependencies
############################################################################################################
RUN apt install apache2 -y
RUN apt install curl -y
RUN apt install cron -y
RUN apt install tzdata -y
RUN apt install libonig-dev -y
RUN apt install libpng-dev -y
RUN apt install zlib1g-dev -y
RUN apt install libcurl4-openssl-dev -y
RUN apt install openssl -y
RUN apt install libicu-dev -y
RUN apt install libxml2-dev -y
RUN apt install libzip-dev -y

############################################################################################################
# Install PHP Extensions
############################################################################################################
RUN docker-php-ext-install mysqli 
RUN docker-php-ext-install curl
RUN docker-php-ext-install bcmath
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install gd
RUN docker-php-ext-install intl
RUN docker-php-ext-install xml
RUN docker-php-ext-install fileinfo
RUN docker-php-ext-install zip
RUN docker-php-ext-install ctype
RUN docker-php-ext-install filter

############################################################################################################
# Set Timezone
############################################################################################################
ENV TZ=${sf_timezone}
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo "$TZ" > /etc/timezone

############################################################################################################
# Apache Module Setup
############################################################################################################
RUN a2enmod rewrite 
RUN a2enmod headers 
RUN a2enmod cgi
RUN a2enmod cgid
RUN a2enmod remoteip 
RUN a2enmod ssl 
RUN a2enmod deflate 

######################################################
# Apache Disable Default Sites
######################################################
RUN a2dissite 000-default
RUN a2dissite default-ssl

######################################################
# Apache Copy Configuration
######################################################
COPY _vhost/ /etc/apache2/conf-available/

######################################################
# Apache Copy Website Content
######################################################
COPY _source/ /var/www/html/

######################################################
# Generate Default Apache2 Certificate (Self Signed)
######################################################
RUN mkdir -p /opt/sf_ssl

############################################################################################################
# Install MySQL
############################################################################################################
ENV DEBIAN_FRONTEND=noninteractive
RUN apt install mariadb-client -y
RUN apt install mariadb-server -y
RUN echo "[mysqld]\n\
skip-networking=0\n\
bind-address=0.0.0.0" > /etc/mysql/mariadb.conf.d/99-custom.cnf

############################################################################################################
# Setup Website Cronjob Hourly with Root Access
############################################################################################################
RUN echo "0 * * * * /usr/local/bin/php /var/www/html/cronjob.php 2>&1" >> /etc/cron.d/my-cron-jobs

############################################################################################################
# Install Supervisor
############################################################################################################
RUN apt-get install -y supervisor
COPY ./_script/suitefish_cron.conf /etc/supervisor/conf.d/suitefish_cron.conf
COPY ./_script/suitefish_apache2.conf /etc/supervisor/conf.d/suitefish_apache2.conf
COPY ./_script/suitefish_mysql.conf /etc/supervisor/conf.d/suitefish_mysql.conf
COPY ./_script/suitefish_suitefish.conf /etc/supervisor/conf.d/suitefish_suitefish.conf

############################################################################################################
# Copy Entrypoint Script
############################################################################################################
COPY ./_script/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh
COPY ./_script/restart_mysql.sh /restart_mysql.sh
RUN chmod +x /restart_mysql.sh

############################################################################################################
# Cleanup Image
############################################################################################################
RUN apt-get clean
RUN rm -rf /var/lib/apt/lists/*

############################################################################################################
# Add Entrypoint
############################################################################################################
ENTRYPOINT ["/entrypoint.sh"]

############################################################################################################
# Startup Instructions
############################################################################################################
CMD ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisor/supervisord.conf", "--silent"]
