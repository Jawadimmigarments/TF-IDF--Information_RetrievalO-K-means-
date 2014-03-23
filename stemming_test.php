<?php
include('stem_code.php');
$words=array('abominable','conduction');
//$a = new PorterStemmer();
foreach($words as $word)
{
//$a->Stem($word);
$stem = PorterStemmer::Stem($word);
//echo $word;
echo $stem;
echo " ";
}
?>