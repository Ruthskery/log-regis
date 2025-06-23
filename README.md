## Configure
1. Put my folder inside html(nginx)
2. Configure Nginx (nginx.conf)
3. Configure PHP (php.ini)
## Start Manual
nginx - to start nginx
php-cgi.exe -b 127.0.0.1:9000 - to start php

nginx.conf
worker_processes  1;
events {
    worker_connections  1024;
}
http {
    include       mime.types;
    default_type  application/octet-stream;
    sendfile        on;
    keepalive_timeout  65;
    server {
        listen       80;
        server_name  localhost;
        root   html;
        index  index.php index.html index.htm;
        location / {
            try_files $uri $uri/ /index.php?$args;
        }
        location ~ \.php$ {
            root           html;
            fastcgi_pass   127.0.0.1:9000;
            fastcgi_index  index.php;
            include        fastcgi_params;
            fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
        }
        location ~ /\.ht {
            deny  all;
        }
    }
}

php.ini
Enable:
extension=mysqli
extension=mbstring

Set: 
extension_dir = "ext"
