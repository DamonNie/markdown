
# mysql 双1设置
    <!-- 博客摘要 start -->
【摘要】 双1设置：（适合数据安全性要求非常高，而且磁盘IO写能力足够支持业务(磁盘为 PCIE SSD)）sync_binlog、innodb_flush_log_at_trx_commit 这两个参数都要设置为1。// mysqld 服务崩溃或者服务器主机 crash 的情况下，binary log 只有可能丢失最多一个语句或者一个事务。sync_binlog该参数表示事务写入 binary lo...
    <!-- 博客摘要 end -->

    <!-- 博客正文内容 start -->
双1设置：（适合数据安全性要求非常高，而且磁盘IO写能力足够支持业务(磁盘为 PCIE SSD)）
sync_binlog、innodb_flush_log_at_trx_commit 这两个参数都要设置为1。
// mysqld 服务崩溃或者服务器主机 crash 的情况下，binary log 只有可能丢失最多一个语句或者一个事务。
# sync_binlog
该参数表示事务写入 binary log 并使用 fdatasync() 函数同步到磁盘的过程。
取值为0：mysql 自己不主动同步，依赖操作系统本身不定期把文件内容刷新到磁盘。性能最佳
取值为1：每次事务提交后将 binlog_cache 中的数据强制写入磁盘 bin log日志中，是最慢的，但是最安全
取值 >1：当进行n次事务提交后，mysql 将 binlog_cache 中的数据强制写入磁盘中。
# innodb_flush_log_at_trx_commit
该参数表示 log buffer 写入 log file 以及刷新到磁盘的过程。
取值为0：log buffer 每秒写入日志文件 log file 并刷新 flush 到磁盘。这种情况下，mysql 的日志刷写操作和事务提交操作没有关系。因此 mysql 的性能是最好的时刻。不过不安全
取值为1：每次事务提交时，log buffer 会被写入到日志文件并且还要刷写到磁盘上。由于每次事务都要提交到I/O设备，因此会慢一点，不过是最安全的。
取值为2：0和1的中间效果，即每次的事务提交会写入 log buffer，而刷写到磁盘则是一秒进行一次。性能属于一般。
![](https://bbs-img.huaweicloud.com/blogs/img/1612401876569015643.png "")