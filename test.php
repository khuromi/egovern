<?php

$bday = strtotime("2002-10-29");
$date = strtotime(date('Y-m-d'));

$age = floor(($date - $bday) / (365.25 * 24 * 60 * 60));

echo $age;
