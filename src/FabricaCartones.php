<?php
namespace Bingo;
class FabricaCartones {
  public function generarCarton() {
    // Algo de pseudo-código para ayudar con la evaluacion.
    $carton = $this->intentoCarton();
    if ($this->cartonEsValido($carton)) {
      return $carton;
    }
		else{
			$this->generarCarton();
		}
  }
  protected function cartonEsValido($carton) {
    if (validarUnoANoventa($carton) &&
      validarCincoNumerosPorFila($carton) &&
      validarColumnaNoVacia($carton) &&
      validarColumnaCompleta($carton) &&
      validarTresCeldasIndividuales($carton) &&
      validarNumerosIncrementales($carton) &&
      validarFilasConVaciosUniformes($carton)
    ) {
      return TRUE;
    }
    return FALSE;
  }
  protected function validarUnoANoventa($carton) {
	foreach($carton->numerosDelCarton() as $numero){
	if($numero >= 1 && $numero <=90){
		$bool=TRUE;
	}
	else{
		$bool=FALSE;
		return $bool;
	}
	}
	return $bool;
  }
  protected function validarCincoNumerosPorFila($carton) {
	 foreach($carton->filas() as $fila)
	 {	 $c = 0;
	 	foreach($fila as $numero)
		{	if($numero != 0){ $c++; }		
		}
	  if($c == 5){
		return TRUE;
	  }
	  else{
		return FALSE;
	  }
	 }
  }
  protected function validarColumnaNoVacia($carton) {
	  foreach($carton->columnas() as $columna)
	  {	$c = 0;
	   	foreach($columna as $numero)
		{	if($numero != 0){ $c++; }
		}
	  }
	  if($c >= 1){
	  	return TRUE;
	  }
	  else{
	  	return FALSE;
	  }
  }
  protected function validarColumnaCompleta($carton) {
	  foreach($carton->columnas() as $columna)
	  {	$c = 0;
	   	foreach($columna as $numero)
		{	if($numero != 0){ $c++; }
		}
	  }
	  if($c < 3){
	  	return TRUE;
	  }
	  else{
	  	return FALSE;
	  }
  }
  protected function validarTresCeldasIndividuales($carton) {
   	$c2 = 0;
	  foreach($carton->columnas() as $columna)
	  {	$c = 0;
	   	foreach($columna as $numero)
		{	if($numero != 0){ $c++; }
		}
	   	 if ($c == 1) { $c2++;}
	  }	
	  if($c < 3){
	  	return TRUE;
	  }
	  else{
	  	return FALSE;
	  }
  }
  protected function validarNumerosIncrementales($carton) {
	  $lastMax = 0;
	 foreach($carton->columnas() as $columna)
	 {	
		$presentMin= min(array_filter($columna));
		if($presentMin > $lastMax){
			$bool=TRUE;
		}
		else{
			return FALSE;
		}
		$lastMax = max($columna);
	 }
	 return $bool;
  }
  protected function validarFilasConVaciosUniformes($carton) {
	 foreach($carton->filas() as $fila)
	 {	 $c = 0;
	 	foreach($fila as $numero)
		{	if($numero == 0){ $c++; }
		 	else {
				$cmax=$c;
				$c = 0;
			}
		}
		  if($cmax < 3){
			return TRUE;
		  }
		  else{
			return FALSE;
		  }
	 }
  }
  public function intentoCarton() {
    $contador = 0;
    $carton = [
      [0,0,0],
      [0,0,0],
      [0,0,0],
      [0,0,0],
      [0,0,0],
      [0,0,0],
      [0,0,0],
      [0,0,0],
      [0,0,0]
    ];
    $numerosCarton = 0;
    while ($numerosCarton < 15) {
      $contador++;
      if ($contador == 50) {
        return $this->intentoCarton();
      }
      $numero = rand (1, 90);
      $columna = floor ($numero / 10);
      if ($columna == 9) { $columna = 8;}
      $huecos = 0;
      for ($i = 0; $i<3; $i++) {
        if ($carton[$columna][$i] == 0) {
          $huecos++;
        }
        if ($carton[$columna][$i] == $numero) {
          $huecos = 0;
          break;
        }
      }
      if ($huecos < 2) {
        continue;
      }
      $fila = 0;
      for ($j=0; $j<3; $j++) {
        $huecos = 0;
        for ($i = 0; $i<9; $i++) {
          if ($carton[$i][$fila] == 0) { $huecos++; }
        }
        if ($huecos < 5 || $carton[$columna][$fila] != 0) {
          $fila++;
        } else{
          break;
        }
      }
      if ($fila == 3) {
        continue;
      }
      $carton[$columna][$fila] = $numero;
      $numerosCarton++;
      $contador = 0;
    }
    for ( $x = 0; $x < 9; $x++) {
      $huecos = 0;
      for ($y =0; $y < 3; $y ++) {
        if ($carton[$x][$y] == 0) { $huecos++;}
      }
      if ($huecos == 3) {
        return $this->intentoCarton();
      }
    }
    return $carton;
  }
}




class Carton implements CartonInterface {
  protected $numeros_carton = [];
  /**
   * {@inheritdoc}
   */
  public function __construct(array $cartonAleatorio) {
    $this->numeros_carton=$cartonAleatorio;
  }
  /**
   * {@inheritdoc}
   */
  public function filas() {
    return $this->numeros_carton ;
  }
  /**
   * {@inheritdoc}
   */
  public function columnas() {
    $columnas = [];
    $columnas[] = [];
    for($i=0;$i<9;$i++)
    {
        foreach ($this->filas() as $fila)
        {
          $columnas[$i][]=$fila[$i];
        }
    }
     return $columnas;
  }
  /**
   * {@inheritdoc}
   */
  public function numerosDelCarton() {
    $numeros = [];
    foreach ($this->filas() as $fila) {
      foreach ($fila as $celda) {
        if ($celda != 0) {
          $numeros[] = $celda;
        }
      }
    }
    return $numeros;
  }
  /**
   * {@inheritdoc}
   */
  public function tieneNumero(int $numero) {
    return in_array($numero, $this->numerosDelCarton());
  }
}
