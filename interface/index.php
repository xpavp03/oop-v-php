<?php
require_once 'IStringable.php';
require_once 'Sample.php';

$sample = new Sample('ahoj');
print (string)$sample;

/**
 * Vestavěné interface:
 * @see https://www.php.net/manual/en/reserved.interfaces.php
 * @see https://www.php.net/manual/en/spl.interfaces.php
 */
