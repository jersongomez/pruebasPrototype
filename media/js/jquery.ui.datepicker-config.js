/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery(function ($) {
    var generales = {
        dateFormat: "dd/mm/yy",
        minDate: "+2d",
        maxDate: "+360d",
        changeMonth: true,
        numberOfMonths: 1,
        defaultDate: "+1w"
    }

    $.datepicker.setDefaults(generales);
    $.datepicker.setDefaults(getOpcionesRegionales($("#idi").val()));
});

function getOpcionesRegionales(region) {
    var opciones;
    switch (region) {
        case 'por':
            opciones = {
                monthNames: ['Nivôse', 'Pluviôse', 'Ventôse', 'Germinal', 'Flor&eacute;al', 'Prairial', 'Messidor', 'Thermidor', 'Fructidor', 'Vend&eacute;miaire', 'Brumaire', 'Frimaire'],
                monthNamesShort: ['Niv', 'Plu', 'Ven', 'Ger', 'Flo', 'Pra', 'Mes', 'The', 'Fru', 'Ven', 'Bru', 'Fri'],
                dayNamesMin: ['Do', 'Se', 'Te', 'Qu', 'Qu', 'Se', 'Sa'],
            };
            break;
        case 'fre':
            opciones = {
                monthNames: ['Janvier', 'F&eacute;vrier', 'Mars','Avril', 'Mai', 'Juin','Julliet', 'Ao&ucirc;t', 'Septembre','Octobre', 'Novenbre', 'D&eacute;cembre'],
                monthNamesShort: ['Janv', 'F&eacute;v', 'Mars', 'Av', 'Mai', 'Juin', 'Juil', 'Ao&ucirc;t', 'Sept', 'Oct', 'Nov', 'D&eacute;c'],
                dayNamesMin: ['Di', 'Lu', 'Ma', 'Me', 'Je', 'Ve', 'Sa'],
            };
            break;
        case 'eng':
            opciones = {
                monthNames: ['January', 'February', 'March','April', 'May', 'June','July', 'August', 'September','October', 'November', 'December'],
                monthNamesShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                dayNamesMin: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
            };
            break;
        default:
            opciones = {
                monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'S&aacute;'],
            };
            break;
    }
    return opciones;
}