<?php
include('update_cluster.php');
ini_set('max_execution_time',30000);
for($i=0;$i<count($_FILES['pdf']['name']);$i++)
{
$col=$_FILES['pdf']['name'][$i];
$filename=explode(".",$col);
$column_name=$filename[0];
similar_doc($column_name);
}
function similar_doc($mat1)
{

$col_name=$mat1;

$host=""; // Host name
$username=""; // Mysql username
$password=""; // Mysql password
$db_name=""; // Database name
$con=mysql_connect($host,$username,$password)or
die(mysql_error());
mysql_select_db($db_name,$con)or die(mysql_error());
$doc1=$col_name;
$doc2="AaronPressman";
$doc3="AlanCrosby";
$doc4="AlexanderSmith";
$doc5="BenjaminKangLim";
$doc6="BernardHickey";
$doc7="BradDorfman";
$doc8="DarrenSchuettler";
$doc9="DavidLawder";
$var1=doc_similarity($doc1,$doc2);
$var2=doc_similarity($doc1,$doc3);
$var3=doc_similarity($doc1,$doc4);
$var4=doc_similarity($doc1,$doc5);
$var5=doc_similarity($doc1,$doc6);
$var6=doc_similarity($doc1,$doc7);
$var7=doc_similarity($doc1,$doc8);
$var8=doc_similarity($doc1,$doc9);
$sim_array=array();
$sorted_sim=array();
for($i=1;$i<9;$i++)
{
$sim=${'var'.$i};
 
array_push($sim_array,$sim);
}

$varnum=sort_resultarray($sim_array);
$sim_col=${'doc'.$varnum};
echo $sim_col;
update_clusterhead($col_name,$sim_col);
}


function sort_resultarray($mat1)
{
$arr1=$mat1;
$arr2=$arr1;
$arr3=array();
$sorted_results=array();
echo "\n";
rsort($arr2);
echo "\n";
echo "\n";
foreach($arr2 as $key=>$val)
{
foreach($arr1 as $key1=>$val1)
{
if($val==$val1 and $val>0)
{
array_push($sorted_results,$key1);
}
}
}
$sorted_results=array_unique($sorted_results);

$sim_col=$sorted_results[0];
$sim_col=$sim_col+2;

return $sim_col;

}

function doc_similarity($mat1,$mat2)
{
$arr1=array();
$arr2=array();
$col1=$mat1;
$col2=$mat2;
$query="select * from rownum_terms2";
$result=mysql_query($query);
while($data=mysql_fetch_array($result))
{
array_push($arr1,$data["$col1"]);
}
$query2="select * from cluster_heads";
$result2=mysql_query($query2);
while($data2=mysql_fetch_array($result2))
{
array_push($arr2,$data2["$col2"]);
}

$dotproduct=0;
$sim_den1=0;
$sim_den2=0;
$sim_den=0;
for($i=0;$i<count($arr2);$i++)
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
return $sim;
}
?>