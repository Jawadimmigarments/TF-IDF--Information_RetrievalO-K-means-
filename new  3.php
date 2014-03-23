<?php
function query_similarity($mat1)
{
$arr1=$mat1;
$arr2=array();
$sim_querydoc_array=array();
$query11="select count(column_name) from information_schema.columns where table_schema='test' and table_name='rownum_terms'";
$result11=mysql_query($query11);
$data11=mysql_fetch_array($result11);
$col_no=$data11[0];
echo $col_no;

for($i=3;$i<$col_no;$i++)
{
$query12="select column_name from information_schema.columns where ordinal_position='$i' and table_schema='test' and table_name='rownum_terms'";
$result12=mysql_query($query12) or die(mysql_error());
$data12=mysql_fetch_array($result12);
$col=$data12['column_name'];
echo $col;
$query="select * from rownum_terms";
$result=mysql_query($query) or die(mysql_error());
	while($data=mysql_fetch_array($result))
	{	
	echo $col;

	array_push($arr2,$data[$col]);
	}
print_r($arr2);
$dotproduct=0;
$sim_den1=0;
$sim_den2=0;
$sim_den=0;

for($i=0;$i<count($arr1);$i++)
{
$dotproduct=$dotproduct+($arr1[$i]*$arr2[$i]);
$sim_den1=$sim_den1+($arr1[$i]*$arr1[$i]);
$sim_den2=$sim_den2+($arr2[$i]*$arr2[$i]);
}


$sim_den1=sqrt($sim_den1);

$sim_den2=sqrt($sim_den2);

$sim_den=$sim_den1+$sim_den2;
$sim_num=$dotproduct;
$sim=$sim_num/$sim_den;

array_push($sim_querydoc_array,$sim);
}
print_r($sim_querydoc);
}
?>