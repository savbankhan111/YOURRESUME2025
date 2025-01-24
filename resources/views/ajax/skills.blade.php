<?php 
  $data = '[';
 if(sizeof($skills) > 0){ 
   $c = 1;
  foreach($skills as $skill){
   $data .= '"'.$skill->name.'"';
   if($c < sizeof($skills)){
	$data .=',';
   }	   
   $c++;
  }
 }
 $data .= ']';
echo $data;
?>