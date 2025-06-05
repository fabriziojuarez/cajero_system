<?php


$billetes = [
    ['valor' => 10, 'cantidad' =>100],
    ['valor' => 20, 'cantidad' =>100],
    ['valor' => 50, 'cantidad' =>100],
    ['valor' => 100, 'cantidad' => 100],
];

$salida = [];

function billete_mayor(int $monto){
    foreach($GLOBALS['billetes'] as $billete){
        if($monto >= $billete['valor']){
            $billete_mayor = $billete;
        }
    }
    return $billete_mayor;
}

function cantidad_billete(int $monto, int $valor_billete){
    $cantidad = 0;
    $conteo = true;
    while($conteo){
        if($monto < $valor_billete){
            $conteo = false;
        }
        $monto = $monto-$valor_billete;
        $cantidad = $cantidad + 1;
    }
    $cantidad = $cantidad - 1;
    return $cantidad;
}

function menor_cantidad_posible(int $monto){
    $billete_mayor = billete_mayor($monto);
    $cantidad = cantidad_billete($monto, $billete_mayor['valor']);
    ajustar_cantidad($billete_mayor,$cantidad);
    $billete = [
        'valor' => $billete_mayor['valor'],
        'cantidad' => $cantidad,
    ];
    $nuevo_monto=$monto-$billete_mayor['valor']*$cantidad;
    
    array_push($GLOBALS['salida'], $billete, menor_cantidad_posible($nuevo_monto));
}

function ajustar_cantidad(array $billete_seleccionado, int $cantidad_usada){
    for($i=0; $i<count($GLOBALS['billetes']); $i++){
        if($GLOBALS['billetes'][$i] == $billete_seleccionado){
            $GLOBALS['billetes'][$i]['cantidad'] = $GLOBALS['billetes'][$i]['cantidad']-$cantidad_usada;
        }
    }
}

menor_cantidad_posible(710);
//$prueba = mayor_valor($billetes);

echo var_dump($GLOBALS['billetes']);