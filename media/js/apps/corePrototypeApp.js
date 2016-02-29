function App() {}

App.prototype.redimensionar = function () {
    if (typeof parent.reSize == 'function') {
        parent.reSize();
    }
};

App.prototype.jsonTxtMesDias = function (substring) {
    var corte = (typeof substring !== "undefined") ? substring : 50;
    var jsonMeses = '["' + utf8_decode(LBL_ENERO).substr(0, corte) + '","' + utf8_decode(LBL_FEBRERO).substr(0, corte) + '","' + utf8_decode(LBL_MARZO).substr(0, corte) + '","' +
            utf8_decode(LBL_ABRIL).substr(0, corte) + '","' + utf8_decode(LBL_MAYO).substr(0, corte) + '","' + utf8_decode(LBL_JUNIO).substr(0, corte) + '","' +
            utf8_decode(LBL_JULIO).substr(0, corte) + '","' + utf8_decode(LBL_AGOSTO).substr(0, corte) + '","' + utf8_decode(LBL_SEPTIEMBRE).substr(0, corte) + '","' +
            utf8_decode(LBL_OCTUBRE).substr(0, corte) + '","' + utf8_decode(LBL_NOVIEMBRE).substr(0, corte) + '","' + utf8_decode(LBL_DICIEMBRE).substr(0, corte) + '"]';

    var jsonDias = '["' + utf8_decode(LBL_DOMINGO).substr(0, corte) + '","' + utf8_decode(LBL_LUNES).substr(0, corte) + '","' + utf8_decode(LBL_MARTES).substr(0, corte) + '","' +
            utf8_decode(LBL_MIERCOLES).substr(0, corte) + '","' + utf8_decode(LBL_JUEVES).substr(0, corte) + '","' +
            utf8_decode(LBL_VIERNES).substr(0, corte) + '","' + utf8_decode(LBL_SABADO).substr(0, corte) + '"]';

    return  {"MESES": JSON.parse(jsonMeses), "DIAS": JSON.parse(jsonDias)};
};

String.prototype.capitalize = function () {
    return this.charAt(0).toUpperCase() + this.slice(1);
};

App.prototype.componenteActivo = function () {
    if (__app.isDefined("processLiq") === true) {
        return "hotel";
    }
    return jq(".z-active").attr("data-link");
};

App.prototype.habitacionActiva = function () {
    return jq("#navHabitacionesHotel").children("ul").children(".z-active").attr("data-habitacion");
};

App.prototype.cantidadHabitaciones = function () {
    var componente = __app.componenteActivo().capitalize();
    var cant_habitaciones = jq('input:radio[name=numHab' + componente + ']:checked').val();
    var nhab_recorrer = (typeof cant_habitaciones == "undefined") ? 1 : cant_habitaciones;
    return nhab_recorrer;
};

App.prototype.numeroNinyosHabx = function (habitacion) {
    var componente = __app.componenteActivo().capitalize();
    return jq("#select" + componente + "Hab" + habitacion + "Ninyos").val();
};

App.prototype.formHtmlDinamicCantNinHab = function (element, componente, habitacion) {
    __app.htmlEdadNinyos(habitacion, componente);
    __app.reloadEventChangeEdadNinyos(componente);
    __app.reloadRequiredEdadNinyos(componente);
};

App.prototype.reloadRequiredEdadNinyos = function (componente) {
    var nombreForm = componente.toLowerCase();
    var settingsForm = jq('#frm_' + nombreForm).validate().settings;
    settingsForm.ignore = "";
    var maxHabitacion = parseInt(__app.cantidadHabitaciones());
    for (var habitacion = 1; habitacion <= maxHabitacion; habitacion++) {
        var selectHabEdadesNin = 'select' + componente + 'Hab' + habitacion + 'Ninyos';
        var nameSelectHabEdadesNin = 'hab' + habitacion + 'EdadNino';
        var cantidaNinyosHab = jq("#" + selectHabEdadesNin).val();
        var selectHabAdultos = 'select' + componente + 'Hab' + habitacion + 'Adultos';
        for (var ninyo = 1; ninyo <= cantidaNinyosHab; ninyo++) {
            var nameSelectEdadNinyo = nameSelectHabEdadesNin + ninyo;
            eval("settingsForm.rules." + nameSelectEdadNinyo + " = {required: true};");
        }
    }
};

App.prototype.reloadRequiredTwoHotel = function (cargar, componenteSettings) {
    jQuery.each(jq(".hotel-adicional"), function (i, element) {
        var name = jq(element).attr("name");
        if (typeof name !== "undefined") {
            if (cargar === true) {
                eval("componenteSettings.rules." + name + " = {required: true};");
            } else {
                eval("componenteSettings.rules." + name + " = {required: true};");
            }
        }
    });
};

App.prototype.reloadEventChangeEdadNinyos = function (componente) {
    var maxHabitacion = parseInt(__app.cantidadHabitaciones());
    var event;
    for (var habitacion = 1; habitacion <= maxHabitacion; habitacion++) {
        var numNinyosTotales = __app.numeroNinyosHabx(habitacion);
        for (var numNinyo = 1; numNinyo <= numNinyosTotales; numNinyo++) {
            jq('#adicionar' + componente + 'Hab' + habitacion + 'Ninyo' + numNinyo).unbind("click").on('click', {id: habitacion, numNin: numNinyo}, function (e) {
                var selectHab = '#select' + componente + 'Hab' + e.data.id.toString() + 'Ninyos' + e.data.numNin.toString();
                __app.adicionarPax(selectHab, true, 11, true);
            });

            jq('#restar' + componente + 'Hab' + habitacion + 'Ninyo' + numNinyo).unbind("click").on('click', {id: habitacion, numNin: numNinyo}, function (e) {
                var selectHab = '#select' + componente + 'Hab' + e.data.id.toString() + 'Ninyos' + e.data.numNin.toString();
                __app.adicionarPax(selectHab, false, 11, true);
            });
        }
    }

    __app.redimensionar();
    return event;
};

App.prototype.htmlEdadNinyos = function (habitacion, componente) {
    var htmlNinyos = "";
    var cantidadNinyos = parseInt(__app.numeroNinyosHabx(habitacion));
    if (cantidadNinyos > 0) {
        htmlNinyos = '<div id="content' + componente + 'Hab' + habitacion + 'EdadNinyos">';
        for (var i = 1; i <= cantidadNinyos; i++) {
            htmlNinyos = htmlNinyos + '<div class="form-group gruposBooking col-sm-3 col-xs-6" id="ninyo' + componente + 'Hab' + habitacion + '-' + i + '">' +
                    '<button type="button" class="btn incrementalButton" id="restar' + componente + 'Hab' + habitacion + 'Ninyo' + i + '">-</button>' +
                    '<div class="selectWrapper selectNumbers">' +
                    '<select name="hab' + habitacion + 'EdadNino' + i + '" onChange="__app.calcularEdadNynios(this,' + habitacion + ',' + i + ');" data-valihab="' + habitacion + '" class="form-control incrementalSelects verificaco" id="select' + componente + 'Hab' + habitacion + 'Ninyos' + i + '" name="select' + componente + 'Hab' + habitacion + 'Ninyos' + i + '" >' +
                    '<option disabled selected>-</option>' +
                    '<option value="0">< 1</option>' +
                    '<option value="1">1</option>' +
                    '<option value="2">2</option>' +
                    '<option value="3">3</option>' +
                    '<option value="4">4</option>' +
                    '<option value="5">5</option>' +
                    '<option value="6">6</option>' +
                    '<option value="7">7</option>' +
                    '<option value="8">8</option>' +
                    '<option value="9">9</option>' +
                    '<option value="10">10</option>' +
                    '<option value="11">11</option>' +
                    '</select>' +
                    '</div>' +
                    '<button type="button" class="btn incrementalButton" id="adicionar' + componente + 'Hab' + habitacion + 'Ninyo' + i + '">+</button>' +
                    '</div>';
        }
        htmlNinyos = htmlNinyos + "</div>";
        jq('#cont' + componente + 'Hab' + habitacion + 'EdadNinyos').css("display", "inline-block");
    } else {
        jq('#cont' + componente + 'Hab' + habitacion + 'EdadNinyos').css("display", "none");
    }

    jq("#content" + componente + "Hab" + habitacion + "EdadNinyos").html(htmlNinyos);
    return;
};

App.prototype.eventoForTab = function () {
    jq("#tabHotel").on("click", function () {
        var comActual = jq(this).attr("data-link").capitalize();
        var comProviene = __app.componenteActivo().capitalize();
        __app.initEventForm(comActual, comProviene);
        jq(".error_" + jq(this).attr("data-link")).hide();
        jq("#origenComp" + comActual).val(jq("#origenComp" + comProviene).val());
        __app.searchAutocompletado(null, jq("#origenComp" + comProviene).val(), null, comActual);
    });

    jq("#tabAereo").on("click", function () {
        var comActual = jq(this).attr("data-link").capitalize();
        var comProviene = __app.componenteActivo().capitalize();
        __app.initEventForm(comActual, comProviene);
        jq(".error_" + jq(this).attr("data-link")).hide();
        jq("#origenComp" + comActual).val(jq("#origenComp" + comProviene).val());
        __app.searchAutocompletado(null, jq("#origenComp" + comProviene).val(), null, comActual);
    });

    jq("#tabTerrestre").on("click", function () {
        var comActual = jq(this).attr("data-link").capitalize();
        var comProviene = __app.componenteActivo().capitalize();
        __app.initEventForm(comActual, comProviene);
        jq(".error_" + jq(this).attr("data-link")).hide();
        jq("#ciudad" + comActual + "Origen").val(jq("#ciudad" + comProviene + "Origen")).trigger('change');
    });
};

App.prototype.cargarEdadesHabitaciones = function (componente, componenteProviene, habitacion) {
    var cantidadNinHabitacion = __app.numeroNinyosHabx(habitacion);
    for (var ninyo = 1; ninyo <= cantidadNinHabitacion; ninyo++) {
        var vlrNinyo = jq('#select' + componenteProviene + 'Hab' + habitacion + 'Ninyos' + ninyo).val();
        jq('#select' + componente + 'Hab' + habitacion + 'Ninyos' + ninyo).val(vlrNinyo).trigger('change');
    }
};

App.prototype.initEventForm = function (componenteActual, componenteProviene) {
    var componente = (typeof componenteActual !== "undefined") ? componenteActual : __app.componenteActivo().capitalize();
    var cantHabitaciones = parseInt(__app.cantidadHabitaciones());

    for (var habitacion = 1; habitacion <= cantHabitaciones; habitacion++) {
        /* Cuando Proviene de un componente diferente con el fin que no se pierdan los datos de las habitaciones ya ingresada anteriormente */
        if (typeof componenteProviene !== "undefined") {
            jq('#select' + componente + 'Hab' + habitacion + 'Ninyos').val(jq('#select' + componenteProviene + 'Hab' + habitacion + 'Ninyos').val()).trigger('change');
            __app.formHtmlDinamicCantNinHab(jq('#select' + componente + 'Hab' + habitacion + 'Ninyos'), componente, habitacion);
            __app.cargarEdadesHabitaciones(componente, componenteProviene, habitacion);
            jq('#select' + componente + 'Hab' + habitacion + 'Adultos').val(jq('#select' + componenteProviene + 'Hab' + habitacion + 'Adultos').val()).trigger('change');
        }

        /* ------------ Inicializar Variables Dependiendo el componente ------------ */
        jq('#adicionar' + componente + 'Hab' + habitacion + 'Adulto').unbind("click").on('click', {id: habitacion, componente: componente}, function (e) {
            var selectHab = '#select' + e.data.componente.toString() + 'Hab' + e.data.id.toString() + 'Adultos';
            __app.adicionarPax(selectHab, true, __app.cantidadAdulNinHab().NUM_ADULTOS);
        });

        jq('#restar' + componente + 'Hab' + habitacion + 'Adulto').unbind("click").on('click', {id: habitacion, componente: componente}, function (e) {
            var selectHab = '#select' + e.data.componente.toString() + 'Hab' + e.data.id.toString() + 'Adultos';
            __app.adicionarPax(selectHab, false, __app.cantidadAdulNinHab().NUM_ADULTOS);
        });

        jq('#adicionar' + componente + 'Hab' + habitacion + 'Ninyo').unbind("click").on('click', {id: habitacion, componente: componente}, function (e) {
            var selectHab = '#select' + e.data.componente.toString() + 'Hab' + e.data.id.toString() + 'Ninyos';
            __app.adicionarPax(selectHab, true, __app.cantidadAdulNinHab().NUM_NIN_INF);
        });

        jq('#restar' + componente + 'Hab' + habitacion + 'Ninyo').unbind("click").on('click', {id: habitacion, componente: componente}, function (e) {
            var selectHab = '#select' + e.data.componente.toString() + 'Hab' + e.data.id.toString() + 'Ninyos';
            __app.adicionarPax(selectHab, false, __app.cantidadAdulNinHab().NUM_NIN_INF);
        });

        var cantidadNinyos = parseInt(__app.numeroNinyosHabx(habitacion));
        if (cantidadNinyos === 0 || __app.isNumeric(cantidadNinyos) == false) {
            jq('#cont' + componente + 'Hab' + habitacion + 'EdadNinyos').css("display", "none");
        }

        jq('#select' + componente + 'Hab' + habitacion + 'Ninyos').on('change', {id: habitacion, componente: componente}, function (e) {
            __app.formHtmlDinamicCantNinHab(this, e.data.componente.toString(), e.data.id.toString());
            __app.verificarCantidadPaxHab(true);
        });

        jq('#select' + componente + 'Hab' + habitacion + 'Adultos').on('change', {id: habitacion}, function (e) {
            __app.verificarCantidadPaxHab(true);
        });
    }
};

App.prototype.isNumeric = function (variable) {
    return !isNaN(parseFloat(variable)) && isFinite(variable);
};

App.prototype.validaHotelCombinados = function (hotel) {
    var componente = __app.componenteActivo();
    jq("#divPlanCombinado" + componente.capitalize()).hide();
    var str = jq('#frm_' + componente).serializeArray();
    str.push({name: 'action', value: 'validaCombinaciones'});
    console.log(str);

    jq.ajax({
//        url: DIRECTORIO_RAIZ + "/web_pagGDS/liquidacion.php",
        url: "answerSettlement.php",
        async: false,
        data: str,
        contentType: "application/x-www-form-urlencoded",
        dataType: "json", //xml,html,script,json
        error: function () {
            alert("Ha ocurrido un error");
        },
        ifModified: false,
        processData: true,
        success: function (datas) {
            jq(".classComponente").show();
            jq(".planCombinadoHotel" + componente.capitalize()).hide();
            jq(".planCombinado").hide();
            if (datas.verifica != null) {
                jq(".classComponente").hide();
                jq("#divPlanCombinado" + componente.capitalize()).show();
                jq(".planCombinadoHotel" + componente.capitalize()).show();
                jq("#hotelComp" + componente.capitalize() + "2").html(datas.hotelesTwo);
                jq('.selectpicker').selectpicker('refresh');
            }
        },
        type: "POST",
        timeout: 3000

    });

    var cantidad = __app.cantidadAdulNinHab();
    __app.adicionHtmlAdultosNyniosSelect(cantidad.NUM_ADULTOS, cantidad.NUM_NIN_INF);
    __app.initEventForm();
};

App.prototype.submitForm = function (settings) {
    settings.submitHandler = function (form) {
        var componente = __app.componenteActivo();
        jq(".error_" + componente).hide();
        var nameForm = jq(form).attr("name");
        jq("#frm_" + componente).find('input.datePickerEs').each(function () {
            var campoHidden = jq(this).attr("name") + "f";
            var dateFormat = new Date(Date.parse(jq(this).datepicker('getDate')));
            var dateFormat = jq.datepicker.formatDate('yy-mm-dd', dateFormat);
            jq("." + campoHidden).val(dateFormat);
        });

        if (__app.isDefined("processLiq") === true) {
            if (__app.beforeSubmitComponente() === true) {
                eval("document." + nameForm + ".submit();");
            }
        } else {
            eval("document." + nameForm + ".submit();");
        }
        return false;
    };
};


App.prototype.beforeSubmitComponente = function () {
    if (jq("#ctrAereo").val() != "" || jq("#ctrTerr").val() != "") {
        var controlTransporte = jq('input[name=agregarTransporte]:checked').attr("data-event");
        var campoEvaluar = jq("#" + controlTransporte).attr("data-evaluar");
        var campoVerificar = jq("#" + controlTransporte).attr("data-verificar");
        var plane = jq("#" + controlTransporte).attr("data-plane");

        // Si es diferente es porq proviene de aereo
        if (typeof campoEvaluar !== "undefined") {
            __app.searchAutocompletado(null, jq("#" + campoEvaluar).val());
            if (jq("#" + campoVerificar).val() !== "") {
                //Recargo variables para liquidar
                jq("#plane").val(plane);
                jq("#ciudadHotelOrigen").val(jq("#" + campoVerificar).val());
                jq("#origenCompHotel").val(jq("#" + campoEvaluar).val());
            } else {
                var componente = __app.componenteActivo();
                jq(".error_" + componente).html(utf8_decode("paila no selecciono una ciudad de origen valida")).show("fash");
                return false;
            }
        } else {
            jq("#plane").val(plane);
            jq("#ciudadHotelOrigen").val(jq("#ciudadTerrestreOrigen").val());
            jq("#origenCompHotel").val("");
        }
    } else {
        jq("#plane").val("H");

    }
    return true;
};

App.prototype.alertErroresValidacion = function (settings) {

    settings.unhighlight = function (element, errorClass, validClass) {
        var ignorarSuccess = jq(element).attr("data-ignore");
        if (typeof ignorarSuccess === "undefined") {
            jq(element).removeAttr("style");
            jq(element).parent("div").children("button").removeAttr("style");
            var ciudadOrigen = jq(element).attr("data-ciudad");
            if (typeof ciudadOrigen !== "undefined") {
                jq(element).siblings("input").removeAttr("style");
            }
        }
        __app.redimensionar();
//        console.log("paso => " + jq(element).attr("name"));
    };

    settings.errorPlacement = function (error, element) {
//        console.log("error => " + jq(element).attr("name")+" valor = "+jq(element).val());
        var componente = __app.componenteActivo();
        jq(".error_" + componente).html(utf8_decode(LBL_CAMPO_OBLIGATORIO)).show("fash");
        jq(element).css({"border-color": "#CC0000"});
        jq(element).parent("div").children("button").css({"border-color": "#CC0000"});

        /* Cuando existen los tab de habitaciones */
        var tabHabitacion = jq(element).attr("data-valihab");
        if (typeof tabHabitacion !== "undefined") {
            jq(element).parents("div#navHabitaciones" + componente.capitalize()).find("li#hab" + tabHabitacion + componente.capitalize()).find("a").css({"color": "#CC0000"});
        }

        var ciudadOrigen = jq(element).attr("data-ciudad");
        if (typeof ciudadOrigen !== "undefined") {
            jq(element).siblings("input").css({"border-color": "#CC0000"});
        }

        var temporizador = setInterval(function () {
            __app.redimensionar();
        }, 1);

        setTimeout(function () {
            clearInterval(temporizador);
        }, 500);
    };

    settings.success = function (label, element) {
//        console.log("me fui");
    };
};

App.prototype.validacionComunComponentes = function (settings, componente) {
    settings.ignore = "";
    if (__app.isDefined("processLiq") !== true) {
        eval("settings.rules.origenComp" + componente + " = {required: true};");
    }
    eval("settings.rules.ciudad" + componente + "Origen = {required: true};");
    settings.rules.ciudadOrigen = {required: true};
    settings.rules.hotel = {required: true};
    settings.rules.fechaEntrada = {required: true};
    settings.rules.fechaSalida = {required: true};
    settings.rules.selectHotelHab1Adultos = {required: true};
};

App.prototype.adicionarPax = function (selectId, tipoIncremento, valorMax, edades) {
    var numPax = jq(selectId).val();
    if (numPax === "") {
        numPax = "0";
    }
    if (tipoIncremento) {
        if (numPax == valorMax) {
            return;
        }
        switch (numPax) {
            case null:
                jq(selectId).val('0').trigger('change');
                break;
            case '0':
                jq(selectId).val('1').trigger('change');
                break;
            case '1':
                jq(selectId).val('2').trigger('change');
                break;
            case '2':
                jq(selectId).val('3').trigger('change');
                break;
            case '3':
                jq(selectId).val('4').trigger('change');
                break;
            case '4':
                jq(selectId).val('5').trigger('change');
                break;
            case '5':
                jq(selectId).val('6').trigger('change');
                break;
            case '6':
                jq(selectId).val('7').trigger('change');
                break;
            case '7':
                jq(selectId).val('8').trigger('change');
                break;
            case '8':
                jq(selectId).val('9').trigger('change');
                break;
            case '9':
                jq(selectId).val('10').trigger('change');
                break;
            case '10':
                jq(selectId).val('11').trigger('change');
                break;
        }
    } else {
        if (numPax == 0) {
            return;
        }
        switch (numPax) {
            case null:
                if (edades === true) {
                    jq(selectId).val('0').trigger('change');
                } else {
                    jq(selectId).val('').trigger('change');
                }
                break;
            case '1':
                if (edades === true) {
                    jq(selectId).val('0').trigger('change');
                } else {
                    jq(selectId).val('').trigger('change');
                }
                break;
            case '2':
                jq(selectId).val('1').trigger('change');
                break;
            case '3':
                jq(selectId).val('2').trigger('change');
                break;
            case '4':
                jq(selectId).val('3').trigger('change');
                break;
            case '5':
                jq(selectId).val('4').trigger('change');
                break;
            case '6':
                jq(selectId).val('5').trigger('change');
                break;
            case '7':
                jq(selectId).val('6').trigger('change');
                break;
            case '8':
                jq(selectId).val('7').trigger('change');
                break;
            case '9':
                jq(selectId).val('8').trigger('change');
                break;
            case '10':
                jq(selectId).val('9').trigger('change');
                break;
            case '11':
                jq(selectId).val('10').trigger('change');
                break;
        }
    }
};

App.prototype.buscarIndiceAuto = function (array, data) {
    var indice;
    var i = 0;
    var enc = false;
    while (i < array.length && !enc) {
        if (array[i] == data) {
            enc = true;
            indice = i;
        }
        i++;
    }

    return indice;
};

App.prototype.searchAutocompletado = function (event, data, value, componenteActual) {
    var componente = (typeof componenteActual !== "undefined") ? componenteActual : __app.componenteActivo().capitalize();
    var indiceEncontrado;
    var valueCiudad;
    var ciudades = {"Hotel": cities, "Aereo": citiesAer};
    var valoresCiudades = {"Hotel": valores, "Aereo": valoresAer}

    indiceEncontrado = __app.buscarIndiceAuto(eval("ciudades." + componente), data);
    valueCiudad = eval("valoresCiudades." + componente + "[" + indiceEncontrado + "]");

    if (typeof valueCiudad != "undefined") {
        if (__app.isDefined("processLiq") === true) {
            jq("#ciudadAereoOrigen").val(html_entity_decode(valueCiudad));
        } else {
            jq("#ciudad" + componente + "Origen").val(html_entity_decode(valueCiudad));
        }
    } else {
        if (__app.isDefined("processLiq") === true) {
            jq("#ciudadAereoOrigen").val("");
        } else {
            jq("#ciudad" + componente + "Origen").val("");
        }
    }
};

App.prototype.htmlSelectOptions = function (num, select) {
    var options;
    for (var i = 0; i <= num; i++) {
        var selectComplemento = "";
        if (i == select) {
            selectComplemento = "selected";
        }

        var value = (i == 0) ? "" : i;
        options = options + '<option value="' + value + '" ' + selectComplemento + '>' + i + '</option>';
    }
    return options;
};

App.prototype.isDefined = function (variable) {
    return (typeof (window[variable]) == "undefined") ? false : true;
};

App.prototype.adicionHtmlAdultosNyniosSelect = function (num_adultos, num_nin_inf) {
    var nhab_recorrer = __app.cantidadHabitaciones();
    var componente = __app.componenteActivo().capitalize();
    for (var i = 1; i <= nhab_recorrer; i++) {
        jq("#select" + componente + "Hab" + i + "Adultos").html(__app.htmlSelectOptions(num_adultos, 2));
        jq("#select" + componente + "Hab" + i + "Ninyos").html(__app.htmlSelectOptions(num_nin_inf, 0));
        jq("#cont" + componente + "Hab" + i + "EdadNinyos").css("display", "none");
        jq("#content" + componente + "Hab" + i + "EdadNinyos").html("");
    }

};

App.prototype.calcularEdadNynios = function (edad, nhab, numNin) {
    /*
     *CREO LA MATRIZ PARA PODER UTILIZARLA EN LOS PROCESOS DE VALIDACION DE LAS EDAD (INFANTES Y NIÑOS)
     **/
    var componente = __app.componenteActivo().capitalize();
    var cantidadNinyos = __app.cantidadAdulNinHab();
    var matriz = new Array(3);
    for (var numHab = 1; numHab <= __app.cantidadHabitaciones(); numHab++) {
        matriz[numHab] = new Array(cantidadNinyos.NUM_NIN_INF);
    }

    for (var numHab = 1; numHab <= __app.cantidadHabitaciones(); numHab++) {
        for (var ninyo = 1; ninyo <= cantidadNinyos.NUM_NIN_INF; ninyo++) {
            var datoEdad = jq("#select" + componente + "Hab" + numHab + "Ninyos" + ninyo).val();
            datoEdad = (typeof datoEdad === "undefined") ? null : datoEdad;
            matriz[numHab][ninyo] = datoEdad;
        }
        jq('#hab' + numHab + 'ninos' + componente).val(0);
        jq('#hab' + numHab + 'infantes' + componente).val(0);
    }
    __app.sumaEdades(matriz);
};

App.prototype.sumaEdades = function (matriz) {
    var cantidadNinyos = __app.cantidadAdulNinHab();
    var componente = __app.componenteActivo().capitalize();
    for (var numHab = 1; numHab <= __app.cantidadHabitaciones(); numHab++) {
        var infante = 0;
        var nino = 0;
        for (var ninyo = 1; ninyo <= cantidadNinyos.NUM_NIN_INF; ninyo++) {
            if (matriz[numHab][ninyo] !== null && matriz[numHab][ninyo] < 2) {
                infante = infante + 1;
                jq('#hab' + numHab + 'infantes' + componente).val(infante);
            } else {
                if (matriz[numHab][ninyo] !== null && matriz[numHab][ninyo] >= 2) {
                    nino = nino + 1;
                    jq('#hab' + numHab + 'ninos' + componente).val(nino);
                }
            }
        }
    }

    __app.verificarCantidadPaxHab();
};

App.prototype.constanteHotelAcomodacion = function (componente, numeroHotel) {
    if (typeof numeroHotel === "undefined") {
        numeroHotel = "1";
    }
    var constante_hotel = null;
    var hotel = jq("#hotelComp" + componente + numeroHotel).val();
    if (typeof hotel !== "undefined") {
        var split_hotel = hotel.split("|");
        if (__app.isDefined("HOTEL_" + split_hotel[4])) {
            constante_hotel = eval("HOTEL_" + split_hotel[4]);
            return constante_hotel;
        }
    }

    return constante_hotel;
};

App.prototype.cantidadAdulNinHab = function (tipoHab) {
    var num_adultos = 4;
    var num_nin_inf = 4;
    var componente = __app.componenteActivo().capitalize();
    var constante_hotel = __app.constanteHotelAcomodacion(componente);

    if (constante_hotel !== null) {
        var obj_acomodacion = (typeof tipoHab == "undefined") ? eval(constante_hotel) : tipoHab;
        num_adultos = obj_acomodacion.MAX_ADT;
        num_nin_inf = (obj_acomodacion.MAX_NIN + obj_acomodacion.MAX_INF);
        num_nin_inf = (obj_acomodacion.MAX_PER < num_nin_inf) ? (obj_acomodacion.MAX_PER - 1) : (num_nin_inf - 1);
    }

    return {"NUM_ADULTOS": num_adultos, "NUM_NIN_INF": num_nin_inf};
};

App.prototype.verificarCantidadPaxHab = function (validacionGlobal) {
    var componente = __app.componenteActivo().capitalize();
    var cant_hoteles = ["1", "2"];
    var msj_hotel = [];
    var msj_alert = "";

    if (!(__app.isDefined("hotelAdicional")) || jq("#hotelAdicional").val() == "") {
        cant_hoteles.pop();
    }

    for (var key = 0; key < cant_hoteles.length; key++) {
        var constante_hotel = __app.constanteHotelAcomodacion(componente, cant_hoteles[key]);
        if (constante_hotel !== null) {
            var split_hotel = jq("#hotelComp" + componente + cant_hoteles[key]).val().split("|");
            msj_hotel[key] = utf8_decode(LBL_HOTEL) + " (" + split_hotel[5] + ")";
            // TIPOS DE PAX QUE SUMAN A LA ACOMODACION
            var matriz_pax_suma_acom = [];
            var obj_acom = constante_hotel.ACOMODA;
            for (var item in obj_acom) {
                if (obj_acom.hasOwnProperty(item)) {
                    matriz_pax_suma_acom.push(obj_acom[item].TIPO_PAX);
                }
            }

            if (typeof validacionGlobal !== "undefined") {
                var mensaje_pax_alert = utf8_decode(LBL_ADULTOS);
                mensaje_pax_alert = mensaje_pax_alert + ", " + utf8_decode(LBL_NINOS);
                var nhab = __app.habitacionActiva();
                var numAdultos = jq("#select" + componente + "Hab" + nhab + "Adultos").val();
                var validacionTodosPax = __app.validacionSumanTodosAcomodacion(matriz_pax_suma_acom);
                if (validacionTodosPax === true) {
                    var numNinyos = (jq("#select" + componente + "Hab" + nhab + "Ninyos").val() === "") ? 0 : jq("#select" + componente + "Hab" + nhab + "Ninyos").val();
                    var numero_personas_max = parseInt(numNinyos) + parseInt(numAdultos);
                    if (numero_personas_max > constante_hotel.MAX_PER) {
                        msj_alert = msj_alert + utf8_decode(ALERT_NUM_MAX_PERSONA_HAB);
                        msj_alert = html_entity_decode(msj_alert.replace("_hab", nhab));
                        msj_alert = html_entity_decode(msj_alert.replace("_max_per", constante_hotel.MAX_PER));
                        msj_alert = html_entity_decode(msj_alert.replace("_pax_alert", mensaje_pax_alert)) + "<br/>";
                    }
                }
            } else {
                // Validamos acomodaciones por tipo de pax
                var numero_hab_total = __app.cantidadHabitaciones();
                var msj_alert_tmp = "";
                for (var hab = 1; hab <= numero_hab_total; hab++) {
                    var numero_personas_max = 0;
                    var num_adt = __app.valid_suma_acomodacion(58, matriz_pax_suma_acom, "select" + componente + "Hab" + hab + "Adultos");
                    var num_nin = __app.valid_suma_acomodacion(45, matriz_pax_suma_acom, "hab" + hab + "ninosHotel" + componente);
                    var num_inf = __app.valid_suma_acomodacion(70, matriz_pax_suma_acom, "hab" + hab + "infantes" + componente);
                    numero_personas_max = numero_personas_max + num_adt;
                    numero_personas_max = numero_personas_max + num_nin;
                    numero_personas_max = numero_personas_max + num_inf;

                    var mensaje_pax_alert = (num_adt > 0) ? utf8_decode(LBL_ADULTOS) : null;
                    mensaje_pax_alert = (num_nin > 0) ? mensaje_pax_alert + "," + utf8_decode(LBL_NINOS) : mensaje_pax_alert;
                    mensaje_pax_alert = (num_inf > 0) ? mensaje_pax_alert + "," + utf8_decode(LBL_INFANTES) : mensaje_pax_alert;

                    if (__app.isDefined("HOTEL_" + split_hotel[4])) {
                        if (numero_personas_max > constante_hotel.MAX_PER) {
                            msj_alert_tmp = msj_alert_tmp + utf8_decode(ALERT_NUM_MAX_PERSONA_HAB);
                            msj_alert_tmp = html_entity_decode(msj_alert_tmp.replace("_hab", hab));
                            msj_alert_tmp = html_entity_decode(msj_alert_tmp.replace("_max_per", constante_hotel.MAX_PER));
                            msj_alert_tmp = html_entity_decode(msj_alert_tmp.replace("_pax_alert", mensaje_pax_alert)) + "<br/>";
                        }

                        msj_alert_tmp = msj_alert_tmp + __app.valid_cantidad_pax(constante_hotel.MAX_ADT, hab, "select" + componente + "Hab" + hab + "Adultos", utf8_decode(LBL_ADULTOS));
                        msj_alert_tmp = msj_alert_tmp + __app.valid_cantidad_pax(constante_hotel.MAX_NIN, hab, "hab" + hab + "ninosHotel" + componente, utf8_decode(LBL_NINOS));
                        msj_alert_tmp = msj_alert_tmp + __app.valid_cantidad_pax(constante_hotel.MAX_INF, hab, "hab" + hab + "infantes" + componente, utf8_decode(LBL_INFANTES));

                    }
                }

                if (msj_alert_tmp != "") {
                    msj_alert = msj_alert + msj_hotel[key] + "<br/>" + msj_alert_tmp + "<br/>";
                }
            }
        }
    }
    if (msj_alert !== "") {
        jq(".error_" + __app.componenteActivo()).html(msj_alert).show("fash");
    }

};

App.prototype.valid_cantidad_pax = function (cantidad_pax, hab, element, texto) {
    var alert = "";
    if (!isNaN(parseInt(jq("#" + element).val()))) {
        if ((parseInt(jq("#" + element).val()) !== 0) && (parseInt(jq("#" + element).val()) > cantidad_pax)) {
            if (cantidad_pax == -1) {
                alert = utf8_decode(ALERT_NO_ADMITE_PAX_HAB);
                alert = html_entity_decode(alert.replace("_texto", texto));
                alert = html_entity_decode(alert.replace("_hab", hab)) + "<br/>";
            } else {
                alert = utf8_decode(ALERT_MAX_PER_HAB);
                alert = html_entity_decode(alert.replace("_texto", texto));
                alert = html_entity_decode(alert.replace("_cantidad_pax", cantidad_pax));
                alert = html_entity_decode(alert.replace("_hab", hab)) + "<br/>";
            }
        }
    }

    return alert;
};

App.prototype.valid_suma_acomodacion = function (tipo_pax, matriz_pax_suma_acom, element) {
    var numero_personas_max = 0;
    if (jQuery.inArray(tipo_pax, matriz_pax_suma_acom) >= 0) {
        if (!isNaN(parseInt(jq("#" + element).val()))) {
            numero_personas_max = parseInt(jq("#" + element).val());
        }
    }

    return numero_personas_max;
};

App.prototype.validacionSumanTodosAcomodacion = function (acomodacion) {
    var tiposPax = [58, 45, 70];
    var valida = true;
    for (var key = 0; key < tiposPax.length; key++) {
        if (jQuery.inArray(tiposPax[key], acomodacion) < 0) {
            valida = false;
        }
    }

    return valida;
};

App.prototype.loadDatePicker = function () {
    (function (factory) {
        if (typeof define === "function" && define.amd) {

            // AMD. Register as an anonymous module.
            define(["../widgets/datepicker"], factory);
        } else {

            // Browser globals
            factory(jQuery.datepicker);
        }
    }(function (datepicker) {

        var dayMonth = __app.jsonTxtMesDias();
        var dayMonthShort = __app.jsonTxtMesDias(3);
        var dayMonthShortMin = __app.jsonTxtMesDias(2);

        datepicker.regional.es = {
            closeText: "Cerrar",
            prevText: "&#x3C;Ant",
            nextText: "Sig&#x3E;",
            currentText: "Hoy",
            monthNames: dayMonth.MESES,
            monthNamesShort: dayMonthShort.MESES,
            dayNames: dayMonth.DIAS,
            dayNamesShort: dayMonthShort.DIAS,
            dayNamesMin: dayMonthShortMin.DIAS,
            weekHeader: "Sm",
            dateFormat: jq.datepicker.RFC_2822,
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ""};
        datepicker.setDefaults(datepicker.regional.es);

        return datepicker.regional.es;

    }));
};

App.prototype.onSelectDatapicker = function (nombre, componente, nombreSegundoCambio) {
    var componenteAct = __app.componenteActivo().capitalize();
    var fechaSel = jq("#" + nombre + "Comp" + componenteAct + "1").datepicker('getDate');
    var fechaAux = jq("#" + nombre + "Comp" + componenteAct + "1").datepicker('getDate');
    var fechaMax = jq("#" + nombre + "Comp" + componenteAct + "1").datepicker('getDate');
    var fechaMax2 = jq("#" + nombre + "Comp" + componenteAct + "1").datepicker('getDate');

    fechaSel.setDate(fechaSel.getDate() + 1);
    fechaMax.setDate(fechaMax.getDate() + 30);
    fechaMax2.setDate(fechaMax.getDate() + 61);

    jq("#" + nombreSegundoCambio + "Comp" + componenteAct + "1").datepicker("option", "minDate", fechaSel);
    jq("#" + nombreSegundoCambio + "Comp" + componenteAct + "1").datepicker("option", "maxDate", fechaMax);

    jq("#" + nombre + "Comp" + componenteAct + "2").datepicker("option", "minDate", fechaSel);
    jq("#" + nombre + "Comp" + componenteAct + "2").datepicker("option", "maxDate", fechaMax2);

    jq("#" + nombre + "Comp" + componenteAct + "2").datepicker("setDate", fechaSel);

    if (jq("#" + nombreSegundoCambio + "Comp" + componenteAct + "1").val() == '') {
        jq("#" + nombreSegundoCambio + "Comp" + componenteAct + "1").datepicker("setDate", fechaSel);
    }

    fechaAux.setDate(fechaAux.getDate() + 2);

    jq("#" + nombreSegundoCambio + "Comp" + componenteAct + "2").datepicker("option", "minDate", fechaAux);
    jq("#" + nombreSegundoCambio + "Comp" + componenteAct + "2").datepicker("setDate", fechaAux);

    __app.calculoNochesHotel(nombre, componenteAct, nombreSegundoCambio);
    __app.calculoNochesHotelAdicional(nombre, componenteAct, nombreSegundoCambio);
};

App.prototype.detalleDatePickerConfiguracion = function (nombre, componente, nombreSegundoCambio) {
    jq("#" + nombre + "Comp" + componente + "1").datepicker({
        minDate: 2,
        onSelect: function (selected, dateText) {
            __app.onSelectDatapicker(nombre, componente, nombreSegundoCambio);
        }
    });

    jq("#" + nombreSegundoCambio + "Comp" + componente + "1").datepicker({
        minDate: 2,
        onSelect: function (selected, dateText) {
            var componenteAct = __app.componenteActivo().capitalize();
            var fechaSel = jq("#" + nombreSegundoCambio + "Comp" + componenteAct + "1").datepicker('getDate');
            var fechaAux = jq("#" + nombreSegundoCambio + "Comp" + componenteAct + "1").datepicker('getDate');
            var fechaMax = jq("#" + nombreSegundoCambio + "Comp" + componenteAct + "1").datepicker('getDate');
            var fechaAux2 = jq("#" + nombreSegundoCambio + "Comp" + componenteAct + "1").datepicker('getDate');

            jq("#" + nombre + "Comp" + componenteAct + "2").datepicker("option", "minDate", fechaSel);
            jq("#" + nombre + "Comp" + componenteAct + "2").datepicker("setDate", fechaSel);

            fechaAux.setDate(fechaAux.getDate() + 1);
            fechaMax.setDate(fechaMax.getDate() + 30);

            jq("#" + nombreSegundoCambio + "Comp" + componenteAct + "2").datepicker("option", "minDate", fechaAux);
            jq("#" + nombreSegundoCambio + "Comp" + componenteAct + "2").datepicker("option", "maxDate", fechaMax);

            if (jq("#" + nombreSegundoCambio + "Comp" + componenteAct + "2").val() == '') {
                jq("#" + nombreSegundoCambio + "Comp" + componenteAct + "2").datepicker("setDate", fechaAux);
            }

            fechaAux2.setDate(fechaAux2.getDate() - 1);
            if (jq("#" + nombre + "Comp" + componenteAct + "1").val() == '') {
                jq("#" + nombre + "Comp" + componenteAct + "1").datepicker("setDate", fechaAux2);
            }

            __app.calculoNochesHotel(nombre, componenteAct, nombreSegundoCambio);
            __app.calculoNochesHotelAdicional(nombre, componenteAct, nombreSegundoCambio);
        }
    });

    jq("#" + nombre + "Comp" + componente + "2").datepicker({
        minDate: 2,
        onSelect: function (selected, dateText) {
            var componenteAct = __app.componenteActivo().capitalize();
            var fechaSel = jq("#" + nombre + "Comp" + componenteAct + "2").datepicker('getDate');
            var fechaMax = jq("#" + nombre + "Comp" + componenteAct + "2").datepicker('getDate');

            fechaSel.setDate(fechaSel.getDate() + 1);
            fechaMax.setDate(fechaMax.getDate() + 30);

            jq("#" + nombreSegundoCambio + "Comp" + componenteAct + "2").datepicker("option", "minDate", fechaSel);
            jq("#" + nombreSegundoCambio + "Comp" + componenteAct + "2").datepicker("option", "maxDate", fechaMax);

            if (jq("#" + nombreSegundoCambio + "Comp" + componenteAct + "2").val() == '') {
                jq("#" + nombreSegundoCambio + "Comp" + componenteAct + "2").datepicker("setDate", fechaSel);
            }

            __app.calculoNochesHotelAdicional(nombre, componenteAct, nombreSegundoCambio);
        }
    });

    jq("#" + nombreSegundoCambio + "Comp" + componente + "2").datepicker({
        minDate: 2,
        onSelect: function (selected, dateText) {
            var componenteAct = __app.componenteActivo().capitalize();
            var fechaSel = jq("#" + nombreSegundoCambio + "Comp" + componenteAct + "2").datepicker('getDate');

            fechaSel.setDate(fechaSel.getDate() - 1);
            if (jq("#" + nombre + "Comp" + componenteAct + "2").val() == '') {
                jq("#" + nombre + "Comp" + componenteAct + "2").datepicker("setDate", fechaSel);
            }
            __app.calculoNochesHotelAdicional(nombre, componenteAct, nombreSegundoCambio);
        }
    });
};

App.prototype.calculoNochesHotel = function (nombre, componente, nombreSegundoCambio) {
    if (jq("#" + nombre + "Comp" + componente + "1").val() == '' || jq("#" + nombreSegundoCambio + "Comp" + componente + "1").val() == '')
        return;
    var numNoches = (jq("#" + nombreSegundoCambio + "Comp" + componente + "1").datepicker("getDate") - jq("#" + nombre + "Comp" + componente + "1").datepicker("getDate")) / 1000 / 60 / 60 / 24;
    jq("#nochesComp" + componente + "1").val(numNoches);

    var componentesRestantes = __app.demasComponentes(componente);
    for (var y = 0; y < componentesRestantes.length; y++) {
        if (typeof componentesRestantes[y] != "undefined") {
            jq("#" + nombre + "Comp" + componentesRestantes[y] + "1").val(jq("#" + nombre + "Comp" + componente + "1").val());
            jq("#" + nombreSegundoCambio + "Comp" + componentesRestantes[y] + "1").val(jq("#" + nombreSegundoCambio + "Comp" + componente + "1").val());
            jq("#nochesComp" + componentesRestantes[y] + "1").val(jq("#nochesComp" + componente + "1").val());
        }
    }
};

App.prototype.calculoNochesHotelAdicional = function (nombre, componente, nombreSegundoCambio) {
    if (jq("#" + nombre + "Comp" + componente + "2").val() == '' || jq("#" + nombreSegundoCambio + "Comp" + componente + "2").val() == '')
        return;
    var numNoches = (jq("#" + nombreSegundoCambio + "Comp" + componente + "2").datepicker("getDate") - jq("#" + nombre + "Comp" + componente + "2").datepicker("getDate")) / 1000 / 60 / 60 / 24;
    jq("#nochesCompHotel2").val(numNoches);

    var componentesRestantes = __app.demasComponentes(componente);
    for (var y = 0; y < __app.demasComponentes(componente); y++) {
        if (typeof componentesRestantes[y] != "undefined") {
            jq("#" + nombre + "Comp" + componentesRestantes[y] + "2").val(jq("#" + nombre + "Comp" + componente + "2").val());
            jq("#" + nombreSegundoCambio + "Comp" + componentesRestantes[y] + "2").val(jq("#" + nombreSegundoCambio + "Comp" + componente + "2").val());
            jq("#nochesComp" + componentesRestantes[y] + "2").val(jq("#nochesComp" + componente + "2").val());
        }
    }
};

App.prototype.demasComponentes = function (componente) {
    var componentesTotales = ["Hotel", "Aereo", "Terrestre"];
    for (var x = 0; x < componentesTotales.length; x++) {
        if (componentesTotales[x] == componente) {
            delete(componentesTotales[x]);
        }
    }
    return componentesTotales;
};

App.prototype.selectorTabs = function (habSel) {

    var numHab = jq(habSel + ':checked').val();

    jq('input[name=numHabHotel][id=numHabHotel' + numHab + ']').prop('checked', true);
    jq('input[name=numHabAereo][id=numHabAereo' + numHab + ']').prop('checked', true);
    jq('input[name=numHabTerrestre][id=numHabTerrestre' + numHab + ']').prop('checked', true);
    switch (numHab) {
        case '1':
            jq('#navHabitacionesHotel > ul.z-tabs-nav.z-tabs-desktop').hide();
            jq('.z-tabs.flat.flat-bookHabUpdate > .z-container').css("border-width", "0");

            jq('#hab1Hotel').show();
            jq('#hab2Hotel').hide();
            jq('#hab3Hotel').hide();
            jq("#navHabitacionesHotel").data('zozoTabs').select(0);

            jq('#botonHabHotel > label.active').removeClass("active");
            jq('#botonHabHotel > label:nth-of-type(1)').addClass("active");

            break;
        case '2':
            jq('.flat-bookHabUpdate > ul.z-tabs-nav.z-tabs-desktop').show();
            jq('.z-tabs.flat.flat-bookHabUpdate > .z-container').css("border-width", "2px 0 0 0");

            jq('#hab1Hotel').show();
            jq('#hab2Hotel').show();
            jq('#hab3Hotel').hide();
            jq('#hab1Hotel').css("width", "50%");
            jq('#hab2Hotel').css("width", "50%");
            jq('#hab2Hotel > a').css("border-width", "0");
            if (tabActual == 2) {
                jq("#navHabitacionesHotel").data('zozoTabs').select(0);
            }

            jq('#botonHabHotel > label.active').removeClass("active");
            jq('#botonHabHotel > label:nth-of-type(2)').addClass("active");

            break;
        case '3':
            jq('.flat-bookHabUpdate > ul.z-tabs-nav.z-tabs-desktop').show();
            jq('.z-tabs.flat.flat-bookHabUpdate > .z-container').css("border-width", "2px 0 0 0");

            jq('#hab1Hotel').show();
            jq('#hab2Hotel').show();
            jq('#hab3Hotel').show();
            jq('#hab1Hotel').css("width", "33.3333%");
            jq('#hab2Hotel').css("width", "33.3333%");
            jq('#hab2Hotel > a').css("border-right-width", "2px");

            jq('#botonHabHotel > label.active').removeClass("active");
            jq('#botonHabHotel > label:nth-of-type(3)').addClass("active");

            break;
    }
}

App.prototype.chckCombinarHotel = function () {
    var componente = __app.componenteActivo().capitalize();
    var componenteSettings = jq('#frm_' + componente.toLowerCase()).validate().settings;
    if (jq('#combinarHotel').is(':checked')) {
        jq('.planCombinadoHotel').css('display', 'inline-block');
        jq('.contHabitaciones').addClass("contHabitacionesAbierto");
        jq('#combinarAereo').prop('checked', true);
        jq('#combinarTerrestre').prop('checked', true);
        __app.reloadRequiredTwoHotel(true, componenteSettings);
    } else {
        jq('.planCombinadoHotel').css('display', 'none');
        jq('.contHabitaciones').removeClass("contHabitacionesAbierto");
        jq('#combinarAereo').prop('checked', false);
        jq('#combinarTerrestre').prop('checked', false);
        __app.reloadRequiredTwoHotel(false, componenteSettings);
    }
};

App.prototype.chkTransporte = function (element) {
    var settings = jq('#frm_' + __app.componenteActivo()).validate().settings;
    delete settings.rules.origenCompAereo;
    delete settings.rules.ciudadTerrestreOrigen;
    jq(".ctrTransporte").val("");
    if (jq(element).is(":checked") === true) {
        var grupo = "input:checkbox[name='" + jq(element).prop("name") + "']";
        var componente = jq(element).prop("id");
        if (componente === 'agregarAereo') {
            jq("#contOrigenAereo").removeClass("hide");
            jq("#contOrigenTerrestre").addClass("hide");
            jq("#ctrAereo").val("1");
            jq("#origenCompAereo").val(jq("#origenCompHotel").val());
            __app.searchAutocompletado(null, jq("#origenCompHotel").val());
            settings.rules.origenCompAereo = {required: true};
        } else {
            jq("#contOrigenTerrestre").removeClass("hide");
            jq("#contOrigenAereo").addClass("hide");
            jq("#ctrTerr").val("1");
            jq("#ciudadTerrestreOrigen").val(jq("#ciudadHotelOrigen").val()).trigger("change");
            jq('.selectpicker').selectpicker('refresh');
            settings.rules.ciudadTerrestreOrigen = {required: true};
            delete settings.rules.origenCompHotel;
        }
        jq(grupo).prop("checked", false);
        jq(element).prop("checked", true);
    } else {
        jq(element).is(":checked", false);
        jq("#contOrigenAereo").addClass("hide");
        jq("#contOrigenTerrestre").addClass("hide");
    }
};

App.prototype.loadDatosBooking = function () {
    jq('input.preloadts').each(function () {
        var campoLoad = jq(this).attr("data-booking");
        var typeLoad = jq(this).attr("data-typelem");

        var elementInputDom = jq("input[name=" + campoLoad + "]");
        var elementSelectDom = jq("select[name=" + campoLoad + "]");
        var valorFinal = jq(this).val();

        if (typeLoad == "i") {
            elementInputDom.val(valorFinal);
        }

        if (typeLoad == "r") {
            jq("#" + campoLoad + valorFinal).attr('checked', true);
            __app.selectorTabs('input[name=' + campoLoad + ']');
        }

        if (typeLoad == "s") {
            elementSelectDom.val(valorFinal).trigger("change");
        }

        if (typeLoad == "c") {
            if (valorFinal == "1") {
                jq("#" + campoLoad).attr('checked', true);
                __app.chckCombinarHotel();
            }
        }

        jq('.selectpicker').selectpicker('refresh');
    });

    // Chequea el campo si el cliente esta consultando con algun tipo de transporte
    jq(".ctrTransporte").each(function () {
        var campoHidden = jq(this).attr("id");
        if (jq("#" + campoHidden).val() != "") {
            jq(".class" + campoHidden).attr('checked', true);
            jq("input:checkbox[data-event='" + campoHidden + "']").each(function () {
                __app.chkTransporte(this);
            });
        }
    });

};

App.prototype.filtrosHabCotizadas = function () {
    jq('a.filtrosClass').click(function () {
        var componente = __app.componenteActivo();
        var str = jq('#frm_' + componente).serializeArray();
        str.push({name: 'action', value: 'filtrosCotizaciones'});
        str.push({name: 'liquidacion', value: jq("#dataLiq").val()});
        str.push({name: 'filtro', value: jq(this).attr("data-filtros")});
        console.log(jq(this).attr("data-filtros"));
        jq.ajax({
            url: "answerSettlement.php",
            async: false,
            data: str,
            contentType: "application/x-www-form-urlencoded",
            dataType: "html", //xml,html,script,json
            error: function () {
                console.log("Ha ocurrido un error");
            },
            ifModified: false,
            processData: true,
            success: function (datas) {
                console.log("paso por aca");
                jq("#cotizaciones").html(datas);
            },
            type: "POST",
            timeout: 3000
        });
    });
};