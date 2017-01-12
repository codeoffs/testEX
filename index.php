<?php
require 'inc/Parser.php';

use inc\Parser;

$parser = new Parser('https://habrahabr.ru/post/319302/');
$parser->getDataByUrl();
$parser->replaceByStr('Песочница', 'TEST_001');
$parser->replaceByStr('Разработка', 'TEST_002');
$parser->replaceByArray([
	'Иван' => 'TEST_003',
	'Хабы' => 'TEST_004',
	'карма' => 'TEST_005',
	'Предисловие' => 'TEST_006',
	'FPS' => 'TEST_007',
]);

//$parser->inverse(); инверсия замены
echo $parser->getContent();