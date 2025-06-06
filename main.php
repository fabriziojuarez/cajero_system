<?php

$billetes = [
    ['valor' => 10, 'cantidad' =>100],
    ['valor' => 20, 'cantidad' =>2],
    ['valor' => 50, 'cantidad' =>1],
    ['valor' => 100, 'cantidad' => 5],
];

function mayor_valor_posible(int $monto){
    $billete_mayor['valor'] = 0;
    $billete_indice = 0;
    for($i=0; $i<count($GLOBALS['billetes']); $i++){
        if($monto >= $GLOBALS['billetes'][$i]['valor']){
            if($GLOBALS['billetes'][$i]['cantidad'] > 0){
                if($GLOBALS['billetes'][$i]['valor'] > $billete_mayor['valor']){
                    $billete_indice = $i;
                }
            }
        }
    }
    return $billete_indice;
}

function cantidad_billete(int $monto){
    $result = array();
    $indice = mayor_valor_posible($monto);
    $cantidad = 0;
    while($monto >= $GLOBALS['billetes'][$indice]['valor']){
        $GLOBALS['billetes'][$indice]['cantidad'] = $GLOBALS['billetes'][$indice]['cantidad'] - 1;
        $cantidad = $cantidad + 1;
        $monto = $monto - $GLOBALS['billetes'][$indice]['valor'];
        if($monto == 0){
                continue;
        }
        if($GLOBALS['billetes'][$indice]['cantidad'] == 0){
            $result[] = ['valor' => $GLOBALS['billetes'][$indice]['valor'], 'cantidad' => $cantidad];
            $indice = mayor_valor_posible($monto);
            $cantidad = 0;
        }
    }
    $result[] = ['valor' => $GLOBALS['billetes'][$indice]['valor'], 'cantidad' => $cantidad];
    if($monto !== 0){
        $result = array_merge($result, cantidad_billete($monto));
    }
    return $result;
}



$monto = readline("Ingrese un monto a retirar: ");
echo "Billetes obtenidos:".PHP_EOL;
echo json_encode(cantidad_billete($monto));
echo PHP_EOL;
echo "Billetes dejados:".PHP_EOL;
echo json_encode($GLOBALS['billetes']);
echo PHP_EOL;