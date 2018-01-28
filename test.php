<?php 
function randomkeys($length)
{
 $pattern='1234567890';
 $key='';
 for($i=0;$i<$length;$i++)
 {
   $key= $key. $pattern[mt_rand(0,9)]; 
 }
 return $key;
}
 echo randomkeys(6);
 
