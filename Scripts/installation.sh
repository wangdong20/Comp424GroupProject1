#!/bin/bash

##################################################
# installation.sh: It will include all the commands regarding installation of all the necessary services and tools. Also,all configuration scripts for LAMP.

# These commands must be done on Amazon's AMI (NOT on Amazon's linux 2). Opening ports for HTTP(80) and HTTPS(443) might be necessary before executing this script.

# Written by Chris Yun

##################################################

# "ensure that all of your software packages are up to date"
# this part checks then updates packages
echo -e "Updating System.."
sudo yum update -y

##################################################

# IPTables:
# basic installation in case it's not there already
echo -e "Installing IPTables.."
sudo yum install iptables

##################################################

# Install Apache web server, MySQL, PHP software packages
echo -e "Installing php, mysql, and apache.."
sudo yum install -y httpd24 php72 mysql57-server php72-mysqlnd

##################################################

#Apache:

# Start the apache web server
echo -e "Starting Apache web server.."
sudo service httpd start

# use chkconfig to configure apache web server to start at system boot
echo -e "Configuring apache to start at system boot.."
sudo chkconfig httpd on
chkconfig --list httpd

# set file permissions:
echo -e "Setting file permissions.."

# add user to group
sudo usermod -a -G apache ec2-user

# log out then back in (this command reloads .bashrc)
source ~/.bashrc

# this one replaces the current shell (doing both juse in case)
exec bash

# verification
groups

# change group ownership of /var/www
sudo chown -R ec2-user: apace /var/www

# "To add group write permissions and to set the group ID on future subdirectories, change the directory permissions of /var/www and its subdirectories."
sudo chmod 2775 /var/www
find /var/www -type d -exec sudo chmod 2775 {} \;

# "To add group write permissions, recursively change the file permissions of /var/www and its subdirectories:"
find /var/www -type f -exec sudo chmod 0664 {} \;

##################################################

echo -e "Installation Complete uwu"

##################################################

# RESOURCES

# learning scripts:
# http://linuxcommand.org/lc3_writing_shell_scripts.php

# LAMP installation:
# https://www.geeksforgeeks.org/installing-php-and-configuring-it-on-ubuntu-14-04-trusty/

# changing colors:
# https://stackoverflow.com/questions/5947742/how-to-change-the-output-color-of-echo-in-linux

# Snort3 installation:
# https://snort-org-site.s3.amazonaws.com/production/document_files/files/000/000/211/original/Snort3.pdf?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAIXACIED2SPMSC7GA%2F20200319%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20200319T194527Z&X-Amz-Expires=172800&X-Amz-SignedHeaders=host&X-Amz-Signature=27096940c889c56e20352507c114d335cdcdf12340d0af2e6438d16278762526

# OpenSSH installation:
# https://www.cyberciti.biz/faq/ubuntu-linux-install-openssh-server/

##################################################

