## Sistema de Cajero basico
### Funcionamiento
Este pequeño proyecto surgio por la cuestion de como funciona un cajero automatico comun, le pides una cantidad de dinero y este entrega una cantidad minima de billetes dependiente de su stock.
Es decir por ejemplo:  
Si le pidieras "70"(Independiente en el tipo de moneda de tu pais)  
La maquina tendria que ver el valor de los billetes que tiene en stock, y entregar la minima cantidad posible  
En el caso de Perú, los billetes tienen valores de: 10, 20, 50, 100 y 200  
Teniendo esto en cuenta, el sistema te entregaria:  
1 billete de valor de 50  
1 billete de valor de 20  
Esto en el caso de que haya stock de billetes de ese valor  
En dado caso de que por ejemplo no haya billetes de 20 o 50, el sistema tendria que remplazarlos con billetes que si tenga como el de 10.

### Flujo de codigo
1. Primero se asigna el monto que se desea retirar.  
2. Se llama la funcion "cantidad_billetes" con el argumento del monto
    * Este llama a la funcion "mayor_cantidad_posible" para determinar el billete de mayor valor posible para el monto. Ejemplo:  
    Si pidiera 80, el sistema no te podria entregar uno de 100 ya que excede el monto solicitado, asi que iria por el de 50  
    y en caso de que no haya stock de ese billete, iria por el de 20, tambien revisando la condicion de que haya stock  
3. Continuando con la funcion "cantidad_billetes", teniendo el maximo valor posible se realiza un bucle que disminuye el monto con el valor del billete: $monto = $monto - $valor_de_billete  
    * Aqui se cuenta cuantas veces se realiza ese bucle con esa cantidad de billete  
    * Si el monto llega a 0: Se sale del bucle  
    * Si la cantidad del billete actual llega a 0: Se llama de nuevo a la funcion "mayor_cantidad_posible" para ajustar el nuevo valor de billete para continuar con el bucle  
      Nota: Esta parte tambien guarda el conteo donde se quedo el otro billete y reinicia el contador para el nuevo valor  
4. Como el bucle esta con la condicion: $monto > $valor_del_billete  
    Puede ocurrir que haya un valor restante que aun puede ser retirado con los billetes existentes  
    Es decir, si pidiera 450. El bucle revisaria que haya stock suficiente de "100", en caso haya seguiria hasta llegar al punto de: 50(monto) > 100(valor de billete actual)  
    En ese caso, se guardara el conteo que finalizo el bucle y revisara si el monto no es 0:  
    * Si es 0: es decir el bucle fue suficiente para la cantidad solicitada, se retornara eso.  
    * Si no es 0(como en nuestro ejemplo que sobro 50): el conteo se unira con el resultante de la funcion "cantidad_billete" con argumento del monto restante(en este caso 50)
5. Finalmente retorna el valor resultante, siendo un array con el valor del billete y cuantas iteraciones dio en el bucle, y en caso haya determinado que aun se puede retirar esa cantidad, lo retornara unido con el valor resultante de la misma funcion con el argumento del monto restante.

Nota: Aun falta corregir algunas cosas, como mejorar la estructura del codigo y agregar un manejo de errores que se agregaran proximamente y una disculpa si no se llega a entender bien el proyecto.
