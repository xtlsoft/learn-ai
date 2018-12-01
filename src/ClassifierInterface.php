<?php

namespace LearnAI;

use LearnAI\Export\ExportData;

interface ClassifierInterface {
    public function train($class, $data);
    public function classify($data);
    public function export(): ExportData;
}