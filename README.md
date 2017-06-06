### Origen

El repertorio de original nombre nace de la necesidad de mostrar en un grupo concreto de WhatsApp el ranking de personas que más escribían y de mensajes por hora del día.
La primera solución para el problema fue con Excel, tras un trabajo largo y tedioso, pero que solucionó la parte teórica.

### Funcionamiento

La aplicación tiene un pequeño formulario en que el usuario selecciona el documento .txt extraído de Whatsapp, introduce una contraseña para el borrado de la información, y acepta la política de datos.
El archivo `php/process.php` se encarga del limpiado y fragmentación de las lineas de texto, que guarda en una tabla creada específicamente para el usuario.

### Problemas conocidos

* El procesado del archivo lleva demasiado tiempo, superando con creces el valor `max_execution_time` definido en el php.ini, e imposible de modificar en la mayor parte de los servidores compartidos.
* La estética es heredada de una plantilla que encontré en el momento, habría que rehacerla con un poco de cabeza
