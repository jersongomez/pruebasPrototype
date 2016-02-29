var jq = jQuery.noConflict();
var tabActual = 0;

jQuery(document).ready(function ($) {

    for (var i = 1; i <= 100; i++) {
        jq('#botMostrarInfo' + i).on('click', {id: i}, function (e) {
            jq('#infoHab' + e.data.id.toString()).toggle('50', 'swing');
        });
//        jq('#botMostrarMoneda' + i).on('click', {id: i}, function (e) {
//            jq('#contCambioMoneda' + e.data.id.toString()).toggle('50', 'swing');
//            jq('.alertaCambioMoneda').toggle('50', 'swing');
//        });
    }

    jq('.btn-group > .btn').click(function () {
        jq('.btn-group > .btn').removeClass('active');
        jq(this).addClass("active");
    });

    /* ------------ Start Tabs Controller ------------ */

    jq("#navHabitacionesHotel").zozoTabs({
        position: "top-compact",
        style: "clean",
        theme: "flat-bookHabUpdate",
        spaced: true,
        bordered: true,
        rounded: false,
        mobileNav: false,
        responsive: false,
        animation: {
            easing: "easeInBounce",
            duration: 400,
            effects: "slideH"
        },
        size: "bookingSize",
        select: habSeleccionada
    });

    jq('.tooltipNinyos').tooltip();
    jq('.tooltipTraslados').tooltip();

    jq(".navDescripcionHabitacion").zozoTabs({
        position: "top-compact",
        style: "clean",
        theme: "flat-infoHabCotizacion",
        spaced: true,
        bordered: true,
        rounded: false,
        mobileNav: false,
        responsive: false,
        animation: {
            easing: "easeInBounce",
            duration: 400,
            effects: "slideH"
        },
        size: "bookingSize"
    });

    jq('#navHabitacionesHotel > ul.z-tabs-nav.z-tabs-desktop').hide();
    jq('.z-tabs.flat.flat-bookHabUpdate > .z-container').css("border-width", "0");

    function habSeleccionada(event, item) {
        tabActual = item.index;
    }

    function compSeleccionado() {
        jq("#navHabitacionesHotel").data('zozoTabs').select(tabActual);
        jq("#navHabitacionesAereo").data('zozoTabs').select(tabActual);
        jq("#navHabitacionesTerrestre").data('zozoTabs').select(tabActual);
    }

    jq('input[name=numHabHotel]').change(function () {
        __app.initEventForm();
        __app.selectorTabs('input[name=numHabHotel]');
    });

    jq('input[name=numHabAereo]').change(function () {
        __app.initEventForm();
        __app.selectorTabs('input[name=numHabAereo]');
    });

    jq('input[name=numHabTerrestre]').change(function () {
        __app.initEventForm();
        __app.selectorTabs('input[name=numHabTerrestre]');
    });

    /* ------------ Start Datepicker Language Selection ------------ */

    __app.loadDatePicker();

    /* ------------ Start Datepicker Configuration ------------ */

    /*-- Hotel --*/
    __app.detalleDatePickerConfiguracion("entrada", "Hotel", "salida");

    jq('#combinarHotel').change(function () {
        __app.chckCombinarHotel();
    });

    jq('#tooltipHab1HotelNinyos').tooltip();
    jq('#tooltipHab2HotelNinyos').tooltip();
    jq('#tooltipHab3HotelNinyos').tooltip();
    jq('#tooltipCombinadoHotel').tooltip();

    /*-- Aereo --*/

    __app.detalleDatePickerConfiguracion("entrada", "Aereo", "salida");

    jq('#combinarAereo').change(function () {
        var _com = __app.componenteActivo().capitalize();
        if (jq('#combinarAereo').is(':checked')) {
            jq(".planCombinado" + _com).css('display', 'inline-block');
            jq('.contHabitaciones').addClass("contHabitacionesAbierto");
            jq('#combinarHotel').prop('checked', true);
            jq('#combinarTerrestre').prop('checked', true);
        } else {
            jq(".planCombinado" + _com).css('display', 'none');
            jq('.contHabitaciones').removeClass("contHabitacionesAbierto");
            jq('#combinarHotel').prop('checked', false);
            jq('#combinarTerrestre').prop('checked', false);
        }
    });

    jq('#tooltipHab1AereoNinyos').tooltip();
    jq('#tooltipHab2AereoNinyos').tooltip();
    jq('#tooltipHab3AereoNinyos').tooltip();
    jq('#tooltipCombinadoAereo').tooltip();

    /*-- Terrestre --*/

    __app.detalleDatePickerConfiguracion("entrada", "Terrestre", "salida");

    jq('#combinarTerrestre').change(function () {
        if (jq('#combinarTerrestre').is(':checked')) {
            jq('.planCombinadoHotel').css('display', 'inline-block');
            jq('.contHabitaciones').addClass("contHabitacionesAbierto");
            jq('#combinarHotel').prop('checked', true);
            jq('#combinarAereo').prop('checked', true);
        } else {
            jq('.planCombinadoHotel').css('display', 'none');
            jq('.contHabitaciones').removeClass("contHabitacionesAbierto");
            jq('#combinarHotel').prop('checked', false);
            jq('#combinarAereo').prop('checked', false);
        }
    });

    jq('#tooltipHab1TerrestreNinyos').tooltip();
    jq('#tooltipHab2TerrestreNinyos').tooltip();
    jq('#tooltipHab3TerrestreNinyos').tooltip();
    jq('#tooltipCombinadoTerrestre').tooltip();

    jq("input:checkbox[name='agregarTransporte']").click(function () {
        __app.chkTransporte(this);
    });

    jq("#origenCompAereo").autocomplete(citiesAer, {
        matchContains: true,
        minChars: 0,
        max: 1000
    });

    jq("#origenCompAereo, textarea").result(__app.searchAutocompletado).next().click(function () {
        jq(this).prev().search();
    });

    __app.filtrosHabCotizadas();

    // CARGAMOS LOS DATOS ENVIDOS A COTIZAR
    __app.loadDatosBooking();
    __app.onSelectDatapicker("entrada", "Hotel", "salida");

    // VALIDACIONES PARA HOTEL
    var hotelSettings = jq('#frm_hotel').validate().settings;
    __app.alertErroresValidacion(hotelSettings);
    __app.submitForm(hotelSettings);
    __app.validacionComunComponentes(hotelSettings, "Hotel");
    mensajesAlertaErrores(hotelSettings);

    __app.reloadEventChangeEdadNinyos(__app.componenteActivo().capitalize());
    __app.initEventForm();
    __app.eventoForTab();
    // VALIDAMOS SI MOSTRAMOS EL CHECK DE HOTEL PARA COMBINAR
    __app.validaHotelCombinados();

    // CARGAMOS LOS DATOS ENVIDOS A COTIZAR
    __app.loadDatosBooking();
});

function mensajesAlertaErrores(settings) {
    jq.validator.messages.required = utf8_decode(LBL_CAMPO_OBLIGATORIO);
}
