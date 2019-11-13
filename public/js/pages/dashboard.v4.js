$(function() {

    "use strict";
    $(".select2").select2();
    $('.inmodal').on('click', function() {
        $('.enlargeImageModalSource').attr('src', $(this).attr('src'));
        $('#enlargeImageModal').modal('show');
    });
    //Make the dashboard widgets sortable Using jquery UI
    $(".connectedSortable").sortable({
        placeholder: "sort-highlight",
        connectWith: ".connectedSortable",
        handle: ".box-header, .nav-tabs",
        forcePlaceholderSize: true,
        zIndex: 999999
    });
    $(".connectedSortable .box-header, .connectedSortable .nav-tabs-custom").css("cursor", "move");
    //jQuery UI sortable for the todo list
    $(".todo-list").sortable({
        placeholder: "sort-highlight",
        handle: ".handle",
        forcePlaceholderSize: true,
        zIndex: 999999
    });
    //bootstrap WYSIHTML5 - text editor
    $(".textarea").wysihtml5();
    //Formato de precio
    $('.formatoPrecio').priceFormat({
        prefix: '$ ',
        clearPrefix: true,
        centsLimit: 0,
        thousandsSeparator: '.'
    });
    $('.daterange').daterangepicker({
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate: moment()
    }, function(start, end) {
        window.alert("You chose: " + start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    });
    /* jQueryKnob */
    $(".knob").knob();
    //The Calender
    $("#calendar").datepicker();
    //SLIMSCROLL FOR CHAT WIDGET
    $('#chat-box').slimScroll({
        height: '250px'
    });
    /* The todo list plugin */
    $(".todo-list").todolist({
        onCheck: function(ele) {
            window.console.log("The element has been checked");
            return ele;
        },
        onUncheck: function(ele) {
            window.console.log("The element has been unchecked");
            return ele;
        }
    });

    //Inmodal
    $('.inmodal').on('click', function() {
        $('.enlargeImageModalSource').attr('src', $(this).attr('src'));
        $('#enlargeImageModal').modal('show');
    });
    //Timepicker
    $(".tiempoFecha").datetimepicker({
        sideBySide: true,
        showClose: true,
        format: 'DD/MM/YYYY'
    });
    $(".tiempoHora").datetimepicker({
        sideBySide: true,
        showClose: true,
        format: 'hh:mm A'
    });

    $(".nav-tabs a").on('shown.bs.tab', function(event) {
        var x = $(event.target).text();
        if (x == 'Orden') {
            //$(".imagenes_soporte").show();
        } else {
            //$(".imagenes_soporte").hide();
        }
    });
});

$(document).ready(function() {

    $('#editarEmail').click(function() {
        var email = $(this).context.dataset.email;
        var id = $(this).context.dataset.id;
        $(this).hide();
        $('.list-group-item-open span').hide();
        $(this).parent().append('<div id="formEditarEmail"><input type="email" class="form-control input-sm" value="' + email + '" id="nuevoEmail"><input type="submit" class="btn btn-xs btn-primary" value="Guardar" onclick="guardarEmail(' + id + ')"></div>');
    });


    $('#imprimir_boton').click(function() {
        $('#hoja_imprimir').printArea({ extraCss: 'imprimible' });
    });
});

/**
 * imprime solo el area de la orden
 */
function imprimir(area) {
    $('#area' + area).printArea();
}

//Fuunciones generales
function formato(amount, decimals) {
    amount += '';
    amount = parseFloat(amount.replace(/[^0-9\.]/g, ''));
    decimals = decimals || 0;
    if (isNaN(amount) || amount === 0)
        return parseFloat(0).toFixed(decimals);
    amount = '' + amount.toFixed(decimals);
    var amount_parts = amount.split('.'),
        regexp = /(\d+)(\d{3})/;
    while (regexp.test(amount_parts[0]))
        amount_parts[0] = amount_parts[0].replace(regexp, '$1' + '.' + '$2');
    return amount_parts.join('.');
}