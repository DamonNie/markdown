#[php-fpm启动，重启，终止操作](https://www.cnblogs.com/GaZeon/p/5421906.html "")
　　最近安装了mysqli扩展，重启了nginx后，phpinfo()没有显示出mysqli，后来搞不出原因，直接使用了pdo连接数据库。直到今天安装redis后phpinfo()没有显示redis,内心那一万只奔腾的草泥马终于爆发，狂找办法，才知道是php-fpm没有重启，按网上的方法鼓捣，完全就是百度文章一家亲，没有一个说到点上，最后还是鼓捣出来了，下面说说php-fpm启动，重启，终止操作方法。
&nbsp;
启动php-fpm:
/usr/local/php/sbin/php-fpm
&nbsp;
php 5.3.3 以后的php-fpm不再支持 php-fpm 以前具有的 /usr/local/php/sbin/php-fpm (start|stop|reload)等命令，所以不要再看这种老掉牙的命令了，需要使用信号控制：
master进程可以理解以下信号
INT, TERM&nbsp;立刻终止
QUIT&nbsp;平滑终止
USR1&nbsp;重新打开日志文件
USR2&nbsp;平滑重载所有worker进程并重新载入配置和二进制模块
&nbsp;
一个简单直接的重启方法：
先查看php-fpm的master进程号
`#ps aux|grep php-fpm
root218910.00.0112660960 pts/3    R+16:180:00 grep --color=auto php-fpm
root428910.00.11827961220 ?        Ss   4月180:19 php-fpm: master process (/usr/local/php/etc/php-fpm.conf)
nobody428920.00.61830006516 ?        S    4月180:07 php-fpm: pool www
nobody428930.00.61830006508 ?        S    4月180:17 php-fpm: pool www`
重启php-fpm:
kill -USR2 42891
OK了。
&nbsp;
上面方案一般是没有生成php-fpm.pid文件时使用，如果要生成php-fpm.pid，使用下面这种方案：
上面master进程可以看到，matster使用的是/usr/local/php/etc/php-fpm.conf这个配置文件，cat&nbsp;/usr/local/php/etc/php-fpm.conf 发现：
`[global]
; Pidfile; Note: the default prefix is/usr/local/php/var
; Default Value: none
;pid= run/php-fpm.pid`
&nbsp;
pid文件路径应该位于/usr/local/php/var/run/php-fpm.pid，由于注释掉，所以没有生成，我们把注释去除，再kill -USR2 42891 重启php-fpm,便会生成pid文件，下次就可以使用以下命令重启,关闭php-fpm了：
php-fpm 关闭：
kill -INT 'cat /usr/local/php/var/run/php-fpm.pid'
php-fpm 重启：
kill -USR2 'cat /usr/local/php/var/run/php-fpm.pid'
&nbsp;
&nbsp;
网上搜到Nginx和PHP-FPM的启动、重启、停止脚本：http://www.jb51.net/article/58796.htm
&nbsp;
作者：
                GaZeon
出处：[https://www.cnblogs.com/GaZeon/p/5421906.html](https://www.cnblogs.com/GaZeon/p/5421906.html "")
版权：本文采用「[署名-非商业性使用-相同方式共享 4.0 国际](https://creativecommons.org/licenses/by-nc-sa/4.0/ "")」知识共享许可协议进行许可。


标签:
[php](https://www.cnblogs.com/GaZeon/tag/php/ ""),[php-fpm](https://www.cnblogs.com/GaZeon/tag/php-fpm/ "")

[好文要顶](javascript:void(0); "")
[关注我](javascript:void(0); "")
[收藏该文](javascript:void(0); "")
[![](https://common.cnblogs.com/images/icon_weibo_24.png "")](javascript:void(0); "title="分享至新浪微博"")
[![](https://common.cnblogs.com/images/wechat.png "")](javascript:void(0); "title="分享至微信"")
[![](https://pic.cnblogs.com/face/905655/20200501153135.png "")](https://home.cnblogs.com/u/GaZeon/ "")
[GaZeon](https://home.cnblogs.com/u/GaZeon/ "")

[关注 - 4](https://home.cnblogs.com/u/GaZeon/followees/ "")

[粉丝 - 7](https://home.cnblogs.com/u/GaZeon/followers/ "")
            

[+加关注](javascript:void(0); "")
2
0

                <script type="text/javascript">
                    currentDiggType = 0;
                </script>
    
[«](https://www.cnblogs.com/GaZeon/p/5410774.html "") 上一篇：[Xunsearch迅搜(基于 xapian+scws 的开源中文搜索引擎)安装与简单使用](https://www.cnblogs.com/GaZeon/p/5410774.html "title="发布于 2016-04-20 17:14"")
                

[»](https://www.cnblogs.com/GaZeon/p/5422078.html "") 下一篇：[Linux下Redis安装使用，主从模式，哨兵模式与PHP扩展(PHP7适用)](https://www.cnblogs.com/GaZeon/p/5422078.html "title="发布于 2016-04-23 13:09"")
posted @
2016-04-22 16:45&nbsp;
[GaZeon](https://www.cnblogs.com/GaZeon/ "")&nbsp;
        阅读(79411)&nbsp;
        评论(0)&nbsp;
[编辑](https://i.cnblogs.com/EditPosts.aspx?postid=5421906 "")&nbsp;
[收藏](javascript:void(0) "")