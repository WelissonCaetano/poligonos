<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Triangulo;
use App\Retangulo;

class ControladorTriangulo extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function validarTriangulo($a,$b,$c)
    {
        $isTriangulo = false;
        if(abs( $b - $c ) < $a && $a < ( $b + $c ))
            $isTriangulo = true;
        if(abs( $a - $c ) < $b && $b < ($a + $c))
            $isTriangulo = true;
        if(abs( $a - $b ) < $c && $c < ($a + $b))
            $isTriangulo = true;
        return $isTriangulo;
    }
    public function somaAreas()
    {
        $triangulos = Triangulo::all();
        $retangulos = Retangulo::all();
        $areaTriangulo = 0;
        $areaRetangulos = 0;
        if(isset($triangulos)){
            foreach ($triangulos as $triangulo) {
                if(($triangulo->ladoA == $triangulo->ladoB && $triangulo->ladoA == $triangulo->ladoC)){
                    $areaTriangulo = (sqrt(3) / 4) * pow($triangulo->ladoA, 2);
                }else 
                    if (($triangulo->ladoA != $triangulo->ladoB && $triangulo->ladoB != $triangulo->ladoC)){
                        $a = $triangulo->ladoA + $triangulo->ladoB + $triangulo->ladoC;
                        $b = -$triangulo->ladoA + $triangulo->ladoB + $triangulo->ladoC;
                        $c = $triangulo->ladoA - $triangulo->ladoB + $triangulo->ladoC;
                        $d = $triangulo->ladoA + $triangulo->ladoB - $triangulo->ladoC;
                        $areaTriangulo = sqrt(($a * $b * $c * $d)) / 4;
                    }else{
                        if($triangulo->ladoA == $triangulo->ladoB){
                            $a = $triangulo->ladoA;
                            $b = $triangulo->ladoC;
                        }else if($triangulo->ladoA == $triangulo->ladoC){
                            $a = $triangulo->ladoC;
                            $b = $triangulo->ladoB;
                        }else if($triangulo->ladoB == $triangulo->ladoC){
                            $a = $triangulo->ladoB;
                            $b = $triangulo->ladoA;
                        }
                        $h=sqrt(pow($a, 2)-pow($b/2, 2));
                        $areaTriangulo = $b * $h / 2;
                    }
            }
        }
        if(isset($retangulos)){
            foreach ($retangulos as $retangulo) {
                $areaRetangulos = $retangulo->ladoH * $retangulo->ladoB;
            }
        }

        return $areaTriangulo + $areaRetangulos;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($this->validarTriangulo($request->input("ladoA"),$request->input("ladoB"),$request->input("ladoC"))){
            $tri = new Triangulo();
            $tri->ladoA = $request->input("ladoA");
            $tri->ladoB = $request->input("ladoB");
            $tri->ladoC = $request->input("ladoC");
            $tri->save();
            return "salvo";     
        }
        return "As Medidas informadas não forma um triângulo"; 
    }
}
