var jq = jQuery.noConflict();
var DIRECTORIO_RAIZ = "pruebasPrototype";

jQuery(document).ready(function ($) {
    /* ------------ Start Tabs Controller ------------ */

    jq("#navBooking").zozoTabs({
        position: "top-compact",
        style: "clean",
        theme: "flat-bookCompDecameron",
        spaced: true,
        bordered: true,
        rounded: false,
        deeplinking: true,
        defaultTab: "hotel",
        mobileNav: false,
        responsive: false,
        animation: {
            easing: "easeInBounce",
            duration: 400,
            effects: "slideH"
        },
        size: "bookingSize",
        select: compSeleccionado
    });

    jq("#navHabitacionesHotel").zozoTabs({
        position: "top-compact",
        style: "clean",
        theme: "flat-bookHabDecameron",
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

    jq("#navHabitacionesAereo").zozoTabs({
        position: "top-compact",
        style: "clean",
        theme: "flat-bookHabDecameron",
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

    jq("#navHabitacionesTerrestre").zozoTabs({
        position: "top-compact",
        style: "clean",
        theme: "flat-bookHabDecameron",
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

    jq('.flat-bookHabDecameron > ul.z-tabs-nav.z-tabs-desktop').hide();
    jq('.z-tabs.flat.flat-bookHabDecameron > .z-container').css("border-width", "0");

    var tabActual = 0;

    function habSeleccionada(event, item) {
        tabActual = item.index;
    }

    function compSeleccionado() {
        jq("#navHabitacionesHotel").data('zozoTabs').select(tabActual);
        jq("#navHabitacionesAereo").data('zozoTabs').select(tabActual);
        jq("#navHabitacionesTerrestre").data('zozoTabs').select(tabActual);
    }

    jq('input[name=numHabHotel]').change(function () {
        selectorTabs('input[name=numHabHotel]');
        __app.initEventForm();
        __app.redimensionar();
    });

    jq('input[name=numHabAereo]').change(function () {
        __app.initEventForm();
        selectorTabs('input[name=numHabAereo]');
    });

    jq('input[name=numHabTerrestre]').change(function () {
        __app.initEventForm();
        selectorTabs('input[name=numHabTerrestre]');
    });


    function selectorTabs(habSel) {

        var numHab = jq(habSel + ':checked').val();

        jq('input[name=numHabHotel][id=numHabHotel' + numHab + ']').prop('checked', true);
        jq('input[name=numHabAereo][id=numHabAereo' + numHab + ']').prop('checked', true);
        jq('input[name=numHabTerrestre][id=numHabTerrestre' + numHab + ']').prop('checked', true);
        switch (numHab) {
            case '1':
                jq('.flat-bookHabDecameron > ul.z-tabs-nav.z-tabs-desktop').hide();
                jq('.z-tabs.flat.flat-bookHabDecameron > .z-container').css("border-width", "0");

                jq('#hab1Hotel').show();
                jq('#hab2Hotel').hide();
                jq('#hab3Hotel').hide();
                jq("#navHabitacionesHotel").data('zozoTabs').select(0);

                jq('#hab1Aereo').show();
                jq('#hab2Aereo').hide();
                jq('#hab3Aereo').hide();
                jq("#navHabitacionesAereo").data('zozoTabs').select(0);

                jq('#hab1Terrestre').show();
                jq('#hab2Terrestre').hide();
                jq('#hab3Terrestre').hide();
                jq("#navHabitacionesTerrestre").data('zozoTabs').select(0);

                jq('#botonHabHotel > label.active').removeClass("active");
                jq('#botonHabHotel > label:nth-of-type(1)').addClass("active");

                jq('#botonHabAereo > label.active').removeClass("active");
                jq('#botonHabAereo > label:nth-of-type(1)').addClass("active");

                jq('#botonHabTerrestre > label.active').removeClass("active");
                jq('#botonHabTerrestre > label:nth-of-type(1)').addClass("active");

                break;
            case '2':
                jq('.flat-bookHabDecameron > ul.z-tabs-nav.z-tabs-desktop').show();
                jq('.z-tabs.flat.flat-bookHabDecameron > .z-container').css("border-width", "2px 0 0 0");

                jq('#hab1Hotel').show();
                jq('#hab2Hotel').show();
                jq('#hab3Hotel').hide();
                jq('#hab1Hotel').css("width", "50%");
                jq('#hab2Hotel').css("width", "50%");
                jq('#hab2Hotel > a').css("border-width", "0");
                if (tabActual == 2) {
                    jq("#navHabitacionesHotel").data('zozoTabs').select(0);
                }
                ;

                jq('#hab1Aereo').show();
                jq('#hab2Aereo').show();
                jq('#hab3Aereo').hide();
                jq('#hab1Aereo').css("width", "50%");
                jq('#hab2Aereo').css("width", "50%");
                jq('#hab2Aereo > a').css("border-width", "0");
                if (tabActual == 2) {
                    jq("#navHabitacionesAereo").data('zozoTabs').select(0);
                }
                ;

                jq('#hab1Terrestre').show();
                jq('#hab2Terrestre').show();
                jq('#hab3Terrestre').hide();
                jq('#hab1Terrestre').css("width", "50%");
                jq('#hab2Terrestre').css("width", "50%");
                jq('#hab2Terrestre > a').css("border-width", "0");
                if (tabActual == 2) {
                    jq("#navHabitacionesTerrestre").data('zozoTabs').select(0);
                }
                ;

                jq('#botonHabHotel > label.active').removeClass("active");
                jq('#botonHabHotel > label:nth-of-type(2)').addClass("active");

                jq('#botonHabAereo > label.active').removeClass("active");
                jq('#botonHabAereo > label:nth-of-type(2)').addClass("active");

                jq('#botonHabTerrestre > label.active').removeClass("active");
                jq('#botonHabTerrestre > label:nth-of-type(2)').addClass("active");


                break;
            case '3':
                jq('.flat-bookHabDecameron > ul.z-tabs-nav.z-tabs-desktop').show();
                jq('.z-tabs.flat.flat-bookHabDecameron > .z-container').css("border-width", "2px 0 0 0");

                jq('#hab1Hotel').show();
                jq('#hab2Hotel').show();
                jq('#hab3Hotel').show();
                jq('#hab1Hotel').css("width", "33.3333%");
                jq('#hab2Hotel').css("width", "33.3333%");
                jq('#hab2Hotel > a').css("border-right-width", "2px");

                jq('#hab1Aereo').show();
                jq('#hab2Aereo').show();
                jq('#hab3Aereo').show();
                jq('#hab1Aereo').css("width", "33.3333%");
                jq('#hab2Aereo').css("width", "33.3333%");
                jq('#hab2Aereo > a').css("border-right-width", "2px");

                jq('#hab1Terrestre').show();
                jq('#hab2Terrestre').show();
                jq('#hab3Terrestre').show();
                jq('#hab1Terrestre').css("width", "33.3333%");
                jq('#hab2Terrestre').css("width", "33.3333%");
                jq('#hab2Terrestre > a').css("border-right-width", "2px");

                jq('#botonHabHotel > label.active').removeClass("active");
                jq('#botonHabHotel > label:nth-of-type(3)').addClass("active");

                jq('#botonHabAereo > label.active').removeClass("active");
                jq('#botonHabAereo > label:nth-of-type(3)').addClass("active");

                jq('#botonHabTerrestre > label.active').removeClass("active");
                jq('#botonHabTerrestre > label:nth-of-type(3)').addClass("active");

                break;
        }

        __app.redimensionar();
    }

    /* ------------ Start Datepicker Language Selection ------------ */
    __app.loadDatePicker();
    /* ------------ Start Datepicker Configuration ------------ */
    /*-- Hotel --*/
    __app.detalleDatePickerConfiguracion("entrada", "Hotel", "salida");

    jq('#combinarHotel').change(function () {
        var componente = __app.componenteActivo().capitalize();
        var componenteSettings = jq('#frm_' + componente.toLowerCase()).validate().settings;
        if (jq('#combinarHotel').is(':checked')) {
            jq('.planCombinado' + componente).css('display', 'inline-block');
            jq('.contHabitaciones').addClass("contHabitacionesAbierto");
            __app.reloadRequiredTwoHotel(true, componenteSettings);
        } else {
            jq('.planCombinado' + componente).css('display', 'none');
            jq('.contHabitaciones').removeClass("contHabitacionesAbierto");
            __app.reloadRequiredTwoHotel(false, componenteSettings);
        }
        __app.redimensionar();
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

    /* ------------ Start Actualizar Informacion ------------ */

    /* -- HOTEL --*/

    jq('#origenCompHotel').change(function () {
        jq('#origenCompAereo').val(jq('#origenCompHotel').val());
        jq('#origenCompTerrestre').val(jq('#origenCompHotel').val());
    });

    jq('#hotelCompHotel1').change(function () {
        __app.validaHotelCombinados();
        jq('#hotelCompAereo1').selectpicker('val', jq('#hotelCompHotel1').val());
        jq('#hotelCompTerrestre1').selectpicker('val', jq('#hotelCompHotel1').val());
    });

    jq('#hotelCompHotel2').change(function () {
        jq('#hotelCompAereo2').selectpicker('val', jq('#hotelCompHotel2').val());
        jq('#hotelCompTerrestre2').selectpicker('val', jq('#hotelCompHotel2').val());
    });

    jq('#codPromHotel').change(function () {
        jq('#codPromAereo').val(jq('#codPromHotel').val());
        jq('#codPromTerrestre').val(jq('#codPromHotel').val());
    });

    /* -- AEREO --*/

    jq('#origenCompAereo').change(function () {
        jq('#origenCompAereo').val(jq('#origenCompAereo').val());
        jq('#origenCompTerrestre').val(jq('#origenCompAereo').val());
    });

    jq('#hotelCompAereo1').change(function () {
        __app.validaHotelCombinados();
        jq('#hotelCompHotel1').selectpicker('val', jq('#hotelCompAereo1').val());
        jq('#hotelCompTerrestre1').selectpicker('val', jq('#hotelCompAereo1').val());
    });

    jq('#hotelCompAereo2').change(function () {
        jq('#hotelCompHotel2').selectpicker('val', jq('#hotelCompAereo2').val());
        jq('#hotelCompTerrestre2').selectpicker('val', jq('#hotelCompAereo2').val());
    });

    jq('#codPromAereo').change(function () {
        jq('#codPromAereo').val(jq('#codPromAereo').val());
        jq('#codPromTerrestre').val(jq('#codPromAereo').val());
    });

    /* -- TERRESTRE --*/

    jq('#origenCompTerrestre').change(function () {
        jq('#origenCompAereo').val(jq('#origenCompTerrestre').val());
        jq('#origenCompHotel').val(jq('#origenCompTerrestre').val());
    });

    jq('#hotelCompTerrestre1').change(function () {
        __app.validaHotelCombinados();
        jq('#hotelCompAereo1').selectpicker('val', jq('#hotelCompTerrestre1').val());
        jq('#hotelCompHotel1').selectpicker('val', jq('#hotelCompTerrestre1').val());
    });

    jq('#hotelCompTerrestre2').change(function () {
        jq('#hotelCompAereo2').selectpicker('val', jq('#hotelCompTerrestre2').val());
        jq('#hotelCompHotel2').selectpicker('val', jq('#hotelCompTerrestre2').val());
    });

    jq('#codPromTerrestre').change(function () {
        jq('#codPromAereo').val(jq('#codPromTerrestre').val());
        jq('#codPromHotel').val(jq('#codPromTerrestre').val());
    });

    __app.reloadEventChangeEdadNinyos(__app.componenteActivo().capitalize());
    __app.initEventForm();
    __app.eventoForTab();


    jq("#origenCompAereo").autocomplete(citiesAer, {
        matchContains: true,
        minChars: 0,
        max: 1000
    });

    jq("#origenCompAereo, textarea").result(__app.searchAutocompletado).next().click(function () {
        jq(this).prev().search();
    });

    jq("#origenCompHotel").autocomplete(cities, {
        matchContains: true,
        minChars: 0,
        max: 1000
    });

    jq("#origenCompHotel, textarea").result(__app.searchAutocompletado).next().click(function () {
        jq(this).prev().search();
    });

    // VALIDACIONES PARA HOTEL
    var hotelSettings = jq('#frm_hotel').validate().settings;
    __app.alertErroresValidacion(hotelSettings);
    __app.submitForm(hotelSettings);
    __app.validacionComunComponentes(hotelSettings, "Hotel");
    mensajesAlertaErrores(hotelSettings);
    // VALIDACIONES PARA AEREO
    var aereoSettings = jq('#frm_aereo').validate().settings;
    __app.alertErroresValidacion(aereoSettings);
    __app.submitForm(aereoSettings);
    __app.validacionComunComponentes(aereoSettings, "Aereo");
    // VALIDACIONES PARA TERRESTRE
    var terrestreSettings = jq('#frm_terrestre').validate().settings;
    __app.alertErroresValidacion(terrestreSettings);
    __app.submitForm(terrestreSettings);
    __app.validacionComunComponentes(terrestreSettings, "Terrestre");

});

function mensajesAlertaErrores(settings) {
    jq.validator.messages.required = utf8_decode(LBL_CAMPO_OBLIGATORIO);
}