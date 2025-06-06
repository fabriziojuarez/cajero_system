<?php

$salida = [];

$billetes = [
    ['valor' => 10, 'cantidad' =>100],
    ['valor' => 20, 'cantidad' =>20],
    ['valor' => 50, 'cantidad' =>100],
    ['valor' => 100, 'cantidad' => 100],
];

function mayor_valor_posible(int $monto){
    $mayor_valor_posible['valor'] = 0;
    foreach($GLOBALS['billetes'] as $billete){
        if($monto >= $billete['valor']){
            if($billete['cantidad'] > 0){
                if($billete['valor'] > $mayor_valor_posible['valor']){
                    $mayor_valor_posible = $billete;
                }
            }
        }
    }
    return $mayor_valor_posible;
}

function cantidad_posible(int $monto){
    $billete_mayor = mayor_valor_posible($monto);
    //$cantidad_billete = $billete_mayor['cantidad'];
    $cantidad_usada = 0;
    while($monto >= $billete_mayor['valor']){
        $monto = $monto - $billete_mayor['valor'];
        $cantidad_usada = $cantidad_usada + 1;
    }
    $result = ['valor' => $billete_mayor['valor'], 'cantidad' => $cantidad_usada];
    if($monto == 0){
        return $result;
    }
    //echo var_dump($result);
    array_push($GLOBALS['salida'], $result, cantidad_posible($monto));
    return $GLOBALS['salida'];
}

//$monto = 80;


//echo $GLOBALS['monto'];
echo var_dump(cantidad_posible(80));


//echo var_dump(mayor_valor_posible($GLOBALS['monto']));
//echo var_dump($GLOBALS['billetes']);