<?php
$fechaActual = date('Y-m-d H:i:s');
echo $fechaActual.' - ';
$fechaMesAnterior = date('Y-m-d H:i:s', strtotime($fechaActual.'-3 month'));
echo $fechaMesAnterior;