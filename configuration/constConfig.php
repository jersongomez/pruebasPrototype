<?php

define("DS", DIRECTORY_SEPARATOR);
define('DIRECTORIO_HTML', '/var/www/html');
define('DIRECTORIO_SITE', '/pruebasPrototype');
define('RUT_LOG', '/tmp/');
define('RUTA_AUTOCOMPLETADO', '/var/www/html/pruebasPrototype/temporary/file');
define('PRODUCCION', FALSE);
define('HABILITAR_TAGS', FALSE); //false no se muestran, true se muestran
define('NO_ADMITE_NINOS', "8671"); //CODIGO DE HOTELES SEPARADOS POR , EJ: 8671,4512,5454
define('UTFDECODE_SITE', TRUE);
define("SUBMIT_APP", "http://" . $_SERVER['SERVER_NAME'] . DIRECTORIO_SITE . "/public/answerSettlement.php");
define('RUTA_IDIOMA', $_SERVER['DOCUMENT_ROOT'] . DIRECTORIO_SITE . "/language");
define("RUTA_IMAGENES_HABITACIONES", DIRECTORIO_SITE . "/media/images/rooms/");
define("RUTA_IMAGENES_HABITACIONES_REL", DIRECTORIO_HTML . DIRECTORIO_SITE . "/media/images/rooms/");
define('TIPO_ADU', 58);
define('TIPO_NIN', 45);
define('TIPO_INF', 70);
define("TIPO_CON_GEN", 591);
define("TIPO_INCLUYE", 589);
define("TIPO_NO_INCLUYE", 590);

define("VERSION", "1_10"); //Version para forzar los css y js