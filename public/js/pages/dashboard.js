tipo1 = "";
$(function () {

    "use strict";

    $(".select2").select2();

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
    }, function (start, end) {
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
        onCheck: function (ele) {
            window.console.log("The element has been checked");
            return ele;
        },
        onUncheck: function (ele) {
            window.console.log("The element has been unchecked");
            return ele;
        }
    });

    $('#ofertas_sinsolicitar').DataTable({
        "paging": true,
        "lengthChange": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf'
        ]
    });
    $('#ofertas_activas').DataTable({
        "paging": true,
        "lengthChange": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    });
    $('#ofertas_sinmanifiesto').DataTable({
        "paging": true,
        "lengthChange": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf'
        ]
    });
    $('#ofertas_sinturno').DataTable({
        "paging": true,
        "lengthChange": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf'
        ]
    });
    $('#ofertas_finalizadas').DataTable({
        "bProcessing": true,
        "paging": true,
        "serverSide": true,
        "ajax": {
            url: RUTAURL + "table_ofertasFinalizadas",
            type: "post",
            error: function () {
                $("#ofertas_finalizadas_processing").css("display", "none");
            }
        },
        buttons: [
            'excel', 'pdf'
        ]
    });
    $('#financieroPagadas').DataTable({
        "bProcessing": true,
        "paging": true,
        "serverSide": true,
        "ajax": {
            url: RUTAURL + "table_ofertasPagadas",
            type: "post",
            error: function () {
                $("#financieroPagadas_processing").css("display", "none");
            }
        },
        "columnDefs": [
            {
                "targets": 0,
                "render": function (url, type, full) {
                    return '<center><img src="' + RUTAURL + 'img/perfil/' + full[0] + '" width="80" style="margin-bottom: 20px" />' +
                            '<br>' +
                            '<button class="btn btn-xs btn-success" onclick="imprimirHoja(' + full['id_oferta'] + ')">Imprimir</button></center>';
                }
            },
            {
                "targets": 1,
                "data": "img",
                "render": function (url, type, full) {
                    return '<img src="' + RUTAURL + 'img/ofertas/' + full[1] + '" class="responsive inmodal" style="width: 80px; cursor: zoom-in" onclick="inmodal(this)" />';
                }
            },
            {
                "targets": 2,
                "data": "img",
                "render": function (url, type, full) {
                    return '<img src="' + RUTAURL + 'img/ofertas/' + full[2] + '" class="responsive inmodal" style="width: 80px; cursor: zoom-in" onclick="inmodal(this)" />';
                }
            },
            {
                "targets": 3,
                "data": "p",
                "render": function (url, type, full) {
                    return full[3] + ' ' + full['apellidos'];
                }
            },
            {
                "targets": 6,
                "data": "p",
                "render": function (url, type, full) {
                    return formato(full[6]);
                }
            },
            {
                "targets": 11,
                "render": function (url, type, full) {
                    if (full[11] != null) {
                        var doc = full[11].split(".");
                        tipo1 = doc[1];
                        if (doc[1] == 'pdf') {
                            return "<a href='img/perfil/" + full[11] + " target='_blanck'><img src='http://m.blog.hu/tc/tclang/image/pdf.png' class='img-responsive'></a>";
                        } else if (doc[1] == 'pptx' || doc[1] == 'ppt') {
                            return '<a href="img/perfil/' + full[11] + '" target="_blanck"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/37/Antu_application-wps-office.pptx.svg/2000px-Antu_application-wps-office.pptx.svg.png" class="img-responsive"></a>';
                        } else {
                            return '<img src="img/perfil/' + full[11] + '" class="img-responsive inmodal" style="width: 80px; cursor: zoom-in">';
                        }
                    } else {
                        return full[11];
                    }
                }
            },
            {
                "targets": 12,
                "render": function (url, type, full) {
                    if (full[12] != null) {
                        var doc = full[12].split(".");

                        var impresion = '<div class="hidden visible-print print-' + full['id_oferta'] + '">';
                        
                        if (tipo1 != "pdf" && tipo1 != "pptx") {
                            impresion += '<img src="img/perfil/' + full[11] + '" class="img-responsive" style="height: 450px; width: auto">';
                        }

                        if (doc[1] != "pdf" && doc[1] != "pptx") {
                            impresion += '<img src="img/perfil/' + full[12] + '" class="img-responsive" style="height: 450px; width: auto">';
                        }
                        
                        impresion += '</div>';

                        if (doc[1] == 'pdf') {
                            return "<a href='img/perfil/" + full[12] + " target='_blanck'><img src='http://m.blog.hu/tc/tclang/image/pdf.png' class='img-responsive'></a>" + impresion;
                        } else if (doc[1] == 'pptx' || doc[1] == 'ppt') {
                            return '<a href="img/perfil/' + full[12] + '" target="_blanck"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/37/Antu_application-wps-office.pptx.svg/2000px-Antu_application-wps-office.pptx.svg.png" class="img-responsive"></a>' + impresion;
                        } else {
                            return '<img src="img/perfil/' + full[12] + '" class="img-responsive inmodal" style="width: 80px; cursor: zoom-in" onclick="inmodal(this)" />' + impresion;
                        }
                    }
                    return full[12];
                }
            },
        ],
        buttons: [
            'excel', 'pdf'
        ]
    });
    $('#ofertas_canceladas').DataTable({
        "paging": true,
        "lengthChange": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf'
        ]
    });
    $('#empresas').DataTable({
        "paging": true,
        "lengthChange": false,
        "ordering": true,
        "info": true,
        "autoWidth": false
    });
    $('#clientes').DataTable({
        "paging": true,
        "lengthChange": false,
        "ordering": true,
        "info": true,
        "autoWidth": false
    });
    $('#financiero').DataTable({
        "order": [[9, "desc"]],
        buttons: [
            'excel', 'pdf'
        ]
    });
    $('#transportadores').DataTable({
        "bProcessing": true,
        "paging": true,
        "serverSide": true,
        "ajax": {
            url: RUTAURL + "table_transportadores",
            type: "post",
            error: function () {
                $("#transportadores_processing").css("display", "none");
            }
        },
        "columnDefs": [{
                "targets": 6,
                "data": "img",
                "render": function (url, type, full) {
                    return '<img src="' + RUTAURL + 'img/perfil/' + full[6] + '" style="width: 25px" />';
                }
            },
            {
                "targets": 0,
                "data": "a",
                "render": function (url, type, full) {
                    return '<a href="' + RUTAURL + 'transportador/' + full['id_user'] + '">' + full['apellidos'] + ' ' + full[0] + '</a>';
                }
            }],
        buttons: [
            'excel', 'pdf'
        ]
    });


    //Inmodal
    $('.inmodal').on('click', function () {
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

    /*
     * Con esta funcion asigno el turno con una petición ajax
     */
    $("#asignadorTurno").click(function () {
        var turno = $("#turno").val();
        var hora = $('#hora_turno').val();
        var id = $("#turno_oferta").val();
        var form = $(this);
        var currentToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: RUTAURL + 'asignarTurno',
            data: {id: id, turno: turno, hora: hora, "_token": currentToken},
            type: 'post',
            dataType: 'json',
            success: function (data) {
                $("#turno").parent().html(turno);
                $("#hora_turno").parent().html(hora);
                form.parent().parent().remove();
            }
        });
    });


    $(".nav-tabs a").on('shown.bs.tab',
            function (event) {
                var x = $(event.target).text();
                if (x == 'Orden') {
                    //$(".imagenes_soporte").show();
                } else {
                    //$(".imagenes_soporte").hide();
                }
            });

    /**
     *
     * Parte par select anidado crear oferta
     */

    $.get(RUTAURL + 'clientesJson', function (data) {
        var option = '';
        for (var i in data) {
            option += '<option value="' + data[i].id + '">' + data[i].value + '</option>';
        }
        $('#nombre_cliente').html('<option value=""> -- Seleccione cliente -- </option>' + option);
        $('#ciudad_cliente').html('<option value=""> -- Selecciona ciudad -- </option>');
        $('#direccion_cliente').html('<option value=""> -- Selecciona dirección -- </option>');
        $('#telefono_cliente').html('<option value=""> -- Selecciona telefono -- </option>');
    });

    $('#nombre_cliente').change(function () {
        cargarCiudades();
    });

    function cargarCiudades() {
        $.post(RUTAURL + 'ciudadesJson', {id: $('#nombre_cliente').val()}, function (data) {
            var option = '';
            for (var i in data) {
                option += '<option value="' + data[i].id + '">' + data[i].value + '</option>';
            }
            $('#ciudad_cliente').html('<option value=""> -- Selecciona ciudad -- </option>' + option);
        });
    }

    $('#ciudad_cliente').change(function () {
        cargarDirecciones();
    });

    function cargarDirecciones() {
        $.post(RUTAURL + 'direccion/' + $('#ciudad_cliente').val(), {cliente_id: $('#nombre_cliente').val()}, function (data) {
            var option = '';
            for (var i in data) {
                option += '<option value="' + data[i].id + '">' + data[i].value + '</option>';
            }
            $('#direccion_cliente').html('<option value=""> -- Selecciona dirección -- </option>' + option);
        });
    }

    $('#direccion_cliente').change(function () {
        cargarTelefono();
    });

    function cargarTelefono() {
        $.post(RUTAURL + 'telefono/' + $('#direccion_cliente').val(), function (data) {
            var option = '';
            for (var i in data) {
                option += '<option value="' + data[i].id + '">' + data[i].value + '</option>';
            }
            $('#telefono_cliente').html(option);
        });
    }
});

$(document).ready(function () {

    if (location.href.includes('oferta') && location.hash.length != 0) {
        var id = location.hash;
        $('.tab-pane').each(function () {
            if ('#' + $(this)[0].id != id)
                $(this).removeClass('active');
            else
                $(this).addClass('active');
        });
        $('.nav-tabs li').each(function () {
            var hijo = $(this).children();
            if (hijo[0].attributes.href.value != id)
                $(this).removeClass('active');
            else
                $(this).addClass('active');
        });
    }

    //borrado de la empresa por medio de ajax
    var currentToken = $('meta[name="csrf-token"]').attr('content');
    $(".borrar_empresa").click(function () {
        var fila = $(this);
        var info = ($(this)[0].name).split("_");
        bootbox.confirm({
            message: "Realmente desea borrar esta " + info[0] + "?",
            buttons: {
                confirm: {
                    label: 'Si'
                },
                cancel: {
                    label: 'No'
                }
            },
            callback: function (result) {
                if (result) {
                    $.ajax({
                        url: RUTAURL + 'borrarEmpresa',
                        data: {empresa_id: info[1], "_token": currentToken},
                        type: 'post',
                        dataType: 'json',
                        success: function (data) {
                            if (data == 'ok') {
                                fila.parent().parent().remove();
                                bootbox.alert("Empresa borrada con exito!");
                            }
                        }
                    });
                }
            },
        });
    });

    $('.estadoTrans').change(function () {
        var obj = $(this);
        obj.siblings('center').remove();
        obj.parent().append('<center><small>Espere un segundo. Procesando...</small></center>');
        obj.attr('disabled', true);
        var check = obj.is(":checked");
        var empresa = obj.context.dataset.empresa;
        var perfil = obj.context.dataset.perfil;
        var estado = obj.context.dataset.estado;
        $.ajax({
            url: RUTAURL + 'estadosTrans',
            data: {check: check, empresa: empresa, id: perfil, estado: estado, "_token": currentToken},
            type: 'post',
            dataType: 'json',
            success: function (data) {
                obj.siblings('center').remove();
                if (check) {
                    var f = new Date();
                    obj.parent().append('<center><small>Activado!</small></center>');
                    obj.after('<a class="pull-right">' + f.getDate() + "/" + (f.getMonth() + 1) + "/" + f.getFullYear() + '</a>');
                } else {
                    obj.parent().append('<center><small>Desactivado!</small></center>');
                    //obj.siblings()[0].remove();
                }
                obj.attr('disabled', false);
            },
            error: function () {
                obj.siblings('center').remove();
                obj.parent().append('<center><small>Intentalo nuevamente</small></center>');
                obj.attr('disabled', false);
            }
        });
    });

    $('#editarEmail').click(function () {
        var email = $(this).context.dataset.email;
        var id = $(this).context.dataset.id;
        $(this).hide();
        $('.list-group-item-open span').hide();
        $(this).parent().append('<div id="formEditarEmail"><input type="email" class="form-control input-sm" value="' + email + '" id="nuevoEmail"><input type="submit" class="btn btn-xs btn-primary" value="Guardar" onclick="guardarEmail(' + id + ')"></div>');
    });

    /**
     * boton guardar cliente en crear cliente y editar
     */
    $('#guardar_cliente').click(function () {
        var nombre = $('#nombre').val();
        var users_id = $('#users_id').val();
        var nit = $('#nit').val();
        var id = $('#cliente_id').val();
        $.ajax({
            url: RUTAURL + 'guardarSedes',
            data: {"_token": currentToken, cliente_id: id, nombre: nombre, nit: nit, users_id: users_id, sedes: html2json()},
            type: 'post',
            dataType: 'text',
            success: function () {
                window.location = RUTAURL + 'clientes';
            },
            error: function () {

            }
        });
    });

    /**
     * Cuando ya esta creado solo estoy editando
     */
    $('#agregar_sede').click(function () {
        $('#sedes_agregadas').removeClass('hidden');
        var cliente = $(this).context.dataset.cliente_id;
        agregarSedes(cliente);
    });

    /**
     * Cuando voy a crear un cliente por primera vez boton agregar sede
     */
    $('#agregar_sede_first').click(function () {
        $('#sedes_agregadas').removeClass('hidden');
        $('#guardar_cliente').removeClass('hidden');
        var nombre = $('#nombre').val();
        var nit = $('#nit').val();
        var users_id = $('#users_id').val();
        $.ajax({
            url: RUTAURL + 'guardarCliente',
            data: {"_token": currentToken, nombre: nombre, nit: nit, users_id: users_id},
            type: 'post',
            dataType: 'text',
            success: function (data) {
                $('#sedes_agregadas').append(data);
                $('.select2').select2();
            },
            error: function () {

            }
        });
    });


    $('#editarSedeModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var telefono = button.data('telefono');
        var direccion = button.data('direccion');
        var ciudad = button.data('ciudad');
        var usuarios = button.data('usuarios').toString().split(',');
        var id = button.data('id');
        var modal = $(this);
        modal.find('#telefono_sede').val(telefono);
        modal.find('#direccion_sede').val(direccion);
        modal.find('#ciudad_sede').val(ciudad);
        modal.find('#usuarios_sede').val(usuarios).trigger('change');
        modal.find('#sede_id').val(id);
    });

    $('#imprimir_boton').click(function () {
        $('#hoja_imprimir').printArea({extraCss: 'imprimible'});
    });

    window.addEventListener("paste", function (e) {
        retrieveImageFromClipboardAsBase64(e, function (imageDataBase64) {
            if (imageDataBase64) {
                var canvas = document.getElementById("canvas_pagado");
                var ctx = canvas.getContext('2d');
                var img = new Image();
                img.onload = function () {
                    canvas.width = this.width;
                    canvas.height = this.height;
                    ctx.drawImage(img, 0, 0);
                };
                img.src = imageDataBase64;
                $('#imagen_pagado').val(imageDataBase64);
            } else {
                alert('No has copiado ninguna imagen');
            }
        });
    }, false);

    $('#pegarBase64').click(function () {
        let event = new Event("paste", {bubbles: true, cancelable: true});
        window.dispatchEvent(event);
    });

});

function agregarSedes(cliente_id) {
    var users_id = $('#users_id').val();
    $.ajax({
        url: RUTAURL + 'guardarCliente',
        data: {"_token": $('meta[name="csrf-token"]').attr('content'), id: cliente_id, users_id: users_id},
        type: 'post',
        dataType: 'text',
        success: function (data) {
            $('#sedes_agregadas').append(data);
            $('.select2').select2();
        },
        error: function () {

        }
    });
}

function borrarSede(id, element) {
    var currentToken = $('meta[name="csrf-token"]').attr('content');
    bootbox.confirm({
        message: "¿Esta seguro de borra esta sede?",
        buttons: {
            confirm: {
                label: 'Si'
            },
            cancel: {
                label: 'No'
            }
        },
        callback: function (result) {
            if (result) {
                $.ajax({
                    url: RUTAURL + 'borrarSede',
                    data: {sede_id: id, "_token": currentToken},
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        if (data == 'ok') {
                            $(element).parent().parent().remove();
                            bootbox.alert("Sede borrada!");
                        }
                    }
                });
            }
        }
    });
}

function html2json() {
    var json = '{';
    var otArr = [];
    var tbl2 = $('#sedes_agregadas tr.nuevo').each(function (i) {
        x = $(this).children();
        var itArr = [];
        x.each(function (input) {
            var hijo = $(this).children();
            if (hijo[0] && input != 3)
                itArr.push('"' + hijo[0].value + '"');
            if (input == 3) {
                itArr.push('"' + getSelectValues(hijo[0]) + '"');
            }
        });
        otArr.push('"' + i + '": [' + itArr.join(',') + ']');
    });
    json += otArr.join(",") + '}';
    return json;
}

function getSelectValues(select) {
    var result = [];
    var options = select && select.options;
    var opt;
    for (var i = 0, iLen = options.length; i < iLen; i++) {
        opt = options[i];
        if (opt.selected) {
            result.push(opt.value || opt.text);
        }
    }
    return result;
}

function guardarEmail(id) {
    var currentToken = $('meta[name="csrf-token"]').attr('content');
    var email = $('#nuevoEmail').val();
    $.ajax({
        url: RUTAURL + 'updateEmail',
        data: {id: id, "_token": currentToken, email: email},
        type: 'post',
        dataType: 'json',
        beforeSend: function () {
            $('.list-group-item-open span').html('Guardando...').show();
        },
        success: function (data) {
            if (data == 'ok') {
                $('.list-group-item-open span').html(email + ' &emsp13;');
                $('#editarEmail').show();
                $('#formEditarEmail').remove();
            }
        },
        error: function () {
            $('.list-group-item-open span').html('Error');
        }
    });

}

/**
 * @see confirma la oferta para un transportador
 */
function confirmarOferta(id) {
    var currentToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: RUTAURL + 'confirmarOferta',
        data: {oferta_id: id, "_token": currentToken},
        type: 'post',
        dataType: 'json',
        success: function (data) {
            if (data == 'ok') {
                $(".botonera_para_confirmar").hide();
                $(".botonera_para_orden").removeClass("hidden");
                bootbox.alert("Oferta otorgada con exito!");
            }
        }
    });
}

/**
 * @see niega la oferta para un transportador
 */
function negarOferta(id) {
    var currentToken = $('meta[name="csrf-token"]').attr('content');
    bootbox.confirm({
        message: "¿Esta seguro de negar esta oferta?",
        buttons: {
            confirm: {
                label: 'Si'
            },
            cancel: {
                label: 'No'
            }
        },
        callback: function (result) {
            if (result) {
                $.ajax({
                    url: RUTAURL + 'negarOferta',
                    data: {oferta_id: id, "_token": currentToken},
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        if (data == 'ok') {
                            $(".botonera_para_confirmar").hide();
                            $("#conConductor").hide();
                            bootbox.alert("Oferta negada!");
                        }
                    }
                });
            }
        }
    });
}

/**
 * crearOrden
 */
function crearOrdeng(id) {
    var currentToken = $('meta[name="csrf-token"]').attr('content');
    bootbox.confirm({
        size: "small",
        message: "¿Esta seguro de generar esta Orden?",
        buttons: {
            confirm: {
                label: 'Si'
            },
            cancel: {
                label: 'No'
            }
        },
        callback: function (result) {
            if (result) {
                $.ajax({
                    url: RUTAURL + 'nuevaOrden',
                    data: {oferta_id: id, "_token": currentToken},
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        if (data == 'ok') {
                            bootbox.alert("Orden generada con exito!");
                            window.location = RUTAURL + 'oferta/' + id + '#informacion';
                        }
                    }
                });
            }
        }
    });
}

/**
 * crearOrden
 */
function crearOrden(id) {
    var currentToken = $('meta[name="csrf-token"]').attr('content');
    bootbox.prompt({
        title: "Por favor ingrese el consecutivo para la orden",
        buttons: {
            confirm: {
                label: 'Generar'
            },
            cancel: {
                label: 'Cancelar'
            }
        },
        callback: function (result) {
            if (result) {
                $.ajax({
                    url: RUTAURL + 'nuevaOrden',
                    data: {oferta_id: id, consecutivo: result, "_token": currentToken},
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        if (data == 'ok') {
                            bootbox.alert("Orden generada con exito!");
                            window.location = RUTAURL + 'oferta/' + id;
                        }
                    }
                });
            }
        }
    });
}

function manifiesto() {
    $('#modalManifiesto').modal('show');
}

function editarManifiesto() {
    $('#modalManifiestoEditar').modal('show');
}


/**
 * le quito la oferta a un conductor!
 */
function cancelarOferta(id) {
    var currentToken = $('meta[name="csrf-token"]').attr('content');
    bootbox.prompt({
        title: "Por favor indique las razones por la que desea cancelar la oferta",
        inputType: 'textarea',
        buttons: {
            confirm: {
                label: 'Cancelar la oferta'
            },
            cancel: {
                label: 'No cancelar'
            }
        },
        callback: function (result) {
            if (result) {
                $.ajax({
                    url: RUTAURL + 'cancelarOferta',
                    data: {oferta_id: id, razon: result, "_token": currentToken},
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        if (data == 'ok') {
                            window.location = RUTAURL + 'oferta/' + id;
                        }
                    }
                });
            }
        }
    });
}

/**
 * @borrar la oferta
 */
function borrarOferta(id) {
    var oferta_id = id;
    var currentToken = $('meta[name="csrf-token"]').attr('content');
    bootbox.confirm({
        size: "small",
        message: "¿Esta seguro de borrar esta oferta?",
        buttons: {
            confirm: {
                label: 'Si'
            },
            cancel: {
                label: 'No'
            }
        },
        callback: function (result) {
            if (result) {
                $.ajax({
                    url: RUTAURL + 'borrarOferta',
                    data: {"oferta_id": oferta_id, "_token": currentToken},
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        if (data == 'ok') {
                            bootbox.alert("Orden borrada con exito!");
                            window.location = RUTAURL + 'ofertas#sinsolicitar';
                        }
                    }
                });
            }
        }
    });
}



function borrarOfertasRestantes(consecutivo) {
    var currentToken = $('meta[name="csrf-token"]').attr('content');
    bootbox.confirm({
        size: "small",
        message: "¿Esta seguro de borrar las ofertas restantes?",
        buttons: {
            confirm: {
                label: 'Si'
            },
            cancel: {
                label: 'No'
            }
        },
        callback: function (result) {
            if (result) {
                $.ajax({
                    url: RUTAURL + 'borrarOfertasRestantes',
                    data: {consecutivo: consecutivo, _token: currentToken},
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        if (data == 'ok') {
                            bootbox.alert("Orden borrada con exito!");
                            window.location = RUTAURL + 'ofertas#sinsolicitar';
                        }
                    }
                });
            }
        }
    });
}


/**
 * Activo a un nuevo usuario
 */
function activarTransportador(id) {
    var currentToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: RUTAURL + 'activarTransportador',
        data: {transportador_id: id, "_token": currentToken},
        type: 'post',
        dataType: 'json',
        success: function (data) {
            if (data == 'ok') {
                $('#boton_activar').addClass('hidden');
                $('#boton_desactivar').addClass('hidden');
                $('#boton_cancelar').removeClass('hidden');
            }
        }
    });
}

/**
 * Reactivo a un nuevo usuario
 */
function reactivarTransportador(id) {
    var currentToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: RUTAURL + 'reactivarTransportador',
        data: {transportador_id: id, "_token": currentToken},
        type: 'post',
        dataType: 'json',
        success: function (data) {
            if (data == 'ok') {
                $('#boton_reactivar').addClass('hidden');
                $('#boton_cancelar').removeClass('hidden');
            }
        }
    });
}

/**
 * Deniego a un nuevo usuario
 */
function denegarTransportador(id) {
    var currentToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: RUTAURL + 'desactivarTransportador',
        data: {transportador_id: id, "_token": currentToken},
        type: 'post',
        dataType: 'json',
        success: function (data) {
            if (data == 'ok') {
                $('#boton_desactivar').addClass('hidden');
            }
        }
    });
}

/**
 * Cancelo cuenta a un nuevo usuario
 */
function cancelarTransportador(id) {
    var currentToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: RUTAURL + 'cancelarTransportador',
        data: {transportador_id: id, "_token": currentToken},
        type: 'post',
        dataType: 'json',
        success: function (data) {
            if (data == 'ok') {
                $('#boton_cancelar').addClass('hidden');
                $('#boton_reactivar').removeClass('hidden');
            }
        }
    });
}

/*
 *
 * @param {type} id
 * @returns {undefined}
 * Finaliza una oferta por medio de una peticion ajax
 */
function finalizar(id) {
    var currentToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: RUTAURL + 'finalizarOferta',
        data: {id_oferta: id, "_token": currentToken},
        type: 'post',
        dataType: 'json',
        success: function (data) {
            bootbox.alert('Oferta finalizada con exito!');
            $("#finalizar").hide();
        }
    });
}

/**
 * imprime solo el area de la orden
 */
function imprimir(area) {
    $('#area' + area).printArea();
}


function guardarPlantilla() {
    var currentToken = $('meta[name="csrf-token"]').attr('content');
    var form = $("#nuevaOferta .form-control");
    var array = {};
    bootbox.prompt("Nombre de la plantilla", function (result) {
        form.each(function () {
            array[$(this).context.name] = $(this).val();
        });
        if (result != '') {
            array["nombre"] = result;
            array["_token"] = currentToken;
            $.ajax({
                url: RUTAURL + 'guardarPlantilla',
                data: array,
                type: 'post',
                dataType: 'json',
                success: function (data) {
                    $("#botonPlantilla").val("Guardada!");
                },
                beforeSend: function (xhr) {
                    $("#botonPlantilla").val("Guardando...").attr("disabled", true);
                }
            });
        }
    });
}

/**
 * Comment
 */
function aplicarPlantilla() {
    var id = $("#pl").val();
    if (id != "null") {
        window.location = RUTAURL + "nuevaOferta/" + id;
    } else {
        window.location = RUTAURL + "nuevaOferta";
    }
}

function aceptarFotos(id) {
    var currentToken = $('meta[name="csrf-token"]').attr('content');



    bootbox.prompt({
        title: "Por favor ingrese el número de la agencia en la cual se va a planillar el vehículo",
        buttons: {
            confirm: {
                label: 'Aceptar'
            },
            cancel: {
                label: 'Cancelar'
            }
        },
        callback: function (result) {
            if (result) {
                $.ajax({
                    url: RUTAURL + 'aceptarFotos',
                    data: {id: id, "_token": currentToken, numero_agencia: result},
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        $("#pieImagen").hide();
                        $(".botonera_para_manifiesto").removeClass('hidden');
                    }
                });
            }
        }
    });
}

function aceptarFotosRemesa(id) {
    var currentToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: RUTAURL + 'aceptarFotosRemesa',
        data: {id: id, "_token": currentToken},
        type: 'post',
        dataType: 'json',
        success: function (data) {
            $("#pieImagenRemesa").hide();
            $("#finalizar").removeClass('hidden');
            refrescar();
        }
    });
}

function rechazarFotos(id) {
    var currentToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: RUTAURL + 'rechazarFotos',
        data: {id: id, "_token": currentToken},
        type: 'post',
        dataType: 'json',
        success: function (data) {
            $(".imagenes_soporte").hide();
            refrescar();
        }
    });
}

function rechazarFotosRemesa(id) {
    var currentToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: RUTAURL + 'rechazarFotosRemesa',
        data: {id: id, "_token": currentToken},
        type: 'post',
        dataType: 'json',
        success: function (data) {
            $(".imagenes_remesa").hide();
            $("#pieImagenRemesa").hide();
            refrescar();
        }
    });
}

function nuevaMarca() {
    var currentToken = $('meta[name="csrf-token"]').attr('content');
    bootbox.prompt({
        title: "Por favor ingrese el nombre de la marca",
        buttons: {
            confirm: {
                label: 'Crear'
            },
            cancel: {
                label: 'Cancelar'
            }
        },
        callback: function (result) {
            if (result) {
                $.ajax({
                    url: RUTAURL + 'nuevaMarca',
                    data: {marca: result, "_token": currentToken},
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        if (data == 'ok') {
                            bootbox.alert("Marca creada con exito!");
                            window.location = RUTAURL + 'configuracion';
                        }
                    }
                });
            }
        }
    });
}

function nuevaCiudad() {
    var currentToken = $('meta[name="csrf-token"]').attr('content');
    bootbox.prompt({
        title: "Por favor ingrese el nombre de la ciudad",
        buttons: {
            confirm: {
                label: 'Crear'
            },
            cancel: {
                label: 'Cancelar'
            }
        },
        callback: function (result) {
            if (result) {
                $.ajax({
                    url: RUTAURL + 'nuevaCiudad',
                    data: {nombre: result, "_token": currentToken},
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        if (data == 'ok') {
                            bootbox.alert("Ciudad creada con exito!");
                            window.location = RUTAURL + 'configuracion';
                        }
                    }
                });
            }
        }
    });
}

function nuevoRol() {
    var currentToken = $('meta[name="csrf-token"]').attr('content');
    bootbox.prompt({
        title: "Por favor ingrese el nombre del nuevo rol",
        buttons: {
            confirm: {
                label: 'Crear'
            },
            cancel: {
                label: 'Cancelar'
            }
        },
        callback: function (result) {
            if (result) {
                $.ajax({
                    url: RUTAURL + 'nuevoRol',
                    data: {rol: result, "_token": currentToken},
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        if (data == 'ok') {
                            bootbox.alert("Rol creado con exito!");
                            window.location = RUTAURL + 'configuracion';
                        }
                    }
                });
            }
        }
    });
}

function nuevaCarroceria() {
    var currentToken = $('meta[name="csrf-token"]').attr('content');
    bootbox.prompt({
        title: "Por favor ingrese el nombre de la carroceria",
        buttons: {
            confirm: {
                label: 'Crear'
            },
            cancel: {
                label: 'Cancelar'
            }
        },
        callback: function (result) {
            if (result) {
                $.ajax({
                    url: RUTAURL + 'nuevoRol',
                    data: {nombre: result, "_token": currentToken},
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        if (data == 'ok') {
                            bootbox.alert("Carroceria creada con exito!");
                            window.location = RUTAURL + 'configuracion';
                        }
                    }
                });
            }
        }
    });
}

function borrarMarca(id) {
    bootbox.confirm({
        title: "Confirmar",
        message: "¿Realmente desea eliminar esta marca?",
        buttons: {
            cancel: {
                label: '<i class="fa fa-times"></i> Cancelar'
            },
            confirm: {
                label: '<i class="fa fa-check"></i> Eliminar'
            }
        },
        callback: function (result) {
            if (result) {
                var currentToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: RUTAURL + 'borrarMarca',
                    data: {id: id, "_token": currentToken},
                    type: 'post',
                    dataType: 'json',
                    success: function () {
                        window.location = RUTAURL + 'configuracion';
                    }
                });
            }
        }
    });
}

function borrarCiudad(id) {
    bootbox.confirm({
        title: "Confirmar",
        message: "¿Realmente desea eliminar esta ciudad?",
        buttons: {
            cancel: {
                label: '<i class="fa fa-times"></i> Cancelar'
            },
            confirm: {
                label: '<i class="fa fa-check"></i> Eliminar'
            }
        },
        callback: function (result) {
            if (result) {
                var currentToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: RUTAURL + 'borrarCiudad',
                    data: {id: id, "_token": currentToken},
                    type: 'post',
                    dataType: 'json',
                    success: function () {
                        window.location = RUTAURL + 'configuracion';
                    }
                });
            }
        }
    });
}

function borrarAdmin(id) {
    bootbox.confirm({
        title: "Confirmar",
        message: "¿Realmente desea eliminar a este Adminitrador?",
        buttons: {
            cancel: {
                label: '<i class="fa fa-times"></i> Cancelar'
            },
            confirm: {
                label: '<i class="fa fa-check"></i> Eliminar'
            }
        },
        callback: function (result) {
            if (result) {
                var currentToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: RUTAURL + 'borrarAdmin',
                    data: {id: id, "_token": currentToken},
                    type: 'post',
                    dataType: 'json',
                    success: function () {
                        window.location = RUTAURL + 'administradores';
                    }
                });
            }
        }
    });
}

function MostrarPerfil() {
    $('#modificarPerfil1').toggleClass('hidden');
    $('#modificarPerfil2').toggleClass('hidden');
}

function confirmarIngreso(element) {
    var btn = $(element);
    var id = $(element).context.dataset.id;
    var nombre = $(element).context.dataset.nombre;
    var placa = $(element).context.dataset.placa;
    if ($(element).hasClass('btn-success')) {
        bootbox.confirm({
            message: "¿Desea registrar la entrada del Sr. " + nombre + " con placa " + placa + "?",
            buttons: {
                confirm: {
                    label: 'Si'
                },
                cancel: {
                    label: 'No'
                }
            },
            callback: function (result) {
                if (result) {
                    $.ajax({
                        url: RUTAURL + 'registroEntrada',
                        data: {id: id},
                        type: 'post',
                        dataType: 'json',
                        success: function (data) {
                            btn.removeClass('btn-success').addClass('btn-primary').html('Confirmar Salida');
                            $('#ingreso-' + id).html(data);
                        }
                    });
                }
            },
        });

    } else if ($(element).hasClass('btn-primary')) {
        bootbox.confirm({
            message: "¿Desea registrar la salida del Sr. " + nombre + " con placa " + placa + "?",
            buttons: {
                confirm: {
                    label: 'Si'
                },
                cancel: {
                    label: 'No'
                }
            },
            callback: function (result) {
                if (result) {
                    $.ajax({
                        url: RUTAURL + 'registroSalida',
                        data: {id: id},
                        type: 'post',
                        dataType: 'json',
                        success: function (data) {
                            btn.removeClass('btn-primary').prop('disabled', true).html('Confirmado');
                            $('#salida-' + id).html(data);
                        }
                    });
                }
            },
        });
    }
}


/**
 * @see al presionar sobre el botn de pagado en el perfil de finaciero
 */
function pagadoFinanciero(id) {
    $('#modalPagado').modal('show');
    $('#modalPagado').on('shown.bs.modal', function () {
        $("#oferta_id").val(id);
    });
}


function retrieveImageFromClipboardAsBase64(pasteEvent, callback, imageFormat) {

    if (pasteEvent.clipboardData == false) {
        if (typeof (callback) == "function") {
            callback(undefined);
        }
    }

    var items = pasteEvent.clipboardData.items;

    if (items == undefined) {
        if (typeof (callback) == "function") {
            callback(undefined);
        }
    }

    for (var i = 0; i < items.length; i++) {
        if (items[i].type.indexOf("image") == -1)
            continue;

        var blob = items[i].getAsFile();
        var mycanvas = document.createElement("canvas");
        var ctx = mycanvas.getContext('2d');
        var img = new Image();

        img.onload = function () {
            mycanvas.width = this.width;
            mycanvas.height = this.height;
            ctx.drawImage(img, 0, 0);
            if (typeof (callback) == "function") {
                callback(mycanvas.toDataURL(
                        (imageFormat || "image/png")
                        ));
            }
        };

        var URLObj = window.URL || window.webkitURL;
        img.src = URLObj.createObjectURL(blob);
    }
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


function inmodal(obj) {
    $('.enlargeImageModalSource').attr('src', obj.src);
    $('#enlargeImageModal').modal('show');
}
