#!/bin/bash

##################################################
# implementation.sh: It will include all the commands regarding implementing policies for your firewall, IDS, etc. You may use a stream editor such as ?~@~\sed?~@~] to implement them using your automated scripts, if that requires editing specific files

# Written by Chris Yun and Dong Wang

##################################################

# Clear all rules in firewall with IPTables:
sudo iptables -F
sudo iptables -P INPUT DROP
sudo iptables -P FORWARD DROP
sudo iptables -P OUTPUT DROP

# "Check the status of your current iptables configuration"
echo -e "Checking IPTables status.."
sudo iptables -L -v

# allow traffic on localhost
echo -e "Allowing traffic on localhost.."
sudo iptables -A INPUT -i lo -j ACCEPT
sudo iptables -A OUTPUT -o lo -j ACCEPT

# allow already established traffic and related traffic
sudo iptables -A INPUT -m state --state ESTABLISHED,RELATED -j ACCEPT

# allow all traffic to outside
sudo iptables -A OUTPUT -j ACCEPT

# Enable connections on HTTP, SSH, SSL
echo -e "Enabling SSH(22) port.."
sudo iptables -A INPUT -p tcp --dport 22 -j ACCEPT

echo -e "Enabling HTTP(80) port.."
sudo iptables -A INPUT -p tcp --dport 80 -j ACCEPT

echo -e "Enabling HTTPS(443) port.."
sudo iptables -A INPUT -p tcp --dport 443 -j ACCEPT

echo -e "Enabling SMTPS(587) port.."
sudo iptables -A INPUT -p tcp --dport 587 -j ACCEPT

echo -e "Enabling SMTP(25) port.."
sudo iptables -A INPUT -p tcp --dport 25 -j ACCEPT

# check if rules were appended
sudo iptables -L -v

# dropping all other traffic other than dport
echo -e "Adding rule to drop unauthorized connections.."
sudo iptables -A INPUT -p tcp -j DROP

# Persisting Changes
echo -e "Saving changes to IPTables.."
sudo /sbin/iptables-save

echo -e "Finished implementing IPTables Firewall rules."

##################################################

# RESOURCES

# IPTables setup:
# https://www.hostinger.com/tutorials/iptables-tutorial