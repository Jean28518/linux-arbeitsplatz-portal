# linux-arbeitsplatz-portal
Linux-Arbeitsplatz Startseite

```bash
sudo -i
apt install php-fpm
cd /var/www/
git clone https://github.com/Jean28518/linux-arbeitsplatz-portal.git

vim /etc/caddy/caddyfile

# Add:
portal.int.de {
  root * /var/www/linux-arbeitsplatz-portal
  encode gzip
  php_fastcgi unix//var/run/php/php8.2-fpm.sock
  file_server
}
```
