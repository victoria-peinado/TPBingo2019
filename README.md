# Trabajo Práctico Integrador - 2019

[![Build Status](https://travis-ci.org/dagostinoips/TPBingo2019.svg?branch=master)](https://travis-ci.org/dagostinoips/TPBingo2019)

![Selection_497](https://user-images.githubusercontent.com/14078528/58498174-e1148d80-8153-11e9-9c45-626c9a33858f.png)

## Consignas

### Escribir un informe con la siguiente información.

- ¿Para que sirve el archivo `.gitignore` incluido en el repositorio?.
- ¿Para que sirve el archivo `.travis.yml`. Espeficique que hace cada linea del mismo.
- Para que sirve el archivo `composer.json` Que diferencia tiene con `composer.lock`
- Averigue que alternativas para composer existen en NodeJS y Ruby existen.


### Código

- **Importante** Por ahora trabajar con el ejemplo de numeros provisto en el repositorio. No hay que hacer un generador de bingos automáticos.
- Realizar un fork de este repositorio.
- Conectar la ejecución de tests con travis.
- Completar los tests de la clase `tests/VerificacionesAvanzadasCartonTest.php`
- Verificar que pasen para la clase CartonEjemplo, pero fallen para la clase CartonJs.
- Luego de verificar que los tests fallen (con un commit), arreglar la clase CartonJs para que no falle más.
- Reemplazar la implementación de `lineas()` y `columnas()` para no repetir el código del constructor.

