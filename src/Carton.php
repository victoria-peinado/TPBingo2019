<?php
namespace Bingo;
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
