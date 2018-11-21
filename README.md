# EJERCICIO DEMO

### Objetivo
Creación de un proyecto en symfony 4 que cumpla con el enunciado propuesto.

### Propuesta de enunciado

**Parte 1:**
El objetivo de la prueba es desarrollar una aplicación en PHP, sin UI, capaz de solucionar el problema usando persistencia en memoria.         

Desarrolla un sistema tolerante a errores responsable de comprobar el login y password de una lista usuarios con las siguientes condiciones:         
- Devuelva si un usuario existe en el sistema o no.         
- Devuelve si el usuario/password coinciden o no.         

 Añade la cobertura de tests que consideres necesaria para validar el funcionamiento de la aplicación.   
 
**Parte 2:** 
El objetivo de la prueba es desarrollar sólo el juego de tests (unitarios, funcionales o aceptación), sin implementación, con la idea de que un/a tercer/a desarrollador/a pudiera implementar la solución sólo leyendo los tests.         

En el sistema anterior, añade un nuevo caso de uso:         

- Si el usuario/password es correcto, cambiar la password sólo de su mismo usuario (utilizando el mecanismo de autenticación que considere oportuno).

### Pasos para ejecutar el proyecto

Primero de todo es necesario hacer un git clone del proyecto y un composer install para instalar las dependencias:
```
git clone https://github.com/spvernet/demo.git demo
cd demo
composer install
```
A continuación levantamos el servidor:
```
php bin/console server:run (por defecto se levanta en el localhost:8000)
```
Una vez tenemos el servidor levantado, podemos hacer uso de postman y atacar al siguiente endpoint.

```
+ GET localhost:8000/user/test1 -> donde "test1" es el username que queremos comprobar si existe)
+ POST localhost:8000/user -> pasando como parametros un json como este: 
{
    "username":"test1",
    "password":"123456789"
}
En este caso si el username y el password son correctos nos devolvera una id, un nombre y apellido.
```

### Tests

El proyecto dispone de test, los cuales podemos ejecutar con el siguiente commando:
```
php bin/phpunit 
```
Nota: Para hacerlo sencillo se ha puesto un logger que saca por stdout la información que logea. 
Como consequencia, es posible que durante la ejecucion de los test veamos por pantalla la info que se escribiria en un fichero de logs  

### Otras consideraciones

- Se ha creado alguna clase como UserEntity.php o UserValidationException.php de las que no se hace uso. Sin embargo, en aplicaciones mas complejas aparecerían ya sea para hidratar la entidad despues de una consulta a base de datos o ya sea para notificar una excepcion concreta
- Los test relacionados con la parte 2 (bonus) se han marcado como skipped