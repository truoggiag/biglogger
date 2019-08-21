<?php
$fs = scandir(__DIR__.'/../storage/framework/views/');
echo '<pre><h1>Truoc khi xoa </h1>'.__FILE__.'::'.__METHOD__.'('.__LINE__.')';
print_r($fs);
echo '</pre>';


foreach($fs as $f){
    if($f =='.' || $f == '..' || $f == '.gitignore')
        continue;
    @unlink(__DIR__.'/../storage/framework/views/'.$f);
}

$fs = scandir(__DIR__.'/../storage/framework/views/');

echo '<pre><h1>Sau khi xoa </h1>'.__FILE__.'::'.__METHOD__.'('.__LINE__.')';
    print_r($fs);
echo '</pre>';



die();