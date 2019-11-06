<?php
/**
 * @created by PhpStorm
 * @author damon
 * @date 2019/11/2
 * @time 20:19
 * JUST do it,so what have you done today
 *
 */

namespace damon\src;


class Convert
{
    protected static $instance = null;
    protected $content = null;

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new static;
        }
        return self::$instance;
    }

    /**
     * 获取内容
     */
    public function getContent($path, $to_encode = 'UTF-8')
    {
        if (!file_exists($path)) {
            throw new \Exception($path.'文件不存在');
        }
        $this->content = file_get_contents($path);
        $encode = mb_detect_encoding($this->content, ['ASCII', 'UTF-8', 'GB2312', "GBK", 'BIG5']);
        $this->content = mb_convert_encoding($this->content, $to_encode, $encode);
        return $this;
    }

    /**
     * 注明来源文件格式
     */
    public function format($transfer = '')
    {
        switch ($transfer) {
            case 'html_markdown':
                $this->content = (new HtmlMarkdown())->setElement($this->content)->parse()->toString();
                break;
            default:
                throw new \Exception('format error');
                break;
        }
        return $this;
    }

    /**
     * 返回内容
     */
    public function get()
    {
        return $this->content;
    }

    /**
     * 存储
     */
    public function put($path)
    {
        return file_put_contents($path, $this->content);
    }

    public function __call($name, $args)
    {
        echo "run __call";
        exit;
    }

}