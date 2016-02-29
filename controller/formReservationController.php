<?php

class formReservationController
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
        require_once '../configuration/hotelPrueba.php';
        include_once '../view/formReservationView.php';
    }

}
