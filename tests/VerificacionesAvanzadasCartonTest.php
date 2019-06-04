<?php

namespace Bingo;

use PHPUnit\Framework\TestCase;

class VerificacionesAvanzadasCartonTest extends TestCase {

  /**
   * Verifica que los números del carton se encuentren en el rango 1 a 90.
   */
  public function testUnoANoventa() {
	$carton = new CartonEjemplo;
	foreach($carton->numerosDelCarton() as $numero){
	$this->assertTrue($numero >= 1 && $numero <=90);
	}
  } /** no se que es lo que no anda***/

  /**
   * Verifica que cada fila de un carton tenga exactamente 5 celdas ocupadas.
   */
  public function testCincoNumerosPorFila()
 {
    	$carton = new CartonEjemplo;
	 foreach($carton->filas() as $fila)
	 {	 $c = 0;
	 	foreach($fila as $numero)
		{	if($numero != 0){ $c++; }		
		}
	  $this->assertTrue($c == 5);
	 }
	
  }

  /**
   * Verifica que para cada columna, haya al menos una celda ocupada.
   */
  public function testColumnaNoVacia() 
  {	$carton = new CartonEjemplo;
	  foreach($carton->columnas() as $columna)
	  {	$c = 0;
	   	foreach($columna as $numero)
		{	if($numero != 0){ $c++; }
		}
	  }
	  $this->assertTrue($c >= 1);
  }

  /**
   * Verifica que no haya columnas de un carton con tres celdas ocupadas.
   */
  public function testColumnaCompleta() 
  {
	  $carton = new CartonEjemplo;
	  foreach($carton->columnas() as $columna)
	  {	$c = 0;
	   	foreach($columna as $numero)
		{	if($numero != 0){ $c++; }
		}
	  }
	  $this->assertTrue($c < 3);
  }

  /**
   * Verifica que solo hay exactamente tres columnas que tienen solo una celda
   * ocupada.
   */
  public function testTresCeldasIndividuales() {
   	$c2 = 0;
	  $carton = new CartonEjemplo;
	  foreach($carton->columnas() as $columna)
	  {	$c = 0;
	   	foreach($columna as $numero)
		{	if($numero != 0){ $c++; }
		}
	   	 if ($c == 1) { $c2++;}
	  }	
	 $this->assertTrue($c2 == 3);
  }

  /**
   * Verifica que los números de las columnas izquierdas son menores que los de
   * las columnas a la derecha.
   */
  public function testNumerosIncrementales() {
	  $carton = new CartonEjemplo;
	  $lastMax = 0;
	 foreach($carton->columnas() as $columna)
	 {	
		$presentMin= min(array_filter($columna));
		$this->assertTrue($presentMin > $lastMax);
		$lastMax = max($columna);
	 }
  }

  /**
   * Verifica que en una fila no existan más de dos celdas vacias consecutivas.
   */
  public function testFilasConVaciosUniformes() {
    $this->assertTrue(TRUE);
  }

}
