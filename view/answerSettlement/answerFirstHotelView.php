<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Cotización</title>
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

        <link rel="stylesheet" href="../media/css/apps/answerSettlement.css?v=<?php echo VERSION; ?>">
        <script src="../media/js/apps/initAppAnsewerSettlement.js?v=<?php echo VERSION; ?>"></script>
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
            const hotelsNoAdmin = '<?php echo HOTEL_NO_ADMITE_NINOS; ?>';
            var __app = new App();
<?php
include(RUTA_AUTOCOMPLETADO . "/autocomplet.js");
include(RUTA_AUTOCOMPLETADO . "/acomodationsHotel.js");
?>
        </script>
    </head>

    <body>

        <div class=".container-fluid" id="cotizacionWrapper" style="width:100%; max-width:1140px; margin:0 auto;">

            <div class="col-xs-12 tituloCaja alertaNaranja"><i class="fa fa-exclamation-circle"></i> No encontramos planes con transporte que se ajusten a tu consulta, pero te ofrecemos el hotel.</div>

            <div class="col-xs-12 tituloCaja resumenCotizacion"><span>Hotel + Aéreo</span>, Mayo 16 a Mayo 19, 3 noches, 4 húespedes</div>

            <div class="col-xs-12">
                <div id="descripcionHotel" class="col-xs-12 col-sm-6 pull-left">
                    <h1 class="tituloHotel">Royal Decameron Golf, Beach Resort & Villas</h1>
                    <div class="direccionHotel"><i class="fa fa-location-arrow"></i>Avenida principal Farallón, Km.115, Carretera Interamericana</div>
                    <div class="destinoHotel"><i class="fa fa-map-marker"></i>Farallón, Panamá</div>
                    <div class="telefonoHotel"><i class="fa fa-phone"></i>Teléfono: +507 993 2255</div>
                </div>
                <div id="descripcionSeccion" class="col-xs-12 col-sm-6 pull-right">
                    <div class="precioAnterior">Antes: <span>$3'648.800</span></div>
                    <div class="precioDestacado">
                        <div>$3'118.405</div>
                        <div>
                            <label for="reservarHotel" class="hidden">Reservar</label>
                            <button type="submit" class="btn btn-default botonReservar" id="reservarHotel">Reservar <i class="fa fa-check"></i></button>
                        </div>
                    </div>

                    <div class="nombreHabitacion">Habitación Estándar</div> - <div class="nombrePlan">Plan Todo Incluido</div>
                    <div class="nombrePromocion"><i class="fa fa-tags"></i>Promoción Noche Gratis</div>
                </div>
            </div>
            <div class="col-xs-12 galleryWrapper">
                <!--<img style="width:100%;" src="images/gallery-example.jpg">-->
            </div>

            <div class="col-xs-12 seccionBlanca" id="contBookingEngine">
                <form role="form" id="frm_hotel" name="frm_hotel" method="POST" action="<?php echo SUBMIT_LIQUIDACION; ?>">
                    <div data-error="hotel" class="error_hotel errorAlert" style="display: none;"><?php echo $this->classHW->decodificarInfo($this->classHW->ucname($textosCargar["LBL_CAMPO_OBLIGATORIO"])); ?></div>
                    <?php echo $hiddens; ?>
                    <input id="hotel" name="hotel" type="hidden" value="<?php echo $this->requestMethod["hotel"]; ?>" />
                    <input id="ciudadHotelOrigen" name="ciudadHotelOrigen" type="hidden" data-ciudad="required" />	
                    <input id="origenCompHotel" name="origenCompHotel" type="hidden" data-ciudad="required" />	
                    <input id="processLiq" name="processLiq" type="hidden" value="" />
                    <input id="ctrAereo" name="ctrAereo" type="hidden" data-plane="A" data-verificar="ciudadAereoOrigen" data-evaluar="origenCompAereo" data-event="ctrAereo" class="ctrTransporte" />
                    <input id="ctrTerr" name="ctrTerr" type="hidden" data-plane="T" data-event="ctrTerr" class="ctrTransporte" />
                    <input class="plHotel" id="plane" name="plane" type="hidden" value="<?php echo (isset($this->requestMethod["plane"])) ? $this->requestMethod["plane"] : NULL; ?>" />
                    <input id="componente" name="componente" type="hidden" value="Hotel" />
                    <input id="sigPais" name="sigPais" type="hidden" value="<?php echo $this->codigo_pais; ?>" />
                    <input id="idioma" name="idioma" type="hidden" value="<?php echo $this->idiomaStr; ?>" />
                    <input id="codPais" name="codPais" type="hidden" value="<?php echo $cod_pais; ?>" />	
                    <input id="hab1ninosHotel" name="hab1ninos" type="hidden" value="<?php echo (isset($this->requestMethod["hab1ninos"])) ? $this->requestMethod["hab1ninos"] : 0; ?>" />	
                    <input id="hab2ninosHotel" name="hab2ninos" type="hidden" value="<?php echo (isset($this->requestMethod["hab2ninos"])) ? $this->requestMethod["hab2ninos"] : 0; ?>" />	
                    <input id="hab3ninosHotel" name="hab3ninos" type="hidden" value="<?php echo (isset($this->requestMethod["hab3ninos"])) ? $this->requestMethod["hab3ninos"] : 0; ?>" />	
                    <input id="hab1infantesHotel" name="hab1infantes" type="hidden" value="<?php echo (isset($this->requestMethod["hab1infantes"])) ? $this->requestMethod["hab1infantes"] : 0; ?>" />	
                    <input id="hab2infantesHotel" name="hab2infantes" type="hidden" value="<?php echo (isset($this->requestMethod["hab2infantes"])) ? $this->requestMethod["hab2infantes"] : 0; ?>" />
                    <input id="hab3infantesHotel" name="hab3infantes" type="hidden" value="<?php echo (isset($this->requestMethod["hab3infantes"])) ? $this->requestMethod["hab3infantes"] : 0; ?>" />
                    <input id="fechaEntradaf" name="fechaEntradaf" class="fechaEntradaf" type="hidden" value="<?php echo $this->requestMethod["fechaEntradaf"]; ?>" />	
                    <input id="fechaSalidaf" name="fechaSalidaf" class="fechaSalidaf" type="hidden" value="<?php echo $this->requestMethod["fechaSalidaf"]; ?>" />	
                    <input id="fechaEntradaAdicionalf" name="fechaEntradaAdicionalf" class="fechaEntradaAdicionalf" type="hidden" value="<?php echo $this->requestMethod["fechaEntradaAdicionalf"]; ?>" />	
                    <input id="fechaSalidaAdicionalf" name="fechaSalidaAdicionalf" class="fechaSalidaAdicionalf" type="hidden" value="<?php echo $this->requestMethod["fechaSalidaAdicionalf"]; ?>" />
                    <input id="dataLiq" name="dataLiq" class="dataLiq" type="hidden" value="<?php echo htmlspecialchars(urlencode(base64_encode(serialize($liquidacionesLimpias)))); ?>" />
                    <input id="dataReq" name="dataReq" class="dataReq" type="hidden" value="<?php echo htmlspecialchars(urlencode(base64_encode(serialize($this->requestMethod)))); ?>" />

                    <div class="form-group gruposBooking contCalendario col-xs-12 col-sm-6">
                        <div class="form-group gruposBooking col-xs-12 col-sm-6">
                            <label for="entradaCompHotel1"><?php echo $this->classHW->decodificarInfo($this->classHW->ucname($textosCargar["LBL_FECHA_ENTRADA"])); ?></label>
                            <div class="inputWrapper">
                                <span class="iconInput"><i class="fa fa-calendar"></i></span>
                                <input type="text" class="form-control datePickerEs" id="entradaCompHotel1" onkeydown="return false;" name="fechaEntrada" value="">
                            </div>
                        </div>
                        <div class="form-group gruposBooking col-xs-12 col-sm-6">
                            <label for="salidaCompHotel1"><?php echo $this->classHW->decodificarInfo($this->classHW->ucname($textosCargar["LBL_FECHA_SALIDA"])); ?></label>
                            <div class="inputWrapper">
                                <span class="iconInput"><i class="fa fa-calendar"></i></span>
                                <input type="text" class="form-control datePickerEs" id="salidaCompHotel1" onkeydown="return false;" name="fechaSalida" value="">
                            </div>
                        </div>
                    </div>

                    <div class="form-group gruposBooking col-xs-12 col-sm-4">

                        <div class="form-group gruposBooking gruposPadding col-xs-3">
                            <label for="nochesCompHotel1"><?php echo $this->classHW->decodificarInfo($this->classHW->ucname($textosCargar["LBL_NOCHES"])); ?></label>
                            <div class="inputWrapper">
                                <span class="iconInput"><i class="fa fa-moon-o"></i></span>
                                <input type="text" readonly class="form-control" id="nochesCompHotel1" name="numNoches" value="<?php echo (isset($this->requestMethod["numNoches"])) ? $this->requestMethod["numNoches"] : NULL; ?>">
                            </div>
                        </div>

                        <div class="form-group gruposBooking contDerecho col-xs-4">
                            <label for="salida"><?php echo $this->classHW->decodificarInfo($this->classHW->ucname($textosCargar["LBL_HABITACIONES"])); ?></label>
                            <div class="btn-group btn-group-select-num" id="botonHabHotel" data-toggle="buttons">
                                <label class="btn btnHabitaciones active"><input type="radio" name="numHabHotel" class="numHabHotel" id="numHabHotel1" value="1">1</label>
                                <label class="btn btnHabitaciones "><input type="radio" name="numHabHotel" class="numHabHotel" id="numHabHotel2" value="2">2</label>
                                <label class="btn btnHabitaciones "><input type="radio" name="numHabHotel" class="numHabHotel" id="numHabHotel3" value="3">3</label>
                            </div>
                        </div>

                        <div id="divPlanCombinadoHotel" class="form-group gruposBooking contDerecho elegirCombinar col-xs-5">
                            <label for="combinarHotel"><?php echo $this->classHW->decodificarInfo($this->classHW->ucname($textosCargar["LBL_COMBINAR"])); ?>  <a id="tooltipCombinadoHotel" href="#" data-toggle="tooltip" data-placement="bottom" data-container="body" title="Al seleccionar esta opción puedes combinar tu viaje con otro hotel cercano."><i style="color:#ed8323;" class="fa fa-question-circle"></i></a></label>
                            <div class="checkbox">
                                <label><input type="checkbox" value="1" id="combinarHotel" name="combinarHotel"><?php echo $this->classHW->decodificarInfo($this->classHW->ucname($textosCargar["LBL_OTRO_HOTEL"])); ?></label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group gruposBooking planCombinadoHotel segHotel col-sm-4 col-xs-12">
                        <label for="hotelCompHotel2"><?php echo $this->classHW->decodificarInfo($this->classHW->ucname($textosCargar["LBL_HOTEL"])); ?></label>
                        <div class="inputWrapper">
                            <span class="iconInput"><i class="fa fa-building-o"></i></span>
                            <select name="hotelAdicional" class="form-control selectpicker hotel-adicional" id="hotelCompHotel2" data-live-search="true" data-container="body" title="Selecciona tu hotel favorito">
                                <!--ACA VA DINAMICAMENTE DEPENDIENDO EL HOTEL-->
                            </select>
                        </div>
                    </div>

                    <div class="form-group gruposBooking planCombinadoHotel contCalendario col-sm-6 col-xs-12">
                        <div class="form-group gruposBooking col-sm-6 col-xs-12">
                            <label for="entradaCompHotel2"><?php echo $this->classHW->decodificarInfo($this->classHW->ucname($textosCargar["LBL_FECHA_ENTRADA"])); ?></label>
                            <div class="inputWrapper">
                                <span class="iconInput"><i class="fa fa-calendar"></i></span>
                                <input type="text" class="form-control datePickerEs hotel-adicional" id="entradaCompHotel2" onkeydown="return false;" name="fechaEntradaAdicional" value="">
                            </div>
                        </div>
                        <div class="form-group gruposBooking col-sm-6 col-xs-12">
                            <label for="salidaCompHotel2"><?php echo $this->classHW->decodificarInfo($this->classHW->ucname($textosCargar["LBL_FECHA_SALIDA"])); ?></label>
                            <div class="inputWrapper">
                                <span class="iconInput"><i class="fa fa-calendar"></i></span>
                                <input type="text" class="form-control datePickerEs hotel-adicional" id="salidaCompHotel2" onkeydown="return false;" name="fechaSalidaAdicional" value="">
                            </div>
                        </div>
                    </div>

                    <div class="form-group gruposBooking planCombinadoHotel contDerecho col-sm-2 col-xs-3">
                        <label for="nochesCompHotel2"><?php echo $this->classHW->decodificarInfo($this->classHW->ucname($textosCargar["LBL_NOCHES"])); ?></label>
                        <div class="inputWrapper">
                            <span class="iconInput"><i class="fa fa-moon-o"></i></span>
                            <input type="text" readonly class="form-control hotel-adicional" id="nochesCompHotel2" name="numNochesAdicional" value="<?php echo (isset($this->requestMethod["numNochesAdicional"])) ? $this->requestMethod["numNochesAdicional"] : NULL; ?>">
                        </div>
                    </div>

                    <div id="habitacionesUpdateWrapper" class="form-group gruposBooking contDerecho col-xs-12">

                        <div id="navHabitacionesHotel">

                            <!-- Tab Navigation Menu -->
                            <ul>
                                <li id="hab1Hotel" data-link="hab1" data-habitacion="1"><a><i class="fa fa-bed"></i><span class="tituloTabBooking"><?php echo $this->classHW->decodificarInfo($this->classHW->ucname($textosCargar["LBL_HABITACION"])); ?> 1</span></a></li>
                                <li id="hab2Hotel" data-link="hab2" data-habitacion="2"><a><i class="fa fa-bed"></i><span class="tituloTabBooking"><?php echo $this->classHW->decodificarInfo($this->classHW->ucname($textosCargar["LBL_HABITACION"])); ?> 2</span></a></li>
                                <li id="hab3Hotel" data-link="hab3" data-habitacion="3"><a><i class="fa fa-bed"></i><span class="tituloTabBooking"><?php echo $this->classHW->decodificarInfo($this->classHW->ucname($textosCargar["LBL_HABITACION"])); ?> 3</span></a></li>
                            </ul>

                            <!-- Content container -->
                            <div>

                                <!-- Habitación 1 -->
                                <div>

                                    <div id="hab1HotelAdultos" class="form-group gruposBooking col-sm-2 col-xs-6 incrementalWrapper">
                                        <label for="salida">Adultos</label>
                                        <div>
                                            <button type="button" class="btn incrementalButton" id="restarHotelHab1Adulto">-</button>
                                            <div class="selectWrapper selectNumbers">
                                                <select class="form-control incrementalSelects" id="selectHotelHab1Adultos" name="selectHotelHab1Adultos" >
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
                                        <label for="salida">Niños <a id="tooltipHab1HotelNinyos" href="#" data-toggle="tooltip" data-placement="bottom" data-container="body" title="Se consideran ?Infantes? a los menores de 2 años y ?Niños?, a los menores en edades comprendidas entre los 2 años cumplidos y los 11 años en la fecha de ingreso al hotel, estas tarifas aplican para infantes y niños compartiendo habitación con mínimo dos adultos pagando tarifa de doble, o, un adulto pagando tarifa de sencilla.; A partir de los 12 años se considera adulto y se cobrara como tal. Es indispensable indicar las edades de los niños integrantes de un grupo familiar al solicitar la reserva y la confirmación de los servicios."><i style="color:#ed8323;" class="fa fa-question-circle"></i></a></label>
                                        <div>
                                            <button type="button" class="btn incrementalButton" id="restarHotelHab1Ninyo">-</button>
                                            <div class="selectWrapper selectNumbers">
                                                <select class="form-control incrementalSelects" id="selectHotelHab1Ninyos" name="totalHab1ninyos">
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
                                        <label id="labelHotelHab1Ninyos" for="salida"><?php echo $this->classHW->decodificarInfo($textosCargar["LBL_EDAD_NIN_FECHA_SALIDA"]); ?></label>
                                        <div id="contentHotelHab1EdadNinyos">
                                        </div>
                                    </div>

                                </div>

                                <!-- Habitación 2 -->
                                <div>
                                    <div id="hab2HotelAdultos" class="form-group gruposBooking col-sm-2 col-xs-6 incrementalWrapper">
                                        <label for="salida">Adultos</label>
                                        <div>
                                            <button type="button" class="btn incrementalButton" id="restarHotelHab2Adulto">-</button>
                                            <div class="selectWrapper selectNumbers">
                                                <select class="form-control incrementalSelects" id="selectHotelHab2Adultos" name="selectHotelHab2Adultos">
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
                                        <label for="salida">Niños <a id="tooltipHab2HotelNinyos" href="#" data-toggle="tooltip" data-placement="bottom" data-container="body" title="Se consideran ?Infantes? a los menores de 2 años y ?Niños?, a los menores en edades comprendidas entre los 2 años cumplidos y los 11 años en la fecha de ingreso al hotel, estas tarifas aplican para infantes y niños compartiendo habitación con mínimo dos adultos pagando tarifa de doble, o, un adulto pagando tarifa de sencilla.; A partir de los 12 años se considera adulto y se cobrara como tal. Es indispensable indicar las edades de los niños integrantes de un grupo familiar al solicitar la reserva y la confirmación de los servicios."><i style="color:#ed8323;" class="fa fa-question-circle"></i></a></label>
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
                                        <label id="labelHotelHab2Ninyos" for="salida"><?php echo $this->classHW->decodificarInfo($textosCargar["LBL_EDAD_NIN_FECHA_SALIDA"]); ?></label>
                                        <div id="contentHotelHab2EdadNinyos">
                                        </div>
                                    </div>
                                </div>

                                <!-- Habitación 3 -->
                                <div>
                                    <div id="hab3HotelAdultos" class="form-group gruposBooking col-sm-2 col-xs-6 incrementalWrapper">
                                        <label for="salida">Adultos</label>
                                        <div>
                                            <button type="button" class="btn incrementalButton" id="restarHotelHab3Adulto">-</button>
                                            <div class="selectWrapper selectNumbers">
                                                <select class="form-control incrementalSelects" id="selectHotelHab3Adultos" name="selectHotelHab3Adultos" >
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
                                        <label for="salida">Niños <a id="tooltipHab3HotelNinyos" href="#" data-toggle="tooltip" data-placement="bottom" data-container="body" title="Se consideran ?Infantes? a los menores de 2 años y ?Niños?, a los menores en edades comprendidas entre los 2 años cumplidos y los 11 años en la fecha de ingreso al hotel, estas tarifas aplican para infantes y niños compartiendo habitación con mínimo dos adultos pagando tarifa de doble, o, un adulto pagando tarifa de sencilla.; A partir de los 12 años se considera adulto y se cobrara como tal. Es indispensable indicar las edades de los niños integrantes de un grupo familiar al solicitar la reserva y la confirmación de los servicios."><i style="color:#ed8323;" class="fa fa-question-circle"></i></a></label>
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
                                        <label id="labelHotelHab3Ninyos" for="salida"><?php echo $this->classHW->decodificarInfo($textosCargar["LBL_EDAD_NIN_FECHA_SALIDA"]); ?></label>
                                        <div id="contentHotelHab3EdadNinyos">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group gruposBooking classComponente col-xs-6 col-sm-2">
                        <label class="checkbox-inline"><input type="checkbox" data-event="ctrAereo" class="radio classctrAereo" value="" name="agregarTransporte" id="agregarAereo"><i class="fa fa-plane"></i> Agregar vuelo</label>
                    </div>

                    <div class="form-group gruposBooking classComponente col-xs-6 col-sm-2">
                        <label class="checkbox-inline"><input type="checkbox" data-event="ctrTerr" class="radio classctrTerr" value="" name="agregarTransporte" id="agregarTerrestre"><i class="fa fa-bus"></i> Agregar terrestre</label>
                    </div>

                    <div class="form-group gruposBooking hide classComponente col-xs-12 col-sm-4" id="contOrigenAereo">
                        <div class="inputWrapper">
                            <span class="iconInput"><i class="fa fa-map-marker"></i></span>
                            <input id="ciudadAereoOrigen" name="ciudadAereoOrigen" type="hidden" data-ciudad="required" />	
                            <input data-ignore="required" class="form-control autocompletado" id="origenCompAereo" name="origenCompAereo" type="text" placeholder="¿Cuál es tu ciudad de origen?">
                            <!--<input class="form-control" id="origenAereo" type="text" placeholder="¿Cuál es tu ciudad de origen?">-->
                        </div>
                    </div>

                    <div class="form-group gruposBooking hide classComponente col-xs-12 col-sm-4" id="contOrigenTerrestre">
                        <div class="inputWrapper">
                            <span class="iconInput"><i class="fa fa-map-marker"></i></span>
                            <select name="ciudadTerrestreOrigen" class="form-control selectpicker" id="ciudadTerrestreOrigen" data-live-search="true" data-container="body" title="Selecciona la ciudad de origen">
                                <?php echo $this->classHW->decodificarInfo($partiendoterf); ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group gruposBooking col-xs-5 col-sm-2">
                        <button type="submit" class="btn btn-default col-xs-8" id="actualizarHotel">Actualizar</button>
                    </div>

                </form>
            </div>
            <div class="col-xs-12 tituloCaja alertaNaranja hide"><i class="fa fa-exclamation-circle"></i> Para reservaciones al Hotel Decameron Isla Palma, los vuelos de entrada para los pasajeros que llegan a Cartagena y salen hacía Isla Palma deben arribar antes de 12:00 m. Para las salidas de Cartagena el vuelo no debe programarse antes de 3:00 p.m. El punto de encuentro para el traslado hacia y desde el Hotel Decameron Isla Palma en la Ciudad de Cartagena será LA CONSERJERIA ubicada en la Calle San Pedro Claver # 31-12 Ciudad Amurallada.</div>
            <div class="col-xs-12 tituloCaja"><span>Escoge tu habitación</span></div>
            <div class="col-xs-12 seccionGris filtroHabitaciones">
                <div>Ordenar por:</div>
                <ul class="nav nav-pills">
                    <li class="active"><a class="filtrosClass" data-filtros="1" data-toggle="pill" href="#">Precio</a></li>
                    <li class=""><a class="filtrosClass" data-filtros="2" data-toggle="pill" href="#"><?php echo $this->classHW->decodificarInfo($this->classHW->ucname($textosCargar["LBL_HABITACION"])); ?></a></li>
                    <li class=""><a class="filtrosClass" data-filtros="3" data-toggle="pill" href="#">Promoción</a></li>
                </ul>
            </div>
            <div id="cotizaciones">
                <?php
                echo $htmlHabitacionCotizada;
                ?>
            </div>
        </div>
    </body>
</html>