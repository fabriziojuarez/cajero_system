<?php

$billetes = [
    ['valor' => 10, 'cantidad' =>100],
    ['valor' => 20, 'cantidad' =>0],
    ['valor' => 50, 'cantidad' =>100],
    ['valor' => 100, 'cantidad' => 100],
];

function mayor_valor_posible(int $monto){
    $mayor_valor_posible = 0;
    foreach($GLOBALS['billetes'] as $billete){
        if($monto > $billete['valor']){
            if($billete['valor'] > $mayor_valor_posible){
                if($billete['cantidad'] !== 0){
                    $mayor_valor_posible = $billete;
                }
            }
        }
    }
    return $mayor_valor_posible;
}

function cantidad_posible(int $monto, int $valor_billete){
    $billete_mayor = mayor_valor_posible($monto);
    $cantidad_billete = $billete_mayor['cantidad'];
    if($cantidad_billete == 0){
        $GLOBALS['billetes'] = array_diff($GLOBALS['billetes'], $billete_mayor);
    }
    $cantidad_usada = 0;
    while($monto > $billete_mayor['valor']){
        $monto = $monto - $billete_mayor['valor'];
        $cantidad_usada = $cantidad_usada + 1;
    }

}

$monto = 80;

$salida = [];

echo $GLOBALS['monto'];

$result = mayor_valor_posible(40);

echo var_dump($result);

echo var_dump(mayor_valor_posible($GLOBALS['monto']));
//echo var_dump($GLOBALS['billetes']);