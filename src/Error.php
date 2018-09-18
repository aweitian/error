<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/8
 * Time: 10:28
 * 设置级别，获取时，小于这个级别的信息被屏蔽
 */

namespace Aw;

class Error
{
    const VERBOSE = 0x0;//显示全部信息
    const DEBUG = 0x1;//显示调试信息
    const INFORMATION = 0x2;//显示一般信息
    const WANING = 0x3;//显示警告信息
    const ERROR = 0x4;//显示错误信息

    protected $level = self::WANING;

    protected $debug = array();
    protected $information = array();
    protected $waning = array();
    protected $error = array();

    /**
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param int $level
     */
    public function setLevel($level)
    {
        $this->level = $level;
    }

    /**
     * @return array
     */
    public function getVerbose()
    {
        return array_merge($this->debug, $this->information, $this->waning, $this->error);
    }

    /**
     * @return array
     */
    public function getDebug()
    {
        return $this->debug;
    }

    /**
     * @param array $debug
     */
    public function setDebug($debug)
    {
        $this->debug = $debug;
    }

    /**
     * @return array
     */
    public function getInformation()
    {
        return $this->information;
    }

    /**
     * @param array $information
     */
    public function setInformation($information)
    {
        $this->information = $information;
    }

    /**
     * @return array
     */
    public function getWaning()
    {
        return $this->waning;
    }

    /**
     * @param array $waning
     */
    public function setWaning($waning)
    {
        $this->waning = $waning;
    }

    /**
     * @return array
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param array $error
     */
    public function setError($error)
    {
        $this->error = $error;
    }

    /**
     * @return array
     */
    public function get()
    {
        if ($this->level == self::VERBOSE) {
            return $this->getVerbose();
        }
        $ret = array();
        if (self::DEBUG >= $this->level) {
            $ret = array_merge($ret, $this->debug);
        }
        if (self::INFORMATION >= $this->level) {
            $ret = array_merge($ret, $this->information);
        }
        if (self::WANING >= $this->level) {
            $ret = array_merge($ret, $this->waning);
        }
        if (self::ERROR >= $this->level) {
            $ret = array_merge($ret, $this->error);
        }
        return $ret;
    }

    /**
     * @return string
     */
    public function last()
    {
        $r = $this->get();
        return empty($r) ? '' : end($r);
    }

    /**
     * @return $this
     */
    public function reset()
    {
        $this->debug = array();
        $this->information = array();
        $this->waning = array();
        $this->error = array();
        return $this;
    }

    /**
     * @return bool
     */
    public function has()
    {
        $r = $this->get();
        return empty($r);
    }

    /**
     * @return bool
     */
    public function hasError()
    {
        return empty($this->error);
    }

    /**
     * @return bool
     */
    public function hasWaning()
    {
        return empty($this->waning);
    }

    /**
     * @return bool
     */
    public function hasInformation()
    {
        return empty($this->information);
    }

    /**
     * @return bool
     */
    public function hasDebug()
    {
        return empty($this->debug);
    }

    /**
     * @param $item
     * @return $this
     */
    public function addError($item)
    {
        $this->error[] = $item;
        return $this;
    }

    /**
     * @param $item
     * @return $this
     */
    public function addWaning($item)
    {
        $this->waning[] = $item;
        return $this;
    }

    /**
     * @param $item
     * @return $this
     */
    public function addInformation($item)
    {
        $this->information[] = $item;
        return $this;
    }

    /**
     * @param $item
     * @return $this
     */
    public function addDebug($item)
    {
        $this->debug[] = $item;
        return $this;
    }


    /**
     * @param $items
     * @return $this
     */
    public function mergeError($items)
    {
        $this->error = array_merge($this->error, $items);
        return $this;
    }

    /**
     * @param $items
     * @return $this
     */
    public function mergeWaning($items)
    {
        $this->waning = array_merge($this->waning, $items);
        return $this;
    }

    /**
     * @param $items
     * @return $this
     */
    public function mergeInformation($items)
    {
        $this->information = array_merge($this->information, $items);
        return $this;
    }

    /**
     * @param $items
     * @return $this
     */
    public function mergeDebug($items)
    {
        $this->debug = array_merge($this->debug, $items);
        return $this;
    }
}