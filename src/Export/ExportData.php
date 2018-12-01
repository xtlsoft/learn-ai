<?php

namespace LearnAI\Export;

class ExportData {

    public static function fromString(string $str): ExportData {
        static $header = "__LEARN_AI__EXPORT_DATA__V0__";
        static $sep = "X0X$0X0%X0X#0X0@X0X&0X0^X0X*0XO";
        if (substr($str, 0, strlen($header)) === $header) {
            $str = substr($str, strlen($header));
            $str = explode($sep, $str);
            $expDat = new self;
            $expDat->options = unserialize($str[0]);
            $expDat->trained = unserialize($str[1]);
            return $expDat;
        } else {
            return null;
        }
    }

    public $options = [];
    public $trained = [];

    public function __toString() {
        $rslt = '__LEARN_AI__EXPORT_DATA__V0__';
        $rslt .= serialize($this->options);
        $rslt .= "X0X$0X0%X0X#0X0@X0X&0X0^X0X*0XO";
        $rslt .= serialize($this->trained);
        return $rslt;
    }

}