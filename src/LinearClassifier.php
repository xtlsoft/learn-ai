<?php

namespace LearnAI;

class LinearClassifier implements ClassifierInterface {
    protected $options = [
        "learningRate" => 0.5,
    ];
    protected $trained = [
        "x" => 0.99,
        "up" => null,
        "down" => null
    ];
    public function __construct($lr = 0.5, $up = 1, $down = 0) {
        $this->options['learningRate'] = $lr;
        $this->trained['up'] = $up;
        $this->trained['down'] = $down;
    }
    public function train($class, $data) {
        if ($class === $this->trained['up']) $cls = 1;
        else if ($class === $this->trained['down']) $cls = 0;
        else return;
        $y = $this->trained['x'] * $data->getFirst();
        $error = $y - $data->getSecond();
        if ($error > 0 && !$cls) return;
        if ($error < 0 && $cls) return;
        $this->trained['x'] -= $error / $data->getFirst() * $this->options['learningRate'];
        return; 
    }
    public function classify($data) {
        $y = $this->trained['x'] * $data->getFirst();
        $error = $y - $data->getSecond();
        if ($error < 0) return $this->trained['up'];
        else return $this->trained['down'];
    }
    public function export(): \LearnAI\Export\ExportData {
        $e = new \LearnAI\Export\ExportData;
        $e->options = $this->options;
        $e->trained = $this->trained;
        return $e;
    }
}