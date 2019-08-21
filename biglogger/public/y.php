<pre>
<?php
//$geo = file_get_contents('http://api.ipstack.com/113.20.98.139?access_key=61adbb033491090099d6870ca0ac7833');
// $geo = explode(',', $geo);
// $geo = $geo[7] . ',' . $geo[5];
$geo = '""region_name":"Hanoi","country_name":"Vietnam""';
$geo = str_replace('"', '', $geo);
$geo = str_replace(':', '', $geo);
$geo = str_replace('region_name', '', $geo);
$geo = str_replace('country_name', '', $geo);
var_dump($geo);
?>
</pre>