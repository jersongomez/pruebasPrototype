<?php

class answerSettlementController
{

    private $requestMethod;
    private $classExtenstFunction;
    private $sigIdioma;

    function __construct()
    {
        $this->requestMethod = ($_SERVER['REQUEST_METHOD'] === 'POST') ? $_POST : $_GET;

        if (empty($this->requestMethod)) {
            include 'view/errorParameters.php';
        } else {
            # action a ejecutar
            $this->action = (isset($this->requestMethod['action'])) ? $this->requestMethod['action'] . "Controller" : "loadController";
            $this->classExtenstFunction = new extentsFunctionality();
            $this->sigIdioma = $this->requestMethod["idioma"];
//            # Creacion del cliente el servidor expuesto con SoapServer
//            $this->clientWS = new SoapClient(null, array('location' => RUTA_HW . 'servicios/webService.php',
//                'uri' => 'urn:webservices', 'encoding' => 'UTF-8'));

            call_user_func(array($this, $this->action));
        }
    }

    private function preCargaBooking()
    {
        $_componente = (isset($this->requestMethod["processLiq"])) ? "Hotel" : $this->requestMethod["componente"];
        $_numHabitacion = (isset($this->requestMethod["numHab{$_componente}"])) ? "numHab{$_componente}" : 1;
        $this->requestMethod["combinarHotel"] = (isset($this->requestMethod["combinarHotel"])) ? "1" : NULL;

        /**
         * Se cargar una matriz con el fin de precargar los datos enviados del booking
         * estructura array("nombre_del_que_proviene" => array("nombre_campo_cargar", "tipo_input"))
         * r = radio button, s = select, i = input text, c = checkbox      
         */
        $crearHiddens = array("numHab{$_componente}" => array("numHabHotel", "r"),
            "ciudad{$_componente}Origen" => array("ciudadHotelOrigen", "i"),
            "origenComp{$_componente}" => array("origenCompHotel", "i"),
            "combinar{$_componente}" => array("combinarHotel", "c"),
            "ctrAereo" => array("ctrAereo", "i"),
            "componente" => array("preComponente", "i"),
            "ctrTerr" => array("ctrTerr", "i"),
            "hotelAdicional" => array("hotelAdicional", "s"),
            "fechaEntrada" => array("fechaEntrada", "i"),
            "fechaSalida" => array("fechaSalida", "i"),
            "fechaEntradaAdicional" => array("fechaEntradaAdicional", "i"),
            "fechaSalidaAdicional" => array("fechaSalidaAdicional", "i"),
        );

        for ($_hab = 1; $_hab <= 3; $_hab++) {
            $crearHiddens["hab{$_hab}ninos"] = array("hab{$_hab}ninos", "i");
            $crearHiddens["hab{$_hab}infantes"] = array("hab{$_hab}infantes", "i");
            $crearHiddens["totalHab{$_hab}ninyos"] = array("totalHab{$_hab}ninyos", "s");
            $totalCantEdadesHab = (isset($this->requestMethod["totalHab{$_hab}ninyos"])) ? $this->requestMethod["totalHab{$_hab}ninyos"] : NULL;
            for ($canNinyosHab = 1; $canNinyosHab <= $totalCantEdadesHab; $canNinyosHab++) {
                $crearHiddens["hab{$_hab}EdadNino{$canNinyosHab}"] = array("hab{$_hab}EdadNino{$canNinyosHab}", "s");
            }
            $crearHiddens["select{$_componente}Hab{$_hab}Adultos"] = array("selectHotelHab{$_hab}Adultos", "s");
        }

        $hiddens = NULL;
        foreach ($crearHiddens as $key => $_nameHidden) {
            $value = (isset($this->requestMethod["{$key}"])) ? $this->requestMethod["{$key}"] : NULL;
            $hiddens .= '<input id="_load' . $key . '" data-typelem="' . $_nameHidden[1] . '" data-booking="' . $_nameHidden[0] . '" type="hidden" value="' . $value . '" class="preloadts" />';
        }

        return $hiddens;
    }

    private function loadController()
    {
        $textosCargar = parse_ini_file(RUTA_IDIOMA . "/{$this->sigIdioma}" . "_sites.ini");
        include(RUTA_AUTOCOMPLETADO . "/hotels.php");
        #archivos con variables de pruebas 
        include '../configuration/hotelPrueba.php';
        include '../fileTesting/testAnswerSettlement.php';
        $hiddens = $this->preCargaBooking();

        $numAdultos = $numNinyos = $numInfantes = 0;
        $cantidadHabitaciones = isset($this->requestMethod["numHab{$this->requestMethod["componente"]}"]) ? $this->requestMethod["numHab{$this->requestMethod["componente"]}"] : 1;

        for ($index = 1; $index <= $cantidadHabitaciones; $index++) {
            $numAdultos += (isset($this->requestMethod["select{$this->requestMethod["componente"]}Hab{$index}Adultos"])) ? $this->requestMethod["select{$this->requestMethod["componente"]}Hab{$index}Adultos"] : 0;
            $numNinyos += $this->requestMethod["hab{$index}ninos"];
            $numInfantes += $this->requestMethod["hab{$index}infantes"];
        }

        $totalPasajeros = $numAdultos + $numInfantes + $numNinyos;
        $numNoches = isset($this->requestMethod["numNoches"]) ? $this->requestMethod["numNoches"] : NULL;
        $numNochesAdicional = isset($this->requestMethod["numNochesAdicional"]) ? $this->requestMethod["numNochesAdicional"] : NULL;

        $htmlHabitacionCotizada = NULL;
        if (count($liqReservation) > 0) {
            $identificador = 1;
            foreach ($liqReservation as $index => $dtsLiquidacion) {
                $vlrLiquidacionMenor = $liqReservation[0]["vlrLiq"];
                $htmlHabitacionCotizada .= $this->classExtenstFunction->habitacionHtml($dtsLiquidacion, $this->requestMethod, $cantidadHabitaciones, $vlrLiquidacionMenor, $totalPasajeros, $numNoches, $identificador, $textosCargar, $this->sigIdioma);
                $identificador++;
                if (isset($dtsLiquidacion["ofertaSiguiente"]) && !empty($dtsLiquidacion["ofertaSiguiente"])) {
                    $htmlHabitacionCotizada .= $this->classExtenstFunction->habitacionHtml($dtsLiquidacion["ofertaSiguiente"], $this->requestMethod, $cantidadHabitaciones, $vlrLiquidacionMenor, $totalPasajeros, $numNoches, $identificador, $textosCargar, $this->sigIdioma);
                    $identificador++;
                }
            }
        } else {
            
        }



        include_once '../view/answerSettlement/answerFirstHotelView.php';
    }

    private function validaCombinacionesController()
    {

        $html = $hoteles = NULL;
        $strSelct = NULL;

        echo json_encode(array("verifica" => $html, "hotelesTwo" => $strSelct));
    }

    private function filtrosCotizacionesController()
    {
        $textosCargar = parse_ini_file(RUTA_IDIOMA . "/{$this->sigIdioma}" . "_sites.ini");

        $htmlHabitacionCotizada = NULL;
        $liquidaciones = unserialize(base64_decode(urldecode($this->requestMethod['liquidacion'])));

        $numAdultos = $numNinyos = $numInfantes = 0;
        $cantidadHabitaciones = isset($this->requestMethod["numHab{$this->requestMethod["componente"]}"]) ? $this->requestMethod["numHab{$this->requestMethod["componente"]}"] : 1;

        for ($index = 1; $index <= $cantidadHabitaciones; $index++) {
            $numAdultos += (isset($this->requestMethod["select{$this->requestMethod["componente"]}Hab{$index}Adultos"])) ? $this->requestMethod["select{$this->requestMethod["componente"]}Hab{$index}Adultos"] : 0;
            $numNinyos += $this->requestMethod["hab{$index}ninos"];
            $numInfantes += $this->requestMethod["hab{$index}infantes"];
        }

        $totalPasajeros = $numAdultos + $numInfantes + $numNinyos;
        $numNoches = isset($this->requestMethod["numNoches"]) ? $this->requestMethod["numNoches"] : NULL;
        $numNochesAdicional = isset($this->requestMethod["numNochesAdicional"]) ? $this->requestMethod["numNochesAdicional"] : NULL;

        /*
         * filtros de Ordenamiento 1 => Precio, 2 => Habitacion, 3 => Promocion
         */
        if ($this->requestMethod["filtro"] == 1) {
            $liquidacionesLimpias = $this->classExtenstFunction->orderMatrizMultidimensional($liquidaciones, array('vlrLiq' => SORT_ASC, 'descripTipHab' => SORT_ASC));
        } elseif ($this->requestMethod["filtro"] == 2) {
            $liquidacionesLimpias = $this->classExtenstFunction->orderMatrizMultidimensional($liquidaciones, array('descripTipHab' => SORT_ASC, 'vlrLiq' => SORT_ASC));
        } elseif ($this->requestMethod["filtro"] == 3) {
            $liquidacionesLimpias = $this->classExtenstFunction->orderMatrizMultidimensional($liquidaciones, array('promocionLiq' => "SORT_REGULAR, SORT_DESC", 'vlrLiq' => SORT_ASC, 'descripTipHab' => SORT_ASC));
        }

        $identificador = 1;
        foreach ($liquidacionesLimpias as $index => $dtsLiquidacion) {
            $vlrLiquidacionMenor = $liquidacionesLimpias[0]["vlrLiq"];
            $htmlHabitacionCotizada .= $this->classExtenstFunction->habitacionHtml($dtsLiquidacion, $this->requestMethod, $cantidadHabitaciones, $vlrLiquidacionMenor, $totalPasajeros, $numNoches, $identificador, $textosCargar, $this->sigIdioma);
            $identificador++;
            if (isset($dtsLiquidacion["ofertaSiguiente"]) && !empty($dtsLiquidacion["ofertaSiguiente"])) {
                $htmlHabitacionCotizada .= $this->classExtenstFunction->habitacionHtml($dtsLiquidacion["ofertaSiguiente"], $this->requestMethod, $cantidadHabitaciones, $vlrLiquidacionMenor, $totalPasajeros, $numNoches, $identificador, $textosCargar, $this->sigIdioma);
                $identificador++;
            }
        }
        echo $htmlHabitacionCotizada;
    }

}
