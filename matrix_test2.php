<?php
//function tf_idf_generation()
{
include('doc_similarity.php');
ini_set('max_execution_time',30000);
$host=""; // Host name
$username=""; // Mysql username
$password=""; // Mysql password
$db_name=""; // Database name
$tbl_name=""; // Table name
$con=mysql_connect($host,$username,$password)or
die(mysql_error());
mysql_select_db($db_name,$con)or die(mysql_error());
$new_cols=array();
$old_cols=array();
$querya="select column_name from information_schema.columns where table_schema='test' and table_name='rownum_terms2'";
$resulta=mysql_query($querya);
while($dataa=mysql_fetch_array($resulta))
{
array_push($old_cols,$dataa['column_name']);
}

$query0="drop table rownum_terms2";
mysql_query($query0);
$query="create table rownum_terms2 as (select @rownum:=@rownum+1 as rownum,t.* FROM terms2 t, (select @rownum:=0) r)";
mysql_query($query);

{

$query2="SELECT ordinal_position,column_name FROM INFORMATION_SCHEMA.COLUMNS WHERE table_schema = 'test' AND table_name = 'terms2'";
$query1="SELECT COUNT(*) as totalcol FROM INFORMATION_SCHEMA.COLUMNS WHERE table_schema = 'test' AND table_name = 'terms2'";
$result1 = mysql_query($query1);
    while($data=mysql_fetch_array($result1)){
    $count1 = $data['totalcol'];
    }
	for($i=2;$i<=$count1;$i++)
	{
	${'doc'.$i}=array();
	$query2="SELECT column_name FROM INFORMATION_SCHEMA.COLUMNS WHERE ordinal_position=$i and table_schema = 'test' AND table_name = 'terms2'";
	$result2=mysql_query($query2);
	$col_name=mysql_fetch_array($result2);
	$column_name=$col_name[0];
	$query3="select * from terms2";
	$result3=mysql_query($query3);
	while($data=mysql_fetch_array($result3)){
	array_push(${'doc'.$i},$data[$column_name]);
	
	}
	}

}


// Crete IDF matrix//
//function func_IDFmatrix()

$IDF_array=array();
$IDF_num=$count1;
$query5="SELECT COUNT(*) as totalrows from terms2";
$result5=mysql_query($query5) or die(mysql_error());
    while($data=mysql_fetch_array($result5)){
    $count2 = $data['totalrows'];
    }
for($j=0;$j<$count2;$j++)
{
$IDF_den=1;
for($i=2;$i<=$count1;$i++)
{

echo "\n";
foreach(${'doc'.$i} as $key=>$val)
{
if($key==$j and $val!=0)
{
$IDF_den=$IDF_den+1;
}
}
}
$IDF_value0=$IDF_num/$IDF_den;
$IDF_value=log($IDF_value0,10);
array_push($IDF_array,$IDF_value);
}
//TF-IDF values into database

for($i=2;$i<=$count1;$i++)
{
$TF_IDF_array=array();
$k=-1;
foreach(${'doc'.$i} as $key=>$val)
{
$k++;
$tf_idf=$val*$IDF_array[$k];
array_push($TF_IDF_array,$tf_idf);
}
$query12="select column_name from information_schema.columns where ordinal_position=$i and table_schema='test' and table_name='terms2'";
$data=mysql_query($query12) or die(mysql_error());
$result=mysql_fetch_array($data);
$column_name=$result[0];
$m=0;
foreach($TF_IDF_array as $key=>$val)
{
$m++;
echo $val;
echo "\n";
$query13="update rownum_terms2 set $column_name=$val where rownum=$m";
$data=mysql_query($query13) or die(mysql_error());
}
unset($TF_IDF_array);
}
$queryb="select column_name from information_schema.columns where table_schema='test' and table_name='rownum_terms2'";
$resultb=mysql_query($queryb);
while($datab=mysql_fetch_array($resultb))
{
array_push($new_cols,$datab['column_name']);
}
//print_r($new_cols);


foreach($new_cols as $key=>$val)
{
if(in_array($val,$old_cols))
{
echo $val;
echo "Up to date";
echo "\n";echo "\n";
echo "\n";
echo "\n";
}
else
{
similar_doc($val);
//echo $val;
}
}
mysql_close($con);
}
?>

