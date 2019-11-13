//Web socket
CANTG = 0;

$(document).ready(function () {

    var puerto = RUTAURL.slice(0, -1) + ':' + PORT_NODE;
    socket = io(puerto);

    socket.on('financiero-' + IDFINANCIERO, function (data) {
        llenarNotif(JSON.parse(data));
    });

    socket.on('financiero-html-' + IDFINANCIERO, function (html) {
        $("#financiero-NP-" + IDFINANCIERO).html(html);
    });


    $.ajax({
        url: RUTAURL + 'notificaciones_financiero',
        data: {"_token": $('meta[name="csrf-token"]').attr('content')},
        type: 'post',
        dataType: 'json',
        success: function (data) {
            llenarNotif(data);
        }
    });
});

//Notificaciones
function llenarNotif(data) {
    var cant = 0;
    var ul = "";
    for (var i in data) {
        cant++;
        ul += '<li><a href="inicio"><i class="fa fa-user text-red"></i> Ha ingresado una nueva solicitud de anticipo </a></li>';
    }

    $('#cant_notificaciones').html(cant);
    $('#cant_notificaciones_header').html("Usted tiene " + cant + " notificaciones");
    $("#notificaciones").html(ul);
    $('.notifications-menu .footer').hide();

    if (cant > localStorage.CANTNOTIF && cant != 0) {
        localStorage.CANTNOTIF = cant;
        Push.Permission.request(accept, function () {});
    }
    if (cant < localStorage.CANTNOTIF) {
        localStorage.CANTNOTIF = cant;
    }
}


function isIn(id, jsons) {
    for (item in jsons) {
        if (jsons[item] == id)
            return true;
    }
    return false;
}

function accept() {
    Push.create("Fleteya Colombia", {
        body: 'Tienes nuevas notificaciones en el Administrador',
        icon: RUTAURL + 'img/icon.png',
        timeout: 4000,
        onClick: function () {
            window.focus();
            this.close();
        }
    });
}

