<?php

$billetes = [
    ['valor' => 10, 'cantidad' =>10],
    ['valor' => 20, 'cantidad' => 1],
    ['valor' => 50, 'cantidad' =>1],
    ['valor' => 100, 'cantidad' => 0],
];

function mayor_billete_posible(int $monto){
    $billete_mayor['valor'] = 0;
    $billete_indice = 0;
    for($i = 0; $i < count($GLOBALS['billetes']); $i++){
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

function monto_maximo_posible(){
    $monto_maximo = 0;
    foreach($GLOBALS['billetes'] as $billete){
        $monto_maximo += $billete['valor']*$billete['cantidad'];
    }
    return $monto_maximo;
}

function cantidad_billete(int $monto){
    $indice = mayor_billete_posible($monto);
    $cantidad = 0;
    if($monto > monto_maximo_posible()){
        // RETORNA UN ERROR EN CASO LA CANTIDAD SOLICITADA SUPERA A LA MAXIMA POSIBLE
        return "Error: No se puede emitir esa cantidad :c";
    }
    if($monto == 0){
        // CUANDO EL MONTO SE REDUZCA A 0, RETORNARA UN ARRAY VACIO
        return [];
    }
    while($monto >= $GLOBALS['billetes'][$indice]['valor']){
        // SI EL BILLETE ACTUAL SE QUEDA SIN STOCK SALE DEL BUCLE
        if($GLOBALS['billetes'][$indice]['cantidad'] == 0){
            break;
        }
        $GLOBALS['billetes'][$indice]['cantidad'] = $GLOBALS['billetes'][$indice]['cantidad'] - 1;
        $cantidad = $cantidad + 1;
        $monto = $monto - $GLOBALS['billetes'][$indice]['valor'];
    }
    $result[] = ['valor' => $GLOBALS['billetes'][$indice]['valor'], 'cantidad' => $cantidad];
    return array_merge($result, cantidad_billete($monto));
}

$monto = readline("Ingrese un monto a retirar: ");
echo "Cantidad total: ".monto_maximo_posible().PHP_EOL;
echo "Billetes obtenidos:".PHP_EOL;
echo json_encode(cantidad_billete($monto)).PHP_EOL;
echo "Billetes restantes:".PHP_EOL;
echo json_encode($GLOBALS['billetes']).PHP_EOL;