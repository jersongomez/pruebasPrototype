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

    /**
     * Contruye el html de la habitacion liquidada
     * @param type $dtsLiquidacion
     * @param type $requestMethod
     * @param type $cantidadHabitaciones
     * @param type $vlrLiquidacionMenor
     * @param type $totalPasajeros
     * @param type $numNoches
     * @param type $identificador
     * @param type $textosCargar
     * @param type $idiomaStr
     * @return string
     */
    public function habitacionHtml($dtsLiquidacion, $requestMethod, $cantidadHabitaciones, $vlrLiquidacionMenor, $totalPasajeros, $numNoches, $identificador, $textosCargar, $idiomaStr)
    {
        $htmlHabitacionCotizada = NULL;
        # Generamos una matriz mas limpia con el fin de serializarla y enviarla por post
        $matrizLiquidacionHidden = $dtsLiquidacion;
        unset($matrizLiquidacionHidden["condiciones"]);
        unset($matrizLiquidacionHidden["liqDia"]);
        unset($matrizLiquidacionHidden["imagesCompo"]);
        unset($matrizLiquidacionHidden["detLiqAgencias"]);

        $dtsLiquidacionHidden = htmlspecialchars(urlencode(base64_encode(serialize($matrizLiquidacionHidden))));
        $dtsRequestHiddden = htmlspecialchars(urlencode(base64_encode(serialize($requestMethod))));
        $htmlHabitacionCotizada .= '<div class="col-xs-12 seccionGris habitacionWrapper habitacionMultiple">';
        $imagenHabitacion = $nombreHabitacion = $descripcionHabitacion = NULL;
        $divisionTipoHab = NULL;
        if (is_array($dtsLiquidacion["tipHab"])) {
            foreach ($dtsLiquidacion['tipHab'] as $khab => $desHab) {
                if (is_numeric($khab)) {
                    $codImg = (file_exists(RUTA_IMAGENES_HABITACIONES_REL . $khab . '.jpg')) ? $khab : 0;
                    # elimino la caracteristica del tipo de habitacion estandar - normal = estandar
                    $desTipoHab = explode('-', $desHab['descrip']);
                    $descripcionHab = $this->decodeText($desTipoHab[0]);
                    $nombreHabitacion .= ($divisionTipoHab !== NULL) ? $divisionTipoHab . '<h2 class="nombreHabitacion">' . $descripcionHab . '</h2>' : NULL . '<h2 class="nombreHabitacion">' . $descripcionHab . '</h2>';
                    $divisionTipoHab = " / ";
                    $imagenHabitacion .= '<img src="' . RUTA_IMAGENES_HABITACIONES . $codImg . '.jpg" />';

                    # Cantidad por tipo pax
                    $acoDlldaTiphab = NULL;
                    $adu = $nino = $inf = 0;
                    foreach ($dtsLiquidacion['acomodacion'] as $desaco) {
                        if ($desaco['hab_cod'] == $khab) {
                            $adu = (isset($desaco['pax'][TIPO_ADU]) && $desaco['pax'][TIPO_ADU] > 0) ? ($adu + $desaco['pax'][TIPO_ADU]) : $adu;
                            $nino = (isset($desaco['pax'][TIPO_NIN]) && $desaco['pax'][TIPO_NIN] > 0) ? ($nino + $desaco['pax'][TIPO_NIN]) : $nino;
                            $inf = (isset($desaco['pax'][TIPO_INF]) && $desaco['pax'][TIPO_INF] > 0) ? ($inf + $desaco['pax'][TIPO_INF]) : $inf;
                        }
                    }
                    $acoDlldaTiphab .= (isset($adu) && $adu > 0) ? $adu . ' ' . $this->decodeText($textosCargar["LBL_ADULTOS"]) : NULL;
                    $acoDlldaTiphab .= (isset($nino) && $nino > 0) ? ' ,' . $nino . ' ' . $this->decodeText($textosCargar["LBL_NINOS"]) : NULL;
                    $acoDlldaTiphab .= (isset($inf) && $inf > 0) ? ' ,' . $inf . ' ' . $this->decodeText($textosCargar["LBL_INFANTES"]) : NULL;

                    $descripcionHabitacion .= '<div class="descripcionHabitacion"><span class="nombreHabitacion">' . $desHab['cantHab'] . " " . $descripcionHab . '</span>: ' . $acoDlldaTiphab . '</div>';
                }
            }
        } else {
            $codImg = (file_exists(RUTA_IMAGENES_HABITACIONES_REL . $dtsLiquidacion["tipHab"] . '.jpg')) ? $dtsLiquidacion["tipHab"] : 0;
            $imagenHabitacion .= '<img src="' . RUTA_IMAGENES_HABITACIONES . $codImg . '.jpg" />';
            $desTipoHab = explode('-', $dtsLiquidacion['descripTipHab']);
            $descripcionHab = $this->decodeText($this->stringUpper($desTipoHab[0]));
            $nombreHabitacion = '<h2 class="nombreHabitacion">' . $descripcionHab . '</h2>';

            # Cantidad por tipo pax
            $acoDlldaTiphab = NULL;
            $adu = $nino = $inf = 0;
            foreach ($dtsLiquidacion['acomodacion'] as $desaco) {
                if ($desaco['hab_cod'] == $dtsLiquidacion["tipHab"]) {
                    $adu = (isset($desaco['pax'][TIPO_ADU]) && $desaco['pax'][TIPO_ADU] > 0) ? ($adu + $desaco['pax'][TIPO_ADU]) : $adu;
                    $nino = (isset($desaco['pax'][TIPO_NIN]) && $desaco['pax'][TIPO_NIN] > 0) ? ($nino + $desaco['pax'][TIPO_NIN]) : $nino;
                    $inf = (isset($desaco['pax'][TIPO_INF]) && $desaco['pax'][TIPO_INF] > 0) ? ($inf + $desaco['pax'][TIPO_INF]) : $inf;
                }
            }
            $acoDlldaTiphab .= (isset($adu) && $adu > 0) ? $adu . ' ' . $this->decodeText($textosCargar["LBL_ADULTOS"]) : NULL;
            $acoDlldaTiphab .= (isset($nino) && $nino > 0) ? ' ,' . $nino . ' ' . $this->decodeText($textosCargar["LBL_NINOS"]) : NULL;
            $acoDlldaTiphab .= (isset($inf) && $inf > 0) ? ' ,' . $inf . ' ' . $this->decodeText($textosCargar["LBL_INFANTES"]) : NULL;

            $descripcionHabitacion .= '<div class="descripcionHabitacion"><span class="nombreHabitacion">' . $cantidadHabitaciones . " " . $descripcionHab . '</span>: ' . $acoDlldaTiphab . '</div>';
        }


        $htmlHabitacionCotizada .= '<div class="col-xs-12 col-sm-8">' . $imagenHabitacion . '<div class="infoHabitacion">' . $nombreHabitacion;

        $fechaLlegadaHotelInfo = mb_convert_case($this->dateTransform($dtsLiquidacion["fechaLleg"], $idiomaStr, "%a, %d %b %Y"), MB_CASE_TITLE, "UTF-8");
        $descripcionReservaHab = str_replace("_numNoches", $numNoches, $this->decodeText($textosCargar["LBL_NOCHES_CANT_PAX_ALOJAMIENTO"]));
        $descripcionReservaHab = str_replace("_numPax", $totalPasajeros, $descripcionReservaHab);

        $htmlHabitacionCotizada .= '<h3 class="nombrePlan">' . $this->decodeText($textosCargar["LBL_TIPO_PLAN_{$dtsLiquidacion["tipoPlan"]}"]) . ' / <span class="descripcionHabitacion">' . $descripcionReservaHab . '</span></h3>';
        $htmlHabitacionCotizada .= $descripcionHabitacion;
        $htmlHabitacionCotizada .= '<div class="descripcionHabitacion">Tiquetes Aéreos + Traslados <a class="tooltipTraslados" href="#" data-toggle="tooltip" data-placement="bottom" data-container="body" title="Se consideran ?Infantes? a los menores de 2 años y ?Niños?, a los menores en edades comprendidas entre los 2 años cumplidos y los 11 años en la fecha de ingreso al hotel, estas tarifas aplican para infantes y niños compartiendo habitación con mínimo dos adultos pagando tarifa de doble, o, un adulto pagando tarifa de sencilla.; A partir de los 12 años se considera adulto y se cobrara como tal. Es indispensable indicar las edades de los niños integrantes de un grupo familiar al solicitar la reserva y la confirmación de los servicios."><i style="color:#ed8323;" class="fa fa-question-circle"></i></a></div>';
        $htmlHabitacionCotizada .= '<div class="descripcionHabitacion"><span class="nombreHabitacion">' . $this->decodeText($textosCargar["LBL_FECHA_SALIDA_TRANSPORTE"]) . '</span>: ' . $requestMethod["fechaEntrada"] . '</div>';
        $htmlHabitacionCotizada .= '<div class="descripcionHabitacion"><span class="nombreHabitacion">' . $this->decodeText($textosCargar["LBL_FECHA_LLEGADA_HOTEL"]) . '</span>: ' . $fechaLlegadaHotelInfo . '</div>';
        $htmlHabitacionCotizada .= '<div class="descripcionHabitacion"><span class="nombreHabitacion">' . $this->decodeText($textosCargar["LBL_FECHA_SALIDA_HOTEL"]) . '</span>: ' . $requestMethod["fechaSalida"] . '</div>';
        $htmlHabitacionCotizada .= '<a class="linkMasInfo" id="botMostrarInfo' . $identificador . '" ><i class="fa fa-info-circle"></i>' . $this->decodeText($textosCargar["LBL_MAS_INFORMACION"]) . '</a>';
        $htmlHabitacionCotizada .= '</div></div><div class="col-xs-12 col-sm-4">';

        $classPromocion = "hide";
        if (isset($dtsLiquidacion["chkPromocion"]) && $dtsLiquidacion["chkPromocion"] === TRUE) {
            $classPromocion = NULL;
        }

        $htmlHabitacionCotizada .= '<div class="nombrePromocion ' . $classPromocion . '"><i class="fa fa-tags"></i>' . $this->decodeText($dtsLiquidacion["observacionPlan"]) . '</div><br/>';
        $htmlHabitacionCotizada .= '<form id="form_reserva" name="form_reserva" method="' . $dtsLiquidacion['actionform'] . '" action="' . $dtsLiquidacion['mform'] . '" ' . $dtsLiquidacion['aform'] . ' >';
        $htmlHabitacionCotizada .= '<div><label for="codProm" class="hidden">' . $this->decodeText($textosCargar["LBL_RESERVAR"]) . '</label>';
        $htmlHabitacionCotizada .= '<input type="hidden" name="liquidacion" value="' . $dtsLiquidacionHidden . '" />';
        $htmlHabitacionCotizada .= '<input type="hidden" name="request" value="' . $dtsRequestHiddden . '" />';
        $htmlHabitacionCotizada .= '<button type="submit" class="btn btn-default botonReservar" id="actualizarHotel">' . $this->decodeText($textosCargar["LBL_RESERVAR"]) . '<i class="fa fa-check"></i></button>';
        $htmlHabitacionCotizada .= '</div>';
        $htmlHabitacionCotizada .= '</form>';
        $htmlHabitacionCotizada .= '<div class="precioDestacado">+ ' . number_format(($dtsLiquidacion["vlrLiq"] - $vlrLiquidacionMenor), 0, ",", ".") . '</div>';
//    $htmlHabitacionCotizada .= '<div class="alertaCambioMoneda" style="display: block;"><strong>+ USD 0</strong><br> Este valor es informativo, el cobro se realizará en COP</div></div>';
        $htmlHabitacionCotizada .= '</div><div id="infoHab' . $identificador . '" class="col-xs-12" style="display:none;">';
        $htmlHabitacionCotizada .= '<div class="navDescripcionHabitacion">';
        # tab de navegacion para las condiciones del plan
        $htmlHabitacionCotizada .= '<ul><li id="hab1Hotel" data-link="hab1"><a><span class="tituloTabBooking"><i class="fa fa-check"></i>' . $this->decodeText($textosCargar["LBL_QUE_INCLUYE_PLAN"]) . '</span></a></li>';
        $htmlHabitacionCotizada .= '<li id="hab2Hotel" data-link="hab2"><a><span class="tituloTabBooking"><i class="fa fa-times"></i>' . $this->decodeText($textosCargar["LBL_NO_INCLUYE_PLAN"]) . '</span></a></li>';
        $htmlHabitacionCotizada .= '<li id="hab3Hotel" data-link="hab3"><a><span class="tituloTabBooking"><i class="fa fa-book"></i>' . $this->decodeText($textosCargar["LBL_CONDICIONES_GENERALES"]) . '</span></a></li></ul>';
        # Condiciones del plan
        $condicionesDelPlan = unserialize(base64_decode(urldecode($dtsLiquidacion['condiciones'])));
        $incluyePlan = NULL;
        foreach ($condicionesDelPlan[TIPO_INCLUYE] as $textCondiciones) {
            $incluyePlan .= $textCondiciones["condiciones"];
        }
        $noIncluyePlan = NULL;
        foreach ($condicionesDelPlan[TIPO_NO_INCLUYE] as $textCondiciones) {
            $noIncluyePlan .= $textCondiciones["condiciones"];
        }
        $condicionesGrl = NULL;
        foreach ($condicionesDelPlan[TIPO_CON_GEN] as $textCondiciones) {
            $condicionesGrl .= $textCondiciones["condiciones"];
        }

        $htmlHabitacionCotizada .= '<div><div><div class="dos-columnas">' . $incluyePlan . '</div></div>';
        $htmlHabitacionCotizada .= '<div><div class="dos-columnas">' . $noIncluyePlan . '</div></div>';
        $htmlHabitacionCotizada .= '<div><div class="dos-columnas">' . $condicionesGrl . '</div></div></div>';
        # Cierra navegacion de condiciones
        $htmlHabitacionCotizada .= '</div>';
        $htmlHabitacionCotizada .= '</div>';
        $htmlHabitacionCotizada .= '</div>';

        return $htmlHabitacionCotizada;
    }

    /**
     * Convierte una fecha dada en el formato especificado, por defecto se establece en:
     * * "Nombre del dia", "dia" de "mes" de "aÃ±o" => jueves, 17 de diciembre de 2015
     *  
     * Los nombres del mes y del dÃ­a de la semana y otras cadenas
     * dependientes del lenguaje respetan el localismo establecido con setlocale(). 
     * 
     * @param string $fecha con la fecha a transformar "dd/mm/yyyy" o "yyyy-mm-dd"
     * @param string $idioma con el idioma para establecer la localizaciÃ³n
     * @param string $formato con los especificadores de conversiÃ³n
     * 
     * @return string $dateformat cadena formateada segÃºn $formato y marca de tiempo obtenida de $fecha.
     * 
     * @see http://php.net/manual/es/function.strftime.php
     */
    public static function dateTransform($fecha, $idioma = "", $formato = "%A, %d de %B de %Y")
    {
        $dateformat = "";
        $codigos = array("" => "es_CO", "eng" => "en_US", "fre" => "fr_FR", "por" => "pt_BR",
            "es-ES" => "es_CO", "en-GB" => "en_US", "fr-FR" => "fr_FR", "pt-PT" => "pt_BR");
        setlocale(LC_TIME, $codigos[$idioma] . ".UTF-8");

        $configuraciones = array(
            array("separador" => "/", "formato" => "dd/mm/yyyy", "posiciones" => array("day" => 0, "month" => 1, "year" => 2)),
            array("separador" => "-", "formato" => "yyyy-mm-dd", "posiciones" => array("day" => 2, "month" => 1, "year" => 0)));

        foreach ($configuraciones as $configuracion) {
            if (strpos($fecha, $configuracion['separador']) !== false) {
                $fecha_partes = explode($configuracion['separador'], $fecha);
                $day = $configuracion['posiciones']['day'];
                $month = $configuracion['posiciones']['month'];
                $year = $configuracion['posiciones']['year'];
                $dateformat = strftime($formato, mktime(0, 0, 0, $fecha_partes[$month], $fecha_partes[$day], $fecha_partes[$year]));
            }
        }
        return $dateformat;
    }

    /**
     * Reordena un array multidimensional deacuerdo a los campos especificados y el order de estos
     *  
     * @param array $array array de datos
     * @param array $campos array que contiene el campo y el order a dar Ejem: array('vlrLiq' => SORT_ASC, 'descripTipHab' => SORT_ASC)
     * @return array array multidimencional resultante despues del ordenamiento
     */
    public function orderMatrizMultidimensional($array, $campos)
    {
        $camposAux = array();
        foreach ($campos as $nameCampo => $order) {
            $camposAux[$nameCampo] = array();
            foreach ($array as $k => $row) {
                $value = (is_array($row[$nameCampo])) ? $this->firstRoom($row[$nameCampo]) : $row[$nameCampo];
                $camposAux[$nameCampo]['_' . $k] = strtolower($value);
            }
        }
        $eval = 'array_multisort(';
        foreach ($campos as $nameCampo => $order) {
            $eval .= '$camposAux[\'' . $nameCampo . '\'],' . $order . ',';
        }
        $eval = substr($eval, 0, -1) . ');';
        eval($eval);
        $ret = array();
        foreach ($camposAux as $nameCampo => $arr) {
            foreach ($arr as $k => $v) {
                $k = substr($k, 1);
                if (!isset($ret[$k])) {
                    $ret[$k] = $array[$k];
                }
                $ret[$k][$nameCampo] = $array[$k][$nameCampo];
            }
        }
        return $ret;
    }

    /**
     * Devuelve la primera habitacion de array
     * 
     * @param type $tiposHabitacion array de tipos de habitacion
     * @return string descripcion/nombre de la habitacion
     */
    public function firstRoom($tiposHabitacion)
    {
        foreach ($tiposHabitacion as $codHabitacion) {
            return $codHabitacion["descrip"];
        }
    }

}
