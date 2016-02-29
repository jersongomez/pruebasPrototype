<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Reserva</title>
        <script src="../media/js/jquery.min.js?v=<?php echo VERSION; ?>"></script>
        <script src="../media/js/jquery-ui.js?v=<?php echo VERSION; ?>"></script>

        <link href="../media/css/jquery-ui.css?v=<?php echo VERSION; ?>" rel="stylesheet" />

        <!-- Zozo Tabs css -->
        <link href="../media/css/zozo.tabs.min.css?v=<?php echo VERSION; ?>" rel="stylesheet" />

        <!-- Zozo Tabs Flat Themes css -->
        <link href="../media/css/zozo.tabs.flat.min.css?v=<?php echo VERSION; ?>" rel="stylesheet" />

        <!-- Zozo Tabs js -->
        <script src="../media/js/zozo.tabs.min.js?v=<?php echo VERSION; ?>"></script>

        <link rel="stylesheet" href="../media/css/font-awesome.min.css?v=<?php echo VERSION; ?>">

        <link rel="stylesheet" href="../media/css/apps/formReservation.css?v=<?php echo VERSION; ?>">
        <script src="../media/js/apps/initApp.js?v=<?php echo VERSION; ?>"></script>
        <script src="../media/js/apps/corePrototypeApp.js?v=<?php echo VERSION; ?>"></script>

        <script src="../media/js/bootstrap.min.js?v=<?php echo VERSION; ?>"></script>
        <link rel="stylesheet" href="../media/css/bootstrap.min.css?v=<?php echo VERSION; ?>">

        <script src="../media/js/bootstrap-select.js?v=<?php echo VERSION; ?>"></script>
        <link rel="stylesheet" href="../media/css/bootstrap-select.css?v=<?php echo VERSION; ?>">

        <script src="../media/js/jquery.autocomplete.js?v=<?php echo VERSION; ?>"></script>
        <link rel="stylesheet" href="../media/css/jquery.autocomplete.css?v=<?php echo VERSION; ?>">

        <script src="../media/js/jquery.validate.js?v=<?php echo VERSION; ?>"></script>
        <script src="../media/js/php.js?v=<?php echo VERSION; ?>"></script>
        <script src="../language/es-ES_sites.ini?v=<?php echo VERSION; ?>"></script>
        <script>
            const hotelsNoAdmin = '<?php echo NO_ADMITE_NINOS; ?>';
            var __app = new App();
<?php
include(RUTA_AUTOCOMPLETADO . "/autocomplet.js");
include(RUTA_AUTOCOMPLETADO . "/acomodationsHotel.js");
?>
        </script>
    </head>



    <body id="contentBody" >
        <div id="contentBooking" class=".container-fluid" style="max-width:720px; margin: 0 auto; margin-top:100px;">

            <!-- Start Tabs-->
            <div id="navBooking" >

                <!-- Tab Navigation Menu -->
                <ul>
                    <li id="tabHotel" data-link="hotel"><a><i class="fa fa-building-o"></i> <span class="tituloTabBooking"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->stringUpper($textosCargar["LBL_HOTEL"])); ?></span></a></li>
                    <li id="tabAereo" data-link="aereo"><a><i class="fa fa-building-o"></i> + <i class="fa fa-plane"></i> <span class="tituloTabBooking"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->stringUpper($textosCargar["LBL_HOTEL_AEREO"])); ?></span></a></li>
                    <li id="tabTerrestre" data-link="terrestre"><a><i class="fa fa-building-o"></i> + <i class="fa fa-bus"></i> <span class="tituloTabBooking"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->stringUpper($textosCargar["LBL_HOTEL_TERRESTRE"])); ?></span></a></li>
                </ul>

                <!-- Content container -->
                <div>

                    <!-- HOTEL -->
                    <div>

                        <form role="form" id="frm_hotel" name="frm_hotel" method="POST" action="<?php echo SUBMIT_APP; ?>" >
                            <div data-error="hotel" class="error_hotel errorAlert" style="display: none;"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_CAMPO_OBLIGATORIO"])); ?></div>
                            <input class="plHotel" id="plane" name="plane" type="hidden" value="H" />
                            <input id="componente" name="componente" type="hidden" value="Hotel" />
                            <input id="sigPais" name="sigPais" type="hidden" value="" />
                            <input id="idioma" name="idioma" type="hidden" value="" />
                            <input id="codPais" name="codPais" type="hidden" value="" />	
                            <input id="hab1ninosHotel" name="hab1ninos" type="hidden" value="0" />	
                            <input id="hab2ninosHotel" name="hab2ninos" type="hidden" value="0" />	
                            <input id="hab3ninosHotel" name="hab3ninos" type="hidden" value="0" />	
                            <input id="hab1infantesHotel" name="hab1infantes" type="hidden" value="0" />	
                            <input id="hab2infantesHotel" name="hab2infantes" type="hidden" value="0" />	
                            <input id="hab3infantesHotel" name="hab3infantes" type="hidden" value="0" />	
                            <input id="fechaEntradaf" name="fechaEntradaf" class="fechaEntradaf" type="hidden" value="" />	
                            <input id="fechaSalidaf" name="fechaSalidaf" class="fechaSalidaf" type="hidden" value="" />	
                            <input id="fechaEntradaAdicionalf" name="fechaEntradaAdicionalf" class="fechaEntradaAdicionalf" type="hidden" value="" />	
                            <input id="fechaSalidaAdicionalf" name="fechaSalidaAdicionalf" class="fechaSalidaAdicionalf" type="hidden" value="" />	

                            <div class="form-group gruposBooking col-sm-6">
                                <label for="origenCompHotel"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_CIUDAD_ORIGEN"])); ?></label>
                                <div class="inputWrapper">
                                    <span class="iconInput"><i class="fa fa-map-marker"></i></span>
                                    <input id="ciudadHotelOrigen" name="ciudadHotelOrigen" type="hidden" data-ciudad="required" />	
                                    <input data-ignore="required" class="form-control autocompletado" id="origenCompHotel" name="origenCompHotel" type="text" placeholder="¿Cuál es tu ciudad de origen?">
                                </div>
                            </div>

                            <div class="form-group gruposBooking contDerecho col-sm-6">
                                <label for="hotelCompHotel1"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_HOTEL"])); ?></label>
                                <div class="inputWrapper" id="hotelWrapperHotel1">
                                    <span class="iconInput"><i class="fa fa-building-o"></i></span>
                                    <select name="hotel" class="form-control selectpicker" id="hotelCompHotel1" data-live-search="true" data-container="body" title="Selecciona tu hotel favorito">
                                        <?php echo $this->classExtenstFunction->decodeText($HOTEL); ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group gruposBooking contCalendario col-sm-6">
                                <div class="form-group gruposBooking col-sm-6">
                                    <label for="entradaCompHotel1"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_FECHA_ENTRADA"])); ?></label>
                                    <div class="inputWrapper">
                                        <span class="iconInput"><i class="fa fa-calendar"></i></span>
                                        <input onkeydown="return false;" name="fechaEntrada" type="text" class="form-control datePickerEs" id="entradaCompHotel1">
                                    </div>
                                </div>
                                <div class="form-group gruposBooking col-sm-6">
                                    <label for="salidaCompHotel1"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_FECHA_SALIDA"])); ?></label>
                                    <div class="inputWrapper">
                                        <span class="iconInput"><i class="fa fa-calendar"></i></span>
                                        <input onkeydown="return false;" name="fechaSalida" type="text" class="form-control datePickerEs" id="salidaCompHotel1">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group gruposBooking contDerecho col-sm-6">
                                <div class="form-group gruposBooking gruposPadding col-xs-3">
                                    <label for="nochesCompHotel1"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_NOCHES"])); ?></label>
                                    <div class="inputWrapper">
                                        <span class="iconInput"><i class="fa fa-moon-o"></i></span>
                                        <input type="text" readonly class="form-control" id="nochesCompHotel1" name="numNoches">
                                    </div>
                                </div>
                                <div class="form-group gruposBooking gruposPadding col-xs-4 col-sm-4">
                                    <label for="salida"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_HABITACIONES"])); ?></label>
                                    <div class="btn-group btn-group-select-num" id="botonHabHotel" data-toggle="buttons">
                                        <label class="btn btnHabitaciones active"><input type="radio" name="numHabHotel" class="numHabHotel" id="numHabHotel" value="1">1</label>
                                        <label class="btn btnHabitaciones "><input type="radio" name="numHabHotel" class="numHabHotel" id="numHabHotel" value="2">2</label>
                                        <label class="btn btnHabitaciones "><input type="radio" name="numHabHotel" class="numHabHotel" id="numHabHotel" value="3">3</label>
                                    </div>
                                </div>

                                <div id="divPlanCombinadoHotel" class="form-group gruposBooking gruposPadding contDerecho elegirCombinar col-xs-5">
                                    <label for="salida"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_COMBINAR"])); ?> <a id="tooltipCombinadoHotel" href="#" data-toggle="tooltip" data-placement="bottom" data-container="body" title="Al seleccionar esta opción puedes combinar tu viaje con otro hotel cercano."><i style="color:#ed8323;" class="fa fa-question-circle"></i></a></label>
                                    <div class="checkbox">
                                        <label><input type="checkbox" value="1" id="combinarHotel" name="combinarHotel"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_OTRO_HOTEL"])); ?></label>
                                    </div>
                                </div>
                            </div>

                            <!--DIV HOTEL ADICIONAL-->
                            <div class="form-group gruposBooking planCombinado planCombinadoHotel segHotel col-sm-4 col-xs-12">
                                <label for="hotelCompHotel2"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_HOTEL"])); ?></label>
                                <div class="inputWrapper">
                                    <span class="iconInput"><i class="fa fa-building-o"></i></span>
                                    <select name="hotelAdicional" class="form-control selectpicker hotel-adicional" id="hotelCompHotel2" data-live-search="true" data-container="body" title="Selecciona tu hotel favorito">                                        
                                        <!--ACA VA DINAMICAMENTE DEPENDIENDO EL HOTEL-->
                                    </select>
                                </div>
                            </div>

                            <div class="form-group gruposBooking planCombinado planCombinadoHotel contCalendario col-sm-6 col-xs-12">
                                <div class="form-group gruposBooking col-sm-6 col-xs-12">
                                    <label for="entradaCompHotel2"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_FECHA_ENTRADA"])); ?></label>
                                    <div class="inputWrapper">
                                        <span class="iconInput"><i class="fa fa-calendar"></i></span>
                                        <input onkeydown="return false;" name="fechaEntradaAdicional" type="text" class="form-control datePickerEs hotel-adicional" id="entradaCompHotel2">
                                    </div>
                                </div>
                                <div class="form-group gruposBooking col-sm-6 col-xs-12">
                                    <label for="salidaCompHotel2"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_FECHA_SALIDA"])); ?></label>
                                    <div class="inputWrapper">
                                        <span class="iconInput"><i class="fa fa-calendar"></i></span>
                                        <input onkeydown="return false;" name="fechaSalidaAdicional" type="text" class="form-control datePickerEs hotel-adicional" id="salidaCompHotel2">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group gruposBooking planCombinado planCombinadoHotel contDerecho col-sm-2 col-xs-3">
                                <label for="nochesCompHotel2"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_NOCHES"])); ?></label>
                                <div class="inputWrapper">
                                    <span class="iconInput"><i class="fa fa-moon-o"></i></span>
                                    <input type="text" readonly class="form-control hotel-adicional" id="nochesCompHotel2" name="numNochesAdicional">
                                </div>
                            </div>

                            <div class="form-group gruposBooking col-sm-12 contHabitaciones">

                                <div id="navHabitacionesHotel">

                                    <!-- Tab Navigation Menu -->
                                    <ul>
                                        <li id="hab1Hotel" data-link="hab1" data-habitacion="1" ><a><i class="fa fa-bed"></i><span class="tituloTabBooking"> <?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_HABITACION"])); ?></span> 1</a></li>
                                        <li id="hab2Hotel" data-link="hab2" data-habitacion="2"><a><i class="fa fa-bed"></i><span class="tituloTabBooking"> <?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_HABITACION"])); ?></span> 2</a></li>
                                        <li id="hab3Hotel" data-link="hab3" data-habitacion="3"><a><i class="fa fa-bed"></i><span class="tituloTabBooking"> <?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_HABITACION"])); ?></span> 3</a></li>
                                    </ul>

                                    <!-- Content container -->
                                    <div>

                                        <!-- Habitación 1 -->
                                        <div>
                                            <div id="hab1HotelAdultos" class="form-group gruposBooking col-sm-2 col-xs-6 incrementalWrapper">
                                                <label for="salida"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_ADULTOS"])); ?></label>
                                                <div>
                                                    <button type="button" class="btn incrementalButton" id="restarHotelHab1Adulto">-</button>
                                                    <div class="selectWrapper selectNumbers">
                                                        <select class="form-control incrementalSelects" id="selectHotelHab1Adultos" name="selectHotelHab1Adultos">
                                                            <option value="">0</option>
                                                            <option value="1">1</option>
                                                            <option value="2" selected>2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                        </select>
                                                    </div>
                                                    <button type="button" class="btn incrementalButton" id="adicionarHotelHab1Adulto">+</button>
                                                </div>
                                            </div>
                                            <div id="hab1HotelNinyos" class="form-group gruposBooking col-sm-2 col-xs-6 incrementalWrapper">
                                                <label for="salida"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_NINOS"])); ?> <a id="tooltipHab1HotelNinyos" href="#" data-toggle="tooltip" data-placement="bottom" data-container="body" title="Se consideran ?Infantes? a los menores de 2 años y ?Niños?, a los menores en edades comprendidas entre los 2 años cumplidos y los 11 años en la fecha de ingreso al hotel, estas tarifas aplican para infantes y niños compartiendo habitación con mínimo dos adultos pagando tarifa de doble, o, un adulto pagando tarifa de sencilla.; A partir de los 12 años se considera adulto y se cobrara como tal. Es indispensable indicar las edades de los niños integrantes de un grupo familiar al solicitar la reserva y la confirmación de los servicios."><i style="color:#ed8323;" class="fa fa-question-circle"></i></a></label>
                                                <div>
                                                    <button type="button" class="btn incrementalButton" id="restarHotelHab1Ninyo">-</button>
                                                    <div class="selectWrapper selectNumbers">
                                                        <select class="form-control incrementalSelects" id="selectHotelHab1Ninyos" name="totalHab1ninyos" >
                                                            <option value="" selected>0</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                        </select>
                                                    </div>
                                                    <button type="button" class="btn incrementalButton" id="adicionarHotelHab1Ninyo">+</button>
                                                </div>
                                            </div>
                                            <div class="form-group gruposBooking col-sm-8 col-xs-12 incrementalWrapper contDerecho contEdadNinyos" id="contHotelHab1EdadNinyos">
                                                <label id="labelHotelHab1Ninyos" for="salida"><?php echo $this->classExtenstFunction->decodeText($textosCargar["LBL_EDAD_NIN_FECHA_SALIDA"]); ?></label>
                                                <div id="contentHotelHab1EdadNinyos">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Habitación 2 -->
                                        <div>
                                            <div id="hab2HotelAdultos" class="form-group gruposBooking col-sm-2 col-xs-6 incrementalWrapper">
                                                <label for="salida"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_ADULTOS"])); ?></label>
                                                <div>
                                                    <button type="button" class="btn incrementalButton" id="restarHotelHab2Adulto">-</button>
                                                    <div class="selectWrapper selectNumbers">
                                                        <select class="form-control incrementalSelects" id="selectHotelHab2Adultos" name="selectHotelHab2Adultos" >
                                                            <option value="">0</option>
                                                            <option value="1">1</option>
                                                            <option value="2" selected>2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                        </select>
                                                    </div>
                                                    <button type="button" class="btn incrementalButton" id="adicionarHotelHab2Adulto">+</button>
                                                </div>
                                            </div>
                                            <div id="hab2HotelNinyos" class="form-group gruposBooking col-sm-2 col-xs-6 incrementalWrapper">
                                                <label for="salida"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_NINOS"])); ?> <a id="tooltipHab2HotelNinyos" href="#" data-toggle="tooltip" data-placement="bottom" data-container="body" title="Se consideran ?Infantes? a los menores de 2 años y ?Niños?, a los menores en edades comprendidas entre los 2 años cumplidos y los 11 años en la fecha de ingreso al hotel, estas tarifas aplican para infantes y niños compartiendo habitación con mínimo dos adultos pagando tarifa de doble, o, un adulto pagando tarifa de sencilla.; A partir de los 12 años se considera adulto y se cobrara como tal. Es indispensable indicar las edades de los niños integrantes de un grupo familiar al solicitar la reserva y la confirmación de los servicios."><i style="color:#ed8323;" class="fa fa-question-circle"></i></a></label>
                                                <div>
                                                    <button type="button" class="btn incrementalButton" id="restarHotelHab2Ninyo">-</button>
                                                    <div class="selectWrapper selectNumbers">
                                                        <select class="form-control incrementalSelects" id="selectHotelHab2Ninyos" name="totalHab2ninyos" >
                                                            <option value="" selected>0</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                        </select>
                                                    </div>
                                                    <button type="button" class="btn incrementalButton" id="adicionarHotelHab2Ninyo">+</button>
                                                </div>
                                            </div>
                                            <div class="form-group gruposBooking col-sm-8 col-xs-12 incrementalWrapper contDerecho contEdadNinyos" id="contHotelHab2EdadNinyos">
                                                <label id="labelHotelHab2Ninyos" for="salida"><?php echo $this->classExtenstFunction->decodeText($textosCargar["LBL_EDAD_NIN_FECHA_SALIDA"]); ?></label>
                                                <div id="contentHotelHab2EdadNinyos">                                                    
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Habitación 3 -->
                                        <div>
                                            <div id="hab3HotelAdultos" class="form-group gruposBooking col-sm-2 col-xs-6 incrementalWrapper">
                                                <label for="salida"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_ADULTOS"])); ?></label>
                                                <div>
                                                    <button type="button" class="btn incrementalButton" id="restarHotelHab3Adulto">-</button>
                                                    <div class="selectWrapper selectNumbers">
                                                        <select class="form-control incrementalSelects" id="selectHotelHab3Adultos" name="selectHotelHab3Adultos">
                                                            <option value="">0</option>
                                                            <option value="1">1</option>
                                                            <option value="2" selected>2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                        </select>
                                                    </div>
                                                    <button type="button" class="btn incrementalButton" id="adicionarHotelHab3Adulto">+</button>
                                                </div>
                                            </div>
                                            <div id="hab3HotelNinyos" class="form-group gruposBooking col-sm-2 col-xs-6 incrementalWrapper">
                                                <label for="salida"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_NINOS"])); ?> <a id="tooltipHab3HotelNinyos" href="#" data-toggle="tooltip" data-placement="bottom" data-container="body" title="Se consideran ?Infantes? a los menores de 2 años y ?Niños?, a los menores en edades comprendidas entre los 2 años cumplidos y los 11 años en la fecha de ingreso al hotel, estas tarifas aplican para infantes y niños compartiendo habitación con mínimo dos adultos pagando tarifa de doble, o, un adulto pagando tarifa de sencilla.; A partir de los 12 años se considera adulto y se cobrara como tal. Es indispensable indicar las edades de los niños integrantes de un grupo familiar al solicitar la reserva y la confirmación de los servicios."><i style="color:#ed8323;" class="fa fa-question-circle"></i></a></label>
                                                <div>
                                                    <button type="button" class="btn incrementalButton" id="restarHotelHab3Ninyo">-</button>
                                                    <div class="selectWrapper selectNumbers">
                                                        <select class="form-control incrementalSelects" id="selectHotelHab3Ninyos" name="totalHab3ninyos" >
                                                            <option value="" selected>0</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                        </select>
                                                    </div>
                                                    <button type="button" class="btn incrementalButton" id="adicionarHotelHab3Ninyo">+</button>
                                                </div>
                                            </div>
                                            <div class="form-group gruposBooking col-sm-8 col-xs-12 incrementalWrapper contDerecho contEdadNinyos" id="contHotelHab3EdadNinyos">
                                                <label id="labelHotelHab3Ninyos" for="salida"><?php echo $this->classExtenstFunction->decodeText($textosCargar["LBL_EDAD_NIN_FECHA_SALIDA"]); ?></label>
                                                <div id="contentHotelHab3EdadNinyos">                                                    
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <div class="form-group gruposBooking contDerecho col-sm-12">
                                <div class="form-group gruposBooking col-xs-4 col-sm-3">
                                    <label for="codPromHotel"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_CODIGO_PROMCIONAL"])); ?></label>
                                    <div class="inputWrapper">
                                        <span class="iconInput"><i class="fa fa-tag"></i></span>
                                        <input type="text" class="form-control" id="codPromHotel" name="codPromocional">
                                    </div>
                                </div>
                                <div class="form-group gruposBooking contDerecho col-sm-2 pull-right">
                                    <label for="codProm" style="color:rgba(255,255,255,0);">Enviar</label>
                                    <button type="submit" class="btn btn-default enviarHotel col-xs-12" id="buscarHotel">Buscar <i class="fa fa-arrow-right"></i></button>
                                </div>
                            </div>

                        </form>

                    </div>

                    <!-- HOTEL + AÉREO -->
                    <div>

                        <form role="form" id="frm_aereo" name="frm_aereo" method="POST" action="<?php echo SUBMIT_APP; ?>" >
                            <div data-error="hotel" class="error_aereo errorAlert" style="display: none;"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_CAMPO_OBLIGATORIO"])); ?></div>
                            <input class="plHotel" id="plane" name="plane" type="hidden" value="A" />                            
                            <input id="ctrAereo" name="ctrAereo" type="hidden" value="1" />
                            <input id="componente" name="componente" type="hidden" value="Aereo" />
                            <input id="sigPais" name="sigPais" type="hidden" value="" />
                            <input id="idioma" name="idioma" type="hidden" value="" />
                            <input id="codPais" name="codPais" type="hidden" value="" />	
                            <input id="hab1ninosAereo" name="hab1ninos" type="hidden" value="0" />	
                            <input id="hab2ninosAereo" name="hab2ninos" type="hidden" value="0" />	
                            <input id="hab3ninosAereo" name="hab3ninos" type="hidden" value="0" />	
                            <input id="hab1infantesAereo" name="hab1infantes" type="hidden" value="0" />	
                            <input id="hab2infantesAereo" name="hab2infantes" type="hidden" value="0" />	
                            <input id="hab3infantesAereo" name="hab3infantes" type="hidden" value="0" />
                            <input id="fechaEntradaf" name="fechaEntradaf" class="fechaEntradaf" type="hidden" value="" />	
                            <input id="fechaSalidaf" name="fechaSalidaf" class="fechaSalidaf" type="hidden" value="" />	
                            <input id="fechaEntradaAdicionalf" name="fechaEntradaAdicionalf" class="fechaEntradaAdicionalf" type="hidden" value="" />	
                            <input id="fechaSalidaAdicionalf" name="fechaSalidaAdicionalf" class="fechaSalidaAdicionalf" type="hidden" value="" />	

                            <div class="form-group gruposBooking col-sm-6">
                                <label for="origenCompAereo"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_CIUDAD_ORIGEN"])); ?></label>
                                <div class="inputWrapper">
                                    <span class="iconInput"><i class="fa fa-map-marker"></i></span>
                                    <input id="ciudadAereoOrigen" name="ciudadAereoOrigen" type="hidden" data-ciudad="required" />	
                                    <input data-ignore="required" class="form-control autocompletado" id="origenCompAereo" name="origenCompAereo" type="text" placeholder="¿Cuál es tu ciudad de origen?">
                                </div>
                            </div>

                            <div class="form-group gruposBooking contDerecho col-sm-6">
                                <label for="hotelCompHotel1"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_HOTEL"])); ?></label>
                                <div class="inputWrapper" id="hotelWrapperHotel1">
                                    <span class="iconInput"><i class="fa fa-building-o"></i></span>
                                    <select name="hotel" class="form-control selectpicker" id="hotelCompAereo1" data-live-search="true" data-container="body" title="Selecciona tu hotel favorito">
                                        <?php echo $this->classExtenstFunction->decodeText($HOTEL); ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group gruposBooking contCalendario col-sm-6">
                                <div class="form-group gruposBooking col-sm-6">
                                    <label for="entradaCompAereo1"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_FECHA_ENTRADA"])); ?></label>
                                    <div class="inputWrapper">
                                        <span class="iconInput"><i class="fa fa-calendar"></i></span>
                                        <input onkeydown="return false;" name="fechaEntrada" type="text" class="form-control datePickerEs" id="entradaCompAereo1">
                                    </div>
                                </div>
                                <div class="form-group gruposBooking col-sm-6">
                                    <label for="salidaCompAereo1"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_FECHA_SALIDA"])); ?></label>
                                    <div class="inputWrapper">
                                        <span class="iconInput"><i class="fa fa-calendar"></i></span>
                                        <input onkeydown="return false;" name="fechaSalida" type="text" class="form-control datePickerEs" id="salidaCompAereo1">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group gruposBooking contDerecho col-sm-6">
                                <div class="form-group gruposBooking gruposPadding col-xs-3">
                                    <label for="nochesCompAereo1"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_NOCHES"])); ?></label>
                                    <div class="inputWrapper">
                                        <span class="iconInput"><i class="fa fa-moon-o"></i></span>
                                        <input type="text" readonly class="form-control" id="nochesCompAereo1" name="numNoches">
                                    </div>
                                </div>
                                <div class="form-group gruposBooking gruposPadding col-xs-4 col-sm-4">
                                    <label for="salida"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_HABITACIONES"])); ?></label>
                                    <div class="btn-group btn-group-select-num" id="botonHabAereo" data-toggle="buttons">
                                        <label class="btn btnHabitaciones active"><input type="radio" name="numHabAereo" class="numHabAereo" id="numHabAereo" value="1">1</label>
                                        <label class="btn btnHabitaciones "><input type="radio" name="numHabAereo" class="numHabAereo" id="numHabAereo" value="2">2</label>
                                        <label class="btn btnHabitaciones "><input type="radio" name="numHabAereo" class="numHabAereo" id="numHabAereo" value="3">3</label>
                                    </div>
                                </div>

                                <div id="divPlanCombinadoAereo" class="form-group gruposBooking gruposPadding contDerecho elegirCombinar col-xs-5">
                                    <label for="salida"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_COMBINAR"])); ?> <a id="tooltipCombinadoAereo" href="#" data-toggle="tooltip" data-placement="bottom" data-container="body" title="Al seleccionar esta opción puedes combinar tu viaje con otro hotel cercano."><i style="color:#ed8323;" class="fa fa-question-circle"></i></a></label>
                                    <div class="checkbox">
                                        <label><input type="checkbox" value="1" id="combinarAereo" name="combinarAereo"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_OTRO_HOTEL"])); ?></label>
                                    </div>
                                </div>
                            </div>

                            <!--DIV HOTEL ADICIONAL-->
                            <div class="form-group gruposBooking planCombinado planCombinadoAereo segHotel col-sm-4 col-xs-12">
                                <label for="hotelCompAereo2"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_HOTEL"])); ?></label>
                                <div class="inputWrapper">
                                    <span class="iconInput"><i class="fa fa-building-o"></i></span>
                                    <select name="hotelAdicional" class="form-control selectpicker hotel-adicional" id="hotelCompAereo2" data-live-search="true" data-container="body" title="Selecciona tu hotel favorito">                                        
                                        <!--ACA VA DINAMICAMENTE DEPENDIENDO EL HOTEL-->
                                    </select>
                                </div>
                            </div>

                            <div class="form-group gruposBooking planCombinado planCombinadoAereo contCalendario col-sm-6 col-xs-12">
                                <div class="form-group gruposBooking col-sm-6 col-xs-12">
                                    <label for="entradaCompAereo2"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_FECHA_ENTRADA"])); ?></label>
                                    <div class="inputWrapper">
                                        <span class="iconInput"><i class="fa fa-calendar"></i></span>
                                        <input onkeydown="return false;" name="fechaEntradaAdicional" type="text" class="form-control datePickerEs hotel-adicional" id="entradaCompAereo2">
                                    </div>
                                </div>
                                <div class="form-group gruposBooking col-sm-6 col-xs-12">
                                    <label for="salidaCompAereo2"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_FECHA_SALIDA"])); ?></label>
                                    <div class="inputWrapper">
                                        <span class="iconInput"><i class="fa fa-calendar"></i></span>
                                        <input onkeydown="return false;" name="fechaSalidaAdicional" type="text" class="form-control datePickerEs hotel-adicional" id="salidaCompAereo2">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group gruposBooking planCombinado planCombinadoAereo contDerecho col-sm-2 col-xs-3">
                                <label for="nochesCompAereo2"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_NOCHES"])); ?></label>
                                <div class="inputWrapper">
                                    <span class="iconInput"><i class="fa fa-moon-o"></i></span>
                                    <input type="text" readonly class="form-control hotel-adicional" id="nochesCompAereo2" name="numNochesAdicional">
                                </div>
                            </div>

                            <div class="form-group gruposBooking col-sm-12 contHabitaciones">

                                <div id="navHabitacionesAereo">

                                    <!-- Tab Navigation Menu -->
                                    <ul>
                                        <li id="hab1Aereo" data-link="hab1" data-habitacion="1" ><a><i class="fa fa-bed"></i><span class="tituloTabBooking"> <?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_HABITACION"])); ?></span> 1</a></li>
                                        <li id="hab2Aereo" data-link="hab2" data-habitacion="2"><a><i class="fa fa-bed"></i><span class="tituloTabBooking"> <?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_HABITACION"])); ?></span> 2</a></li>
                                        <li id="hab3Aereo" data-link="hab3" data-habitacion="3"><a><i class="fa fa-bed"></i><span class="tituloTabBooking"> <?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_HABITACION"])); ?></span> 3</a></li>
                                    </ul>

                                    <!-- Content container -->
                                    <div>

                                        <!-- Habitación 1 -->
                                        <div>
                                            <div id="hab1AereoAdultos" class="form-group gruposBooking col-sm-2 col-xs-6 incrementalWrapper">
                                                <label for="salida"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_ADULTOS"])); ?></label>
                                                <div>
                                                    <button type="button" class="btn incrementalButton" id="restarAereoHab1Adulto">-</button>
                                                    <div class="selectWrapper selectNumbers">
                                                        <select class="form-control incrementalSelects" id="selectAereoHab1Adultos" name="selectAereoHab1Adultos">
                                                            <option value="">0</option>
                                                            <option value="1">1</option>
                                                            <option value="2" selected>2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                        </select>
                                                    </div>
                                                    <button type="button" class="btn incrementalButton" id="adicionarAereoHab1Adulto">+</button>
                                                </div>
                                            </div>
                                            <div id="hab1AereoNinyos" class="form-group gruposBooking col-sm-2 col-xs-6 incrementalWrapper">
                                                <label for="salida"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_NINOS"])); ?> <a id="tooltipHab1AereoNinyos" href="#" data-toggle="tooltip" data-placement="bottom" data-container="body" title="Se consideran ?Infantes? a los menores de 2 años y ?Niños?, a los menores en edades comprendidas entre los 2 años cumplidos y los 11 años en la fecha de ingreso al hotel, estas tarifas aplican para infantes y niños compartiendo habitación con mínimo dos adultos pagando tarifa de doble, o, un adulto pagando tarifa de sencilla.; A partir de los 12 años se considera adulto y se cobrara como tal. Es indispensable indicar las edades de los niños integrantes de un grupo familiar al solicitar la reserva y la confirmación de los servicios."><i style="color:#ed8323;" class="fa fa-question-circle"></i></a></label>
                                                <div>
                                                    <button type="button" class="btn incrementalButton" id="restarAereoHab1Ninyo">-</button>
                                                    <div class="selectWrapper selectNumbers">
                                                        <select class="form-control incrementalSelects" id="selectAereoHab1Ninyos" name="totalHab1ninyos" >
                                                            <option value="" selected>0</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                        </select>
                                                    </div>
                                                    <button type="button" class="btn incrementalButton" id="adicionarAereoHab1Ninyo">+</button>
                                                </div>
                                            </div>
                                            <div class="form-group gruposBooking col-sm-8 col-xs-12 incrementalWrapper contDerecho contEdadNinyos" id="contAereoHab1EdadNinyos">
                                                <label id="labelAereoHab1Ninyos" for="salida"><?php echo $this->classExtenstFunction->decodeText($textosCargar["LBL_EDAD_NIN_FECHA_SALIDA"]); ?></label>
                                                <div id="contentAereoHab1EdadNinyos">                                                    
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Habitación 2 -->
                                        <div>
                                            <div id="hab2AereoAdultos" class="form-group gruposBooking col-sm-2 col-xs-6 incrementalWrapper">
                                                <label for="salida"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_ADULTOS"])); ?></label>
                                                <div>
                                                    <button type="button" class="btn incrementalButton" id="restarAereoHab2Adulto">-</button>
                                                    <div class="selectWrapper selectNumbers">
                                                        <select class="form-control incrementalSelects" id="selectAereoHab2Adultos" name="selectAereoHab2Adultos" >
                                                            <option value="">0</option>
                                                            <option value="1">1</option>
                                                            <option value="2" selected>2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                        </select>
                                                    </div>
                                                    <button type="button" class="btn incrementalButton" id="adicionarAereoHab2Adulto">+</button>
                                                </div>
                                            </div>
                                            <div id="hab2AereoNinyos" class="form-group gruposBooking col-sm-2 col-xs-6 incrementalWrapper">
                                                <label for="salida"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_NINOS"])); ?> <a id="tooltipHab2AereoNinyos" href="#" data-toggle="tooltip" data-placement="bottom" data-container="body" title="Se consideran ?Infantes? a los menores de 2 años y ?Niños?, a los menores en edades comprendidas entre los 2 años cumplidos y los 11 años en la fecha de ingreso al hotel, estas tarifas aplican para infantes y niños compartiendo habitación con mínimo dos adultos pagando tarifa de doble, o, un adulto pagando tarifa de sencilla.; A partir de los 12 años se considera adulto y se cobrara como tal. Es indispensable indicar las edades de los niños integrantes de un grupo familiar al solicitar la reserva y la confirmación de los servicios."><i style="color:#ed8323;" class="fa fa-question-circle"></i></a></label>
                                                <div>
                                                    <button type="button" class="btn incrementalButton" id="restarAereoHab2Ninyo">-</button>
                                                    <div class="selectWrapper selectNumbers">
                                                        <select class="form-control incrementalSelects" id="selectAereoHab2Ninyos" name="totalHab2ninyos" >
                                                            <option value="" selected>0</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                        </select>
                                                    </div>
                                                    <button type="button" class="btn incrementalButton" id="adicionarAereoHab2Ninyo">+</button>
                                                </div>
                                            </div>
                                            <div class="form-group gruposBooking col-sm-8 col-xs-12 incrementalWrapper contDerecho contEdadNinyos" id="contAereoHab2EdadNinyos">
                                                <label id="labelAereoHab2Ninyos" for="salida"><?php echo $this->classExtenstFunction->decodeText($textosCargar["LBL_EDAD_NIN_FECHA_SALIDA"]); ?></label>
                                                <div id="contentAereoHab2EdadNinyos">                                                    
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Habitación 3 -->
                                        <div>
                                            <div id="hab3AereoAdultos" class="form-group gruposBooking col-sm-2 col-xs-6 incrementalWrapper">
                                                <label for="salida"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_ADULTOS"])); ?></label>
                                                <div>
                                                    <button type="button" class="btn incrementalButton" id="restarAereoHab3Adulto">-</button>
                                                    <div class="selectWrapper selectNumbers">
                                                        <select class="form-control incrementalSelects" id="selectAereoHab3Adultos" name="selectAereoHab3Adultos">
                                                            <option value="">0</option>
                                                            <option value="1">1</option>
                                                            <option value="2" selected>2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                        </select>
                                                    </div>
                                                    <button type="button" class="btn incrementalButton" id="adicionarAereoHab3Adulto">+</button>
                                                </div>
                                            </div>
                                            <div id="hab3AereoNinyos" class="form-group gruposBooking col-sm-2 col-xs-6 incrementalWrapper">
                                                <label for="salida"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_NINOS"])); ?> <a id="tooltipHab3AereoNinyos" href="#" data-toggle="tooltip" data-placement="bottom" data-container="body" title="Se consideran ?Infantes? a los menores de 2 años y ?Niños?, a los menores en edades comprendidas entre los 2 años cumplidos y los 11 años en la fecha de ingreso al hotel, estas tarifas aplican para infantes y niños compartiendo habitación con mínimo dos adultos pagando tarifa de doble, o, un adulto pagando tarifa de sencilla.; A partir de los 12 años se considera adulto y se cobrara como tal. Es indispensable indicar las edades de los niños integrantes de un grupo familiar al solicitar la reserva y la confirmación de los servicios."><i style="color:#ed8323;" class="fa fa-question-circle"></i></a></label>
                                                <div>
                                                    <button type="button" class="btn incrementalButton" id="restarAereoHab3Ninyo">-</button>
                                                    <div class="selectWrapper selectNumbers">
                                                        <select class="form-control incrementalSelects" id="selectAereoHab3Ninyos" name="totalHab3ninyos" >
                                                            <option value="" selected>0</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                        </select>
                                                    </div>
                                                    <button type="button" class="btn incrementalButton" id="adicionarAereoHab3Ninyo">+</button>
                                                </div>
                                            </div>
                                            <div class="form-group gruposBooking col-sm-8 col-xs-12 incrementalWrapper contDerecho contEdadNinyos" id="contAereoHab3EdadNinyos">
                                                <label id="labelAereoHab3Ninyos" for="salida"><?php echo $this->classExtenstFunction->decodeText($textosCargar["LBL_EDAD_NIN_FECHA_SALIDA"]); ?></label>
                                                <div id="contentAereoHab3EdadNinyos">                                                    
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <div class="form-group gruposBooking contDerecho col-sm-12">
                                <div class="form-group gruposBooking col-xs-4 col-sm-3">
                                    <label for="codPromAereo"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_CODIGO_PROMCIONAL"])); ?></label>
                                    <div class="inputWrapper">
                                        <span class="iconInput"><i class="fa fa-tag"></i></span>
                                        <input type="text" class="form-control" id="codPromAereo">
                                    </div>
                                </div>
                                <div class="form-group gruposBooking contDerecho col-sm-2 pull-right">
                                    <label for="codProm" style="color:rgba(255,255,255,0);">Enviar</label>
                                    <button type="submit" class="btn btn-default enviarHotel col-xs-12" id="buscarAereo">Buscar <i class="fa fa-arrow-right"></i></button>
                                </div>
                            </div>

                        </form>

                    </div>

                    <!-- HOTEL + TERRESTRE -->
                    <div>

                        <form role="form" id="frm_terrestre" name="frm_terrestre" method="POST" action="<?php echo SUBMIT_APP; ?>" >
                            <div data-error="terrestre" class="error_terrestre errorAlert" style="display: none;"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_CAMPO_OBLIGATORIO"])); ?></div>
                            <input class="plHotel" id="plane" name="plane" type="hidden" value="T" />    
                            <input id="ctrTerr" name="ctrTerr" type="hidden" value="1" />
                            <input id="componente" name="componente" type="hidden" value="Terrestre" />
                            <input id="sigPais" name="sigPais" type="hidden" value="" />
                            <input id="idioma" name="idioma" type="hidden" value="" />
                            <input id="codPais" name="codPais" type="hidden" value="" />	
                            <input id="hab1ninosTerrestre" name="hab1ninos" type="hidden" value="0" />	
                            <input id="hab2ninosTerrestre" name="hab2ninos" type="hidden" value="0" />	
                            <input id="hab3ninosTerrestre" name="hab3ninos" type="hidden" value="0" />	
                            <input id="hab1infantesTerrestre" name="hab1infantes" type="hidden" value="0" />	
                            <input id="hab2infantesTerrestre" name="hab2infantes" type="hidden" value="0" />	
                            <input id="hab3infantesTerrestre" name="hab3infantes" type="hidden" value="0" />	
                            <input id="fechaEntradaf" name="fechaEntradaf" class="fechaEntradaf" type="hidden" value="" />	
                            <input id="fechaSalidaf" name="fechaSalidaf" class="fechaSalidaf" type="hidden" value="" />	
                            <input id="fechaEntradaAdicionalf" name="fechaEntradaAdicionalf" class="fechaEntradaAdicionalf" type="hidden" value="" />	
                            <input id="fechaSalidaAdicionalf" name="fechaSalidaAdicionalf" class="fechaSalidaAdicionalf" type="hidden" value="" />	                            

                            <div class="form-group gruposBooking col-sm-6">
                                <label for="origenCompTerrestre"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_CIUDAD_ORIGEN"])); ?></label>
                                <div class="inputWrapper">
                                    <span class="iconInput"><i class="fa fa-map-marker"></i></span>
                                    <select name="ciudadTerrestreOrigen" class="form-control selectpicker" id="ciudadTerrestreOrigen" data-live-search="true" data-container="body" title="Selecciona la ciudad de origen">
                                        <?php echo $this->classExtenstFunction->decodeText($ciudadesSelect); ?>
                                    </select>
                                    <!--<input class="form-control" id="origenCompTerrestre" name="origenCompTerrestre" type="text" placeholder="¿Cuál es tu ciudad de origen?">-->
                                </div>
                            </div>

                            <div class="form-group gruposBooking contDerecho col-sm-6">
                                <label for="hotelCompTerrestre1"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_HOTEL"])); ?></label>
                                <div class="inputWrapper" id="hotelWrapperHotel1">
                                    <span class="iconInput"><i class="fa fa-building-o"></i></span>
                                    <select name="hotel" class="form-control selectpicker" id="hotelCompTerrestre1" data-live-search="true" data-container="body" title="Selecciona tu hotel favorito">
                                        <?php echo $this->classExtenstFunction->decodeText($HOTEL); ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group gruposBooking contCalendario col-sm-6">
                                <div class="form-group gruposBooking col-sm-6">
                                    <label for="entradaCompTerrestre1"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_FECHA_ENTRADA"])); ?></label>
                                    <div class="inputWrapper">
                                        <span class="iconInput"><i class="fa fa-calendar"></i></span>
                                        <input onkeydown="return false;" name="fechaEntrada" type="text" class="form-control datePickerEs" id="entradaCompTerrestre1">
                                    </div>
                                </div>
                                <div class="form-group gruposBooking col-sm-6">
                                    <label for="salidaCompTerrestre1"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_FECHA_SALIDA"])); ?></label>
                                    <div class="inputWrapper">
                                        <span class="iconInput"><i class="fa fa-calendar"></i></span>
                                        <input onkeydown="return false;" name="fechaSalida" type="text" class="form-control datePickerEs" id="salidaCompTerrestre1">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group gruposBooking contDerecho col-sm-6">
                                <div class="form-group gruposBooking gruposPadding col-xs-3">
                                    <label for="nochesCompTerrestre1"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_NOCHES"])); ?></label>
                                    <div class="inputWrapper">
                                        <span class="iconInput"><i class="fa fa-moon-o"></i></span>
                                        <input type="text" readonly class="form-control" id="nochesCompTerrestre1" name="numNoches" >
                                    </div>
                                </div>
                                <div class="form-group gruposBooking gruposPadding col-xs-4 col-sm-4">
                                    <label for="salida"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_HABITACIONES"])); ?></label>
                                    <div class="btn-group btn-group-select-num" id="botonHabTerrestre" data-toggle="buttons">
                                        <label class="btn btnHabitaciones active"><input type="radio" name="numHabTerrestre" class="numHabTerrestre" id="numHabTerrestre" value="1">1</label>
                                        <label class="btn btnHabitaciones "><input type="radio" name="numHabTerrestre" class="numHabTerrestre" id="numHabTerrestre" value="2">2</label>
                                        <label class="btn btnHabitaciones "><input type="radio" name="numHabTerrestre" class="numHabTerrestre" id="numHabTerrestre" value="3">3</label>
                                    </div>
                                </div>

                                <div id="divPlanCombinadoTerrestre" class="form-group gruposBooking gruposPadding contDerecho elegirCombinar col-xs-5">
                                    <label for="salida"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_COMBINAR"])); ?> <a id="tooltipCombinadoTerrestre" href="#" data-toggle="tooltip" data-placement="bottom" data-container="body" title="Al seleccionar esta opción puedes combinar tu viaje con otro hotel cercano."><i style="color:#ed8323;" class="fa fa-question-circle"></i></a></label>
                                    <div class="checkbox">
                                        <label><input type="checkbox" value="1" id="combinarTerrestre" name="combinarTerrestre"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_OTRO_HOTEL"])); ?></label>
                                    </div>
                                </div>
                            </div>

                            <!--DIV HOTEL ADICIONAL-->
                            <div class="form-group gruposBooking planCombinado planCombinadoTerrestre segHotel col-sm-4 col-xs-12">
                                <label for="hotelCompTerrestre2"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_HOTEL"])); ?></label>
                                <div class="inputWrapper">
                                    <span class="iconInput"><i class="fa fa-building-o"></i></span>
                                    <select name="hotelAdicional" class="form-control selectpicker hotel-adicional" id="hotelCompTerrestre2" data-live-search="true" data-container="body" title="Selecciona tu hotel favorito">                                        
                                        <!--ACA VA DINAMICAMENTE DEPENDIENDO EL HOTEL-->
                                    </select>
                                </div>
                            </div>

                            <div class="form-group gruposBooking planCombinado planCombinadoTerrestre contCalendario col-sm-6 col-xs-12">
                                <div class="form-group gruposBooking col-sm-6 col-xs-12">
                                    <label for="entradaCompTerrestre2"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_FECHA_ENTRADA"])); ?></label>
                                    <div class="inputWrapper">
                                        <span class="iconInput"><i class="fa fa-calendar"></i></span>
                                        <input onkeydown="return false;" name="fechaEntradaAdicional" type="text" class="form-control datePickerEs hotel-adicional" id="entradaCompTerrestre2">
                                    </div>
                                </div>
                                <div class="form-group gruposBooking col-sm-6 col-xs-12">
                                    <label for="salidaCompTerrestre2"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_FECHA_SALIDA"])); ?></label>
                                    <div class="inputWrapper">
                                        <span class="iconInput"><i class="fa fa-calendar"></i></span>
                                        <input onkeydown="return false;" name="fechaSalidaAdicional" type="text" class="form-control datePickerEs hotel-adicional" id="salidaCompTerrestre2">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group gruposBooking planCombinado planCombinadoTerrestre contDerecho col-sm-2 col-xs-3">
                                <label for="nochesCompTerrestre2"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_NOCHES"])); ?></label>
                                <div class="inputWrapper">
                                    <span class="iconInput"><i class="fa fa-moon-o"></i></span>
                                    <input type="text" readonly class="form-control hotel-adicional" id="nochesCompTerrestre2" name="numNochesAdicional">
                                </div>
                            </div>

                            <div class="form-group gruposBooking col-sm-12 contHabitaciones">

                                <div id="navHabitacionesTerrestre">

                                    <!-- Tab Navigation Menu -->
                                    <ul>
                                        <li id="hab1Terrestre" data-link="hab1" data-habitacion="1" ><a><i class="fa fa-bed"></i><span class="tituloTabBooking"> <?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_HABITACION"])); ?></span> 1</a></li>
                                        <li id="hab2Terrestre" data-link="hab2" data-habitacion="2"><a><i class="fa fa-bed"></i><span class="tituloTabBooking"> <?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_HABITACION"])); ?></span> 2</a></li>
                                        <li id="hab3Terrestre" data-link="hab3" data-habitacion="3"><a><i class="fa fa-bed"></i><span class="tituloTabBooking"> <?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_HABITACION"])); ?></span> 3</a></li>
                                    </ul>

                                    <!-- Content container -->
                                    <div>

                                        <!-- Habitación 1 -->
                                        <div>
                                            <div id="hab1TerrestreAdultos" class="form-group gruposBooking col-sm-2 col-xs-6 incrementalWrapper">
                                                <label for="salida"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_ADULTOS"])); ?></label>
                                                <div>
                                                    <button type="button" class="btn incrementalButton" id="restarTerrestreHab1Adulto">-</button>
                                                    <div class="selectWrapper selectNumbers">
                                                        <select class="form-control incrementalSelects" id="selectTerrestreHab1Adultos" name="selectTerrestreHab1Adultos">
                                                            <option value="">0</option>
                                                            <option value="1">1</option>
                                                            <option value="2" selected>2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                        </select>
                                                    </div>
                                                    <button type="button" class="btn incrementalButton" id="adicionarTerrestreHab1Adulto">+</button>
                                                </div>
                                            </div>
                                            <div id="hab1TerrestreNinyos" class="form-group gruposBooking col-sm-2 col-xs-6 incrementalWrapper">
                                                <label for="salida"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_NINOS"])); ?> <a id="tooltipHab1TerrestreNinyos" href="#" data-toggle="tooltip" data-placement="bottom" data-container="body" title="Se consideran ?Infantes? a los menores de 2 años y ?Niños?, a los menores en edades comprendidas entre los 2 años cumplidos y los 11 años en la fecha de ingreso al hotel, estas tarifas aplican para infantes y niños compartiendo habitación con mínimo dos adultos pagando tarifa de doble, o, un adulto pagando tarifa de sencilla.; A partir de los 12 años se considera adulto y se cobrara como tal. Es indispensable indicar las edades de los niños integrantes de un grupo familiar al solicitar la reserva y la confirmación de los servicios."><i style="color:#ed8323;" class="fa fa-question-circle"></i></a></label>
                                                <div>
                                                    <button type="button" class="btn incrementalButton" id="restarTerrestreHab1Ninyo">-</button>
                                                    <div class="selectWrapper selectNumbers">
                                                        <select class="form-control incrementalSelects" id="selectTerrestreHab1Ninyos" name="totalHab1ninyos" >
                                                            <option value="" selected>0</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                        </select>
                                                    </div>
                                                    <button type="button" class="btn incrementalButton" id="adicionarTerrestreHab1Ninyo">+</button>
                                                </div>
                                            </div>
                                            <div class="form-group gruposBooking col-sm-8 col-xs-12 incrementalWrapper contDerecho contEdadNinyos" id="contTerrestreHab1EdadNinyos">
                                                <label id="labelTerrestreHab1Ninyos" for="salida"><?php echo $this->classExtenstFunction->decodeText($textosCargar["LBL_EDAD_NIN_FECHA_SALIDA"]); ?></label>
                                                <div id="contentTerrestreHab1EdadNinyos">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Habitación 2 -->
                                        <div>
                                            <div id="hab2TerrestreAdultos" class="form-group gruposBooking col-sm-2 col-xs-6 incrementalWrapper">
                                                <label for="salida"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_ADULTOS"])); ?></label>
                                                <div>
                                                    <button type="button" class="btn incrementalButton" id="restarTerrestreHab2Adulto">-</button>
                                                    <div class="selectWrapper selectNumbers">
                                                        <select class="form-control incrementalSelects" id="selectTerrestreHab2Adultos" name="selectTerrestreHab2Adultos">
                                                            <option value="">0</option>
                                                            <option value="1">1</option>
                                                            <option value="2" selected>2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                        </select>
                                                    </div>
                                                    <button type="button" class="btn incrementalButton" id="adicionarTerrestreHab2Adulto">+</button>
                                                </div>
                                            </div>
                                            <div id="hab2TerrestreNinyos" class="form-group gruposBooking col-sm-2 col-xs-6 incrementalWrapper">
                                                <label for="salida"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_NINOS"])); ?> <a id="tooltipHab2TerrestreNinyos" href="#" data-toggle="tooltip" data-placement="bottom" data-container="body" title="Se consideran ?Infantes? a los menores de 2 años y ?Niños?, a los menores en edades comprendidas entre los 2 años cumplidos y los 11 años en la fecha de ingreso al hotel, estas tarifas aplican para infantes y niños compartiendo habitación con mínimo dos adultos pagando tarifa de doble, o, un adulto pagando tarifa de sencilla.; A partir de los 12 años se considera adulto y se cobrara como tal. Es indispensable indicar las edades de los niños integrantes de un grupo familiar al solicitar la reserva y la confirmación de los servicios."><i style="color:#ed8323;" class="fa fa-question-circle"></i></a></label>
                                                <div>
                                                    <button type="button" class="btn incrementalButton" id="restarTerrestreHab2Ninyo">-</button>
                                                    <div class="selectWrapper selectNumbers">
                                                        <select class="form-control incrementalSelects" id="selectTerrestreHab2Ninyos" name="totalHab2ninyos" >
                                                            <option value="" selected>0</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                        </select>
                                                    </div>
                                                    <button type="button" class="btn incrementalButton" id="adicionarTerrestreHab2Ninyo">+</button>
                                                </div>
                                            </div>
                                            <div class="form-group gruposBooking col-sm-8 col-xs-12 incrementalWrapper contDerecho contEdadNinyos" id="contTerrestreHab2EdadNinyos">
                                                <label id="labelTerrestreHab2Ninyos" for="salida"><?php echo $this->classExtenstFunction->decodeText($textosCargar["LBL_EDAD_NIN_FECHA_SALIDA"]); ?></label>
                                                <div id="contentTerrestreHab2EdadNinyos">                                                    
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Habitación 3 -->
                                        <div>
                                            <div id="hab3TerrestreAdultos" class="form-group gruposBooking col-sm-2 col-xs-6 incrementalWrapper">
                                                <label for="salida"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_ADULTOS"])); ?></label>
                                                <div>
                                                    <button type="button" class="btn incrementalButton" id="restarTerrestreHab3Adulto">-</button>
                                                    <div class="selectWrapper selectNumbers">
                                                        <select class="form-control incrementalSelects" id="selectTerrestreHab3Adultos" name="selectTerrestreHab3Adultos">
                                                            <option value="">0</option>
                                                            <option value="1">1</option>
                                                            <option value="2" selected>2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                        </select>
                                                    </div>
                                                    <button type="button" class="btn incrementalButton" id="adicionarTerrestreHab3Adulto">+</button>
                                                </div>
                                            </div>
                                            <div id="hab3TerrestreNinyos" class="form-group gruposBooking col-sm-2 col-xs-6 incrementalWrapper">
                                                <label for="salida"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_NINOS"])); ?> <a id="tooltipHab3TerrestreNinyos" href="#" data-toggle="tooltip" data-placement="bottom" data-container="body" title="Se consideran ?Infantes? a los menores de 2 años y ?Niños?, a los menores en edades comprendidas entre los 2 años cumplidos y los 11 años en la fecha de ingreso al hotel, estas tarifas aplican para infantes y niños compartiendo habitación con mínimo dos adultos pagando tarifa de doble, o, un adulto pagando tarifa de sencilla.; A partir de los 12 años se considera adulto y se cobrara como tal. Es indispensable indicar las edades de los niños integrantes de un grupo familiar al solicitar la reserva y la confirmación de los servicios."><i style="color:#ed8323;" class="fa fa-question-circle"></i></a></label>
                                                <div>
                                                    <button type="button" class="btn incrementalButton" id="restarTerrestreHab3Ninyo">-</button>
                                                    <div class="selectWrapper selectNumbers">
                                                        <select class="form-control incrementalSelects" id="selectTerrestreHab3Ninyos" name="totalHab3ninyos" >
                                                            <option value="" selected>0</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                        </select>
                                                    </div>
                                                    <button type="button" class="btn incrementalButton" id="adicionarTerrestreHab3Ninyo">+</button>
                                                </div>
                                            </div>
                                            <div class="form-group gruposBooking col-sm-8 col-xs-12 incrementalWrapper contDerecho contEdadNinyos" id="contTerrestreHab3EdadNinyos">
                                                <label id="labelTerrestreHab3Ninyos" for="salida"><?php echo $this->classExtenstFunction->decodeText($textosCargar["LBL_EDAD_NIN_FECHA_SALIDA"]); ?></label>
                                                <div id="contentTerrestreHab3EdadNinyos">                                                    
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <div class="form-group gruposBooking contDerecho col-sm-12">
                                <div class="form-group gruposBooking col-xs-4 col-sm-3">
                                    <label for="codPromTerrestre"><?php echo $this->classExtenstFunction->decodeText($this->classExtenstFunction->capitalizedOmitting($textosCargar["LBL_CODIGO_PROMCIONAL"])); ?></label>
                                    <div class="inputWrapper">
                                        <span class="iconInput"><i class="fa fa-tag"></i></span>
                                        <input type="text" class="form-control" id="codPromTerrestre">
                                    </div>
                                </div>
                                <div class="form-group gruposBooking contDerecho col-sm-2 pull-right">
                                    <label for="codProm" style="color:rgba(255,255,255,0);">Enviar</label>
                                    <button type="submit" class="btn btn-default enviarHotel col-xs-12" id="buscarTerrestre">Buscar <i class="fa fa-arrow-right"></i></button>
                                </div>
                            </div>

                        </form>

                    </div>

                </div>

            </div>
            <!-- End First Tabs-->

        </div>
    </body>
</html>