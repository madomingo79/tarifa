<?php

$proveedor=array();
$fichero="salida.csv";

if (sizeof($argv)<>3){
	echo "Uso: tarifa fichero fichero\n";
}else{
	$lineas=file($argv[2]);
	foreach($lineas as $linea){
		$temporal=explode("\t",$linea);
		$proveedor["\"".$temporal[0]."\""][0]=trim($temporal[1]);
	}
	
	$lineas=file($argv[1]);
	foreach($lineas as $linea){
	    $temporal=explode("\t",$linea);
	    if(array_key_exists($temporal[0],$proveedor)){
	        echo ".";
	        $temporal[3]=trim($temporal[3]);
	        $temporal[4]=$proveedor[$temporal[0]][0];
	        $salida=implode("\t",$temporal)."\n";
	        file_put_contents($fichero,$salida , FILE_APPEND | LOCK_EX);
	    }else{
	        $salida=implode("\t",$temporal);
	        file_put_contents($fichero,$salida , FILE_APPEND | LOCK_EX);
	    }
	}
}
?>
