#!/bin/sh
while true; do
  if ! systemctl is-active --quiet mariadb; then
    service mariadb restart 
  fi
  sleep 120
done