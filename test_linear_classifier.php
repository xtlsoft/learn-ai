<?php

require_once "vendor/autoload.php";

$f = 0;

for ($a = 0; $a < 20; ++ $a) {

$c = new \LearnAI\LinearClassifier(0.7, 1, 0);

$t = function ($cl, $d) use ($c) {
    $c->train($cl, $d);
};

$pair = function ($x, $y) {
    return new \LearnAI\Structure\Pair($x, $y);
};

$real_k = rand(1, 1000000) / 100000;
echo " :: real_k = $real_k \r\n";

$typ = 1;

for ($i = 0; $i < 1500000; ++ $i) {
    $typ = $typ == 1 ? 0 : 1;
    $x = rand(1, 1000000);
    $y_mid = $real_k * $x;
    if ($typ) {
        $y = rand($y_mid * 100, $y_mid * 100 * 100) / 100;
    } else {
        $y = rand(0, $y_mid * 100) / 100;
    }
    $t($typ, $pair($x, $y));
    if ($i % 150000 == 0 && $i != 0) {
        echo "  => in $i k = " . $c->export()->trained['x']. PHP_EOL;
    }
}

echo "  => in $i k = " . $c->export()->trained['x']. PHP_EOL;

$fail = 0;

echo ' -> doing classify test...' . PHP_EOL;

for ($i = 0; $i < 1000000; ++ $i) {
    $typ = $typ == 1 ? 0 : 1;
    $x = rand(1, 1000000);
    $y_mid = $real_k * $x;
    if ($typ) {
        $y = rand($y_mid * 100, $y_mid * 100 * 100) / 100;
    } else {
        $y = rand(0, $y_mid * 100) / 100;
    }
    if ($typ !== $c->classify($pair($x, $y))) {
        $fail ++;
    }

}

echo " => fail $fail/1000000\r\n";

$f += $fail;

sleep(1);

}

echo "=> all fail $f/20000000\r\n";