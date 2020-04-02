<?php
require_once 'SampleTrait.php';
require_once 'SampleClass.php';

$sample = new SampleClass;

$sample->vlastniMetoda();
$sample->metodaTraity();

echo $sample->stejnyNazev();