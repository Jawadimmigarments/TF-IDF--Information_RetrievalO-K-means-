<?php
/*update_clusterhead($d1,$d2);*/
ini_set('max_execution_time',30000);
function update_clusterhead($mat1,$mat2)
{
$col_name=$mat1;
$tab_name=$mat2;

$host=""; // Host name
$username=""; // Mysql username
$password=""; // Mysql password
$db_name=""; // Database name
$arr1=array();
$arr2=array();
$arr3=array();
$con=mysql_connect($host,$username,$password)or
die(mysql_error());
mysql_select_db($db_name,$con);//or die(mysql_error());
$query0="alter table $tab_name add column $col_name float default 0";
$result0=mysql_query($query0);// or die(mysql_error());
$query="select * from $tab_name";
$result=mysql_query($query);// or die(mysql_error());
while($data=mysql_fetch_array($result))
{
array_push($arr1,$data['term']);
}
$query1="select * from rownum_terms2";
$result1=mysql_query($query1); //or die(mysql_error());
while($data1=mysql_fetch_array($result1))
{
array_push($arr2,$data1['term']);
array_push($arr3,$data1["$col_name"]);
}
foreach($arr2 as $key=>$val)
{
if(in_array($val,$arr1))
{
$var=$arr3[$key];
$query2="update $tab_name set $col_name=$var where term='".$val."'";
mysql_query($query2) or die(mysql_error());
}
else
{
$query3="insert into $tab_name(term) values($val)";
$query4="update $tab_name set $col_name=$arr3[$key] where term=$val";
mysql_query($query3);
mysql_query($query4);
}
}
mysql_close($con);
$con=mysql_connect($host,$username,$password)or
die(mysql_error());
mysql_select_db($db_name,$con);
$query11="select count(column_name) from information_schema.columns where table_schema='test' and table_name='$tab_name'";
$result11=mysql_query($query11) or die(mysql_error());
$data11=mysql_fetch_array($result11);
$col_no=$data11[0];
$query9="select * from $tab_name";

for($i=2;$i<=$col_no;$i++)
{
${'doc'.$i}=array();
$query12="select column_name from information_schema.columns where table_name='$tab_name' and ordinal_position=$i";
$result12=mysql_query($query12) or die(mysql_error());
$data12=mysql_fetch_array($result12);
$col_name=$data12[0];
$result=mysql_query($query9) or die(mysql_error());
while($data=mysql_fetch_array($result))
{
array_push(${'doc'.$i},$data["$col_name"]);
}
}
$mean=array();
for($j=0;$j<count($doc2);$j++)
{
$sum=0;
for($i=2;$i<=$col_no;$i++)
{
$sum=$sum+${'doc'.$i}[$j];
}
$sum=$sum/$col_no;
array_push($mean,$sum);
}
foreach($mean as $key=>$val)
{
$row=$key+1;
$query22="update cluster_heads set $tab_name=$val where rownum=$row";
mysql_query($query22) or die(mysql_error());
}

mysql_close($con);
}

?>