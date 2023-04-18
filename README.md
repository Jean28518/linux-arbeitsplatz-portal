# linux-arbeitsplatz-portal
Linux-Arbeitsplatz Startseite

```bash
sudo -i
apt install php-fpm
cd /var/www/
git clone https://github.com/Jean28518/linux-arbeitsplatz-portal.git

vim /etc/caddy/Caddyfile

# Add:
portal.int.de int.de {
  root * /var/www/linux-arbeitsplatz-portal
  encode gzip
  php_fastcgi unix//var/run/php/php-fpm.sock
  file_server
}
```
