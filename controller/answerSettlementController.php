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

    private function loadController()
    {
        $textosCargar = parse_ini_file(RUTA_IDIOMA . "/{$this->sigIdioma}" . "_sites.ini");
        include(RUTA_AUTOCOMPLETADO . "/hotels.php");
        #archivos con variables de pruebas 
        include '../configuration/hotelPrueba.php';
        include '../fileTesting/testAnswerSettlement.php';

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

}
