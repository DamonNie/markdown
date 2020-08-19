# 编译升级PHP 7.4.0


### 获取当前 PHP 配置参数
这里我们用命令寻找：
`/usr/local/php/bin/php -i | head`
总之，我们需要的就是下面的东西：
`./configure  --prefix=/usr/local/php --enable-opcache --with-config-file-path=/usr/local/php/etc --with-curl --enable-fpm --enable-gd --with-iconv --enable-mbstring --with-mysqli=mysqlnd --with-openssl --enable-static --enable-sockets --enable-inline-optimization --with-zlib --disable-ipv6 --disable-fileinfo --disable-debug --enable-bcmath --enable-fileinfo`
### 下载PHP
从 https://www.php.net/downloads.php 页面下载 PHP 的最新 Stable 版本，解压缩，进入源码目录。
`wget https://www.php.net/distributions/php-7.4.0.tar.gztar xf php-7.4.0.tar.gz
cd php-7.4.0`
### 配置PHP
在编译之前，需要进入源代码目录，对要安装的程序进行各种参数配置，比如安装到什么地方，需要开启哪些功能等。配置工作一般都由源码目录中的configure脚本完成。
#### error: Package requirements (sqlite3 &gt; 3.7.4) were not met
error: Package requirements (sqlite3 &gt; 3.7.4) were not met
```
No package 'sqlite3' found

若看到上面的报错，非常简单：

yum install libsqlite3x-devel -y
```
#### error: Package requirements (oniguruma) were not met
error: Package requirements (oniguruma) were not met
```
No package 'oniguruma' found

若看到上面的报错，非常简单：

yum install oniguruma-devel -y
            
```
### 编译PHP
刚才的配置通过后，直接运行 make 进行编译。
### 安装PHP
刚才的编译通过后，先停止PHP-FPM服务：
```
systemctl stop php-fpm
php5.3.3之后已经弃用此命令，这里用信号控制
kill -INT pid(ps -ef|grep php-fpm查找)
make install

```