<?php

require_once "vendor/autoload.php";

$c = new \LearnAI\LinearClassifier(0.5, 'up', 'down');

$t = function ($cl, $d) use ($c) {
    $c->train($cl, $d);
    echo 'x = ' . $c->export()->trained['x']. PHP_EOL;
};

while (1) {
    $a = "";
    $x = 0.0;
    $y = 0.0;
    fscanf(STDIN, "%s %f %f", $a, $x, $y);
    if ($a == 'end') break;
    $t($a, new \LearnAI\Structure\Pair($x, $y));
}

echo $c->export();

while (1) {
    $x = 0.0;
    $y = 0.0;
    fscanf(STDIN, "%f %f", $x, $y);
    echo $c->classify(new \LearnAI\Structure\Pair($x, $y)) . PHP_EOL;
}