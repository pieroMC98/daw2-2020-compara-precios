<?php


$tablas = array("articulos","articulos_etiquetas","articulos_tienda","avisos_usuarios",
               "categorias","clasificadores","comentarios","configuraciones","etiquetas",
               "historico_precios","moderadores","ofertas","regiones","regiones_moderador",
               "registros_aplicacion","seguimientos_usuario","tiendas","tiendas_etiquetas","usuarios");
$numeroElementos = count($tablas);
for($i=0;$i<$numeroElementos;$i++)
{
    echo ''.$tablas[$i].'<br>';
}

// variables
$dbhost = 'localhost';
$dbname = 'daw2_20_comparaprecios';
$dbuser = 'root';
$dbpass = '';

SELECT * INTO OUTFILE '../../../result.sql'
  FIELDS TERMINATED BY ','
  LINES TERMINATED BY '\n'
  FROM categorias;

  LOAD DATA INFILE '../../../result.sql' INTO TABLE test
  FIELDS TERMINATED BY ','  LINES TERMINATED BY '\n';

?>

