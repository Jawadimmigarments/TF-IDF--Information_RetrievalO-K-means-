<html>
<head>
<title> TEST </title>
</head>
<body>
<?php
$host=""; // Host name
$username=""; // Mysql username
$password=""; // Mysql password
$db_name=""; // Database name
$tbl_name=""; // Table name
$file_name=$_FILES['pdf']['name'];

$filename=explode(".",$file_name);

$column_name=$filename[0];

ini_set('max_execution_time',300);
include('pdf2text.php');
include('stem_code.php');
$a = new PDF2Text();
$a->setFilename($file_name); 
$a->decodePDF();
$stringput = $a->output(); 

$stringput=strtolower($stringput);
$allword_count=explode(" ",$stringput);

$wordarray=array();
$wordarrays=array();
foreach($allword_count as $key=>$val)
{
{
array_push($wordarrays,$val);
}
}

/*Stemming Code*/
foreach($wordarrays as $key=>$word)
{
$stem = PorterStemmer::Stem($word);
array_push($wordarray,$stem);
}

$stopwords=array('on','us','xc','be','by','at','but','e','i','be','by','g','j','and','is','f','are','p','can','each','we','x','in','b','as','c','d','for','also','an','all','-','a','any','in','the','thesis','to','of','dammalapati');

$useful_words=implode("=>",$wordarray);

$useful_words=str_replace("=>"," ",$useful_words);



$word_count=(array_count_values(str_word_count($useful_words,1)));
ksort($word_count);


$con=mysql_connect($host,$username,$password)or
die(mysql_error());
mysql_select_db($db_name,$con)or die(mysql_error());
$query = "SELECT COUNT(*) as totalno FROM terms";
    $result = mysql_query($query);
    while($data=mysql_fetch_array($result)){
    $count = $data['totalno'];
    }

if($count==0)
{
foreach($word_count as $key=>$val)
{
if(in_array($key,$stopwords))
{

}
else
{

$alter_sql="ALTER table $tbl_name ADD $column_name int(50)";
mysql_query($alter_sql);

$sql="INSERT into $tbl_name (term,$column_name) VALUES ($key,$val)";
mysql_query($sql);

}
}
}




else
{
$alter_sql="ALTER table $tbl_name ADD $column_name int(50)";
mysql_query($alter_sql);

$select_sql="Select term from $tbl_name";
$select_result=mysql_query($select_sql);
$select_array=array();
while($row=mysql_fetch_array($select_result)) 
{
array_push($select_array,$row['term']);
}
$selected_array=implode("=>",$select_array);
$selected_array=str_replace("=>"," ",$selected_array);

foreach($word_count as $key=>$val)
{
if(in_array($key,$stopwords))
{

}
else
{
if(in_array($key,$select_array))
{

$update_sql="update $tbl_name set $column_name='$val' where term='$key'";
mysql_query($update_sql);

}
else
{

$insert_sql="Insert into $tbl_name (term) VALUES ('$key')";
$update_sql="update $tbl_name set $column_name='$val' where term='$key'";
mysql_query($insert_sql);

mysql_query($update_sql);

}
}
}
}

$zero_query="update $tbl_name set $column_name=0 where $column_name is NULL";
mysql_query($zero_query);
mysql_close($con);
?>
</body>
</html>
