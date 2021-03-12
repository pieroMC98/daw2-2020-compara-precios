<?php
$datos= array(
  array( 'F1+T1 - Usuarios', 'XXXXX', 0),
  array( 'F2+T2 - Tiendas', 'XXXXX', 0),
  array( 'F3+T3 - Articulos', 'XXXXX', 0),
  array( 'F4+T4 - Categorias', 'XXXXX', 0),
  array( 'F5+T5 - Comentarios', 'XXXXX', 0),
  array( 'F6+T6 - Historicos', 'XXXXX', 0),
);
$grupos= array(
  1=> array( 'Saul + Sergio', 0),
  2=> array( 'Andres + Jose Maria', 0),
  3=> array( 'Piero + Rafael', 0),
  4=> array( 'Miguel + Jose Luis', 0),
  5=> array( 'Alejandro + Rodrigo', 0),
  6=> array( 'Fahd + Ruben', 0),
);

//$sem= time();
$sem= microtime( true)*1000000 % 17234;
srand( $sem);
$sem= rand(1,1000);//
//$sem= 687;//2018-2019
//$sem= 572;//2019-2020
$sem= 921;//2020-2021
echo '<hr/>'.$sem.'<hr/>';
srand( $sem);
foreach( $grupos as $g => $grupo) {
  $t= rand( 1, count($datos)) - 1;
  while ($datos[$t][2]) {
    $t= rand( 1, count($datos)) - 1;
  }
  if (!$datos[$t][2]) {
    $grupos[$g][1]= $t;
    $datos[$t][2]= $g;
  }
}
//echo '<pre>'; print_r( $datos); echo '</pre>';
//echo '<pre>'; print_r( $grupos); echo '</pre>';


echo "\r\n";
foreach( $datos as $tarea) {
  echo '<hr/>';
  echo 'Tarea: '.$tarea[0].'<br/>';
  echo 'Grupo '.$tarea[2].': '.$grupos[$tarea[2]][0];
  echo "\r\n";
}
echo "\r\n";