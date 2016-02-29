<?php

/*
 * Class que extiende las funcionalidades para el formulario
 * ya sea codificacion, generacion de html, js etc
 * @autor Jerson Gomez
 */

class extentsFunctionality
{

    /**
     * 
     * @param string $string cadena que se va a decofificar dependiendo la charset del servidor
     * @param boolean $forzar_utf_decode si se necesita forzar la codificacion default false
     * @return string
     */
    public function decodeText($string, $forzar_utf_decode = FALSE)
    {
        if (UTFDECODE_SITE || $forzar_utf_decode) {
            $string = utf8_decode($string);
        }

        return $string;
    }

    /**
     * Funcion con el fin de colocar las primeras en mayusculas 
     * pero omitiendo algunos caracteres '(' cuando la palabra empiece con estos
     * @param string $string 
     * @return string
     */
    public function capitalizedOmitting($string)
    {
        $string = mb_convert_case($string, MB_CASE_TITLE, "UTF-8");

        foreach (array('(', '-') as $delimiter) {
            if (strpos($string, $delimiter) !== false) {
                $string = implode($delimiter, array_map(array($this, 'capitalized'), explode($delimiter, $string)));
            }
        }
        return $string;
    }

    /**
     * Funcion que convierte una cadena en formato titulo
     * Primas letras en mayusculas
     * @param string $string
     * @return string
     */
    public function capitalized($string)
    {
        $string = mb_convert_case($string, MB_CASE_TITLE, "UTF-8");
        return $string;
    }

    /**
     * Funcion que retorna un string en mayusculas 
     * @param string 
     * @return string 
     */
    public function stringUpper($string)
    {
        $string = mb_convert_case($string, MB_CASE_UPPER, "UTF-8");
        return $string;
    }

}
