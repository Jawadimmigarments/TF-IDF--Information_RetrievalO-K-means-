<?php
ini_set('post_max_size','80M');
ini_set('upload_max_filesize','2000M');
ini_set('memory_limit','1980M');
ini_set('max_execution_time','3000');

for($i=0;$i<count($_FILES['pdf']['name']);$i++)
{
$col=$_FILES['pdf']['name'][$i];

$filename=explode(".",$col);
$column_name=$filename[0];
$path="./txtdata/";
$file=$path.$col;
echo $column_name;

}


?>