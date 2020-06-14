
## PHP-FPM 介绍
### CGI 协议与 FastCGI 协议
1.什么是CGI？

CGI是Common Gateway Interface（通用网管协议），用于让交互程序和Web服务器通信的协议。它负责处理URL的请求，启动一个进程，将客户端发送的数据作为输入，由Web服务器收集程序的输出并加上合适的头部，再发送回客户端。

2.什么是FAST-CGI？

CGI的改良版，CGI只能一个请求fork出一个worker，然后kill掉，再有请求再循环，这样很浪费资源，FAST-CGI每次处理完请求后，不会kill掉这个进程，而是保留这个进程，使这个进程可以一次处理多个请求。这样每次就不用重新fork一个进程了，大大提高了效率。

### PHP-FPM 是什么
PHP-FPM 即 PHP-FastCGI Process Manager， 它是 FastCGI 的实现，并提供了进程管理的功能。进程包含 master 进程和 worker 进程两种；master 进程只有一个，负责监听端口，接收来自服务器的请求，而 worker 进程则一般有多个（具体数量根据实际需要进行配置），每个进程内部都会嵌入一个 PHP 解释器，是代码真正执行的地方。
## Nginx 与 php-fpm 通信机制
当我们访问一个网站（如 www.test.com）的时候，处理流程是这样的：
```
    www.test.com
        |
        |
      Nginx
        |
        |
路由到 www.test.com/index.php
        |
        |
加载 nginx 的 fast-cgi 模块
        |
        |
fast-cgi 监听127.0.0.1:9000 地址
        |
        |
www.test.com/index.php 请求到达127.0.0.1:9000
        |
        |
     等待处理...
```
### Nginx 与 php-fpm 的结合
在 Linux 上，nginx 与 php-fpm 的通信有 tcp socket 和 unix socket 两种方式。
tcp socket 的优点是可以跨服务器，当 nginx 和 php-fpm 不在同一台机器上时，只能使用这种方式。
Unix socket 又叫 IPC (inter-process communication 进程间通信) socket，用于实现同一主机上的进程间通信，这种方式需要在 nginx 配置文件中填写 php-fpm 的 socket 文件位置。
两种方式的数据传输过程如下图所示：
![](https://my-blog-cjh.oss-cn-shanghai.aliyuncs.com/20190128194727.png "")
二者的不同：
由于 Unix socket 不需要经过网络协议栈，不需要打包拆包、计算校验和、维护序号和应答等，只是将应用层数据从一个进程拷贝到另一个进程。所以其效率比 tcp socket 的方式要高，可减少不必要的 tcp 开销。不过，unix socket 高并发时不稳定，连接数爆发时，会产生大量的长时缓存，在没有面向连接协议的支撑下，大数据包可能会直接出错不返回异常。而 tcp 这样的面向连接的协议，可以更好的保证通信的正确性和完整性。
Nginx 与 php-fpm 结合只需要在各自的配置文件中做设置即可：
1） Nginx 中的配置
以 tcp socket 通信为例
```
    server{
    listen80;#监听 80 端口，接收http请求
    server_name  www.test.com;#就是网站地址
    root /usr/local/etc/nginx/www/huxintong_admin;
    # 准备存放代码工程的路径
    #路由到网站根目录 www.test.com 时候的处理
    location /{
        index index.php;#跳转到 www.test.com/index.php
        autoindex on;
}
#当请求网站下 php 文件的时候，反向代理到 php-fpm
    location~ \.php${
        include /usr/local/etc/nginx/fastcgi.conf;#加载 nginx 的 fastcgi 模块
        fastcgi_intercept_errors on;
        fastcgi_pass  127.0.0.1:9000;# tcp 方式，php-fpm 监听的 IP 地址和端口
        # fasrcgi_pass /usr/run/php-fpm.sock # unix socket 连接方式
    }
}
```
2) php-fpm 的配置
```
listen=127.0.0.1:9000
# 或者下面这样
listen= /var/run/php-fpm.sock
```
> 注意，在使用 unix socket 方式连接时，由于 socket 文件本质上是一个文件，存在权限控制的问题，所以需要注意 nginx 进程的权限与 php-fpm 的权限问题，不然会提示无权限访问。（在各自的配置文件里设置用户）
通过以上配置即可完成 php-fpm 与 nginx 的通信。
### 在应用中的选择
如果是在同一台服务器上运行的 nginx 和 php-fpm，且并发量不高（不超过 1000），选择 unix socket，以提高 nginx 和 php-fpm 的通信效率。

如果是面临高并发业务，则考虑选择使用更可靠的 tcp socket，以负载均衡、内核优化等运维手段维持效率。
若并发较高但仍想用 unix socket 时，可通过以下方式提高 unix socket 的稳定性。
1）将 sock 文件放在 /dev/shm 目录下，此目录下将 sock 文件放在内存里面，内存的读写更快。
2）提高 backlog
backlog 默认位 128，1024 这个值换成自己正常的 QPS，配置如下。
nginx.conf 文件中
```
server{
    listen80
    default backlog=1024;
}
```
php-fpm.conf 文件中
``` 
    listen.backlog=1024
```
3）增加 sock 文件和 php-fpm 实例
在 /dev/shm 新建一个 sock 文件，在 nginx 中通过 upstream 模块将请求负载均衡到两个 sock 文件，并且将两个 sock 文件分别对应到两套 php-fpm 实例上。

转载至:[PHP-FPM 与 Nginx 的通信机制总结]("https://learnku.com/articles/23694#a4de5c")
