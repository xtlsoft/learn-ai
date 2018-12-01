<?php

namespace LearnAI\Structure;

class Pair {

    protected $first = null;
    protected $second = null;

    public function __construct($f = null, $s = null) {
        $this->first = $f;
        $this->second = $s;
    }

    public function __toString() {
        return '(' . $this->first . ', ' . $this->second . ')';
    }

    public function getFirst() {
        return $this->first;
    }

    public function getSecond() {
        return $this->second;
    }

    public function setFirst($f): Pair {
        $this->first = $f;
        return $this;
    }

    public function setSecond($f): Pair {
        $this->second = $f;
        return $this;
    }

    public function update($f, $s): Pair {
        $this->__construct($f, $s);
        return $this;
    }

}