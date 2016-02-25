<?php

define("DS", DIRECTORY_SEPARATOR);
define('DIRECTORIO_HTML', '/var/www/html');
define('DIRECTORIO_SITE', '/pruebasPrototype');
define('RUT_LOG', '/tmp/');
define('RUTA_AUTOCOMPLETADO', '/var/www/html/pruebasPrototype/temporary/file');
define("VERSION", "1_5"); //Version para forzar los css y js
define('PRODUCCION', FALSE);
define('HABILITAR_TAGS', FALSE); //false no se muestran, true se muestran
define('NO_ADMITE_NINOS', "8671"); //CODIGO DE HOTELES SEPARADOS POR , EJ: 8671,4512,5454
define('UTFDECODE_SITE', TRUE);
define("SUBMIT_APP", "http://192.168.1.105/ProcesoCotizacionSite/web_pagGDS/liquidacion.php");
define('RUTA_IDIOMA', $_SERVER['DOCUMENT_ROOT'] . DIRECTORIO_SITE . "/language");
