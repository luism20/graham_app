//Web socket
CANTG = 0;

$(document).ready(function () {

    if (false) {
        var puerto = RUTAURL.slice(0, -1) + ':' + PORT_NODE;
        socket = io(puerto);

        socket.on('message', function (data) {
            llenarNotif(JSON.parse(data));
        });
    }

    $.ajax({
        url: RUTAURL + 'webapi/notificaciones_web',
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
        for (var j in data[i]) {
            cant++;
            if (i == 'conductores')
                ul += '<li><a href="' + RUTAURL + 'cabezotes"><i class="fa fa-user text-red"></i> Asignar vehiculo al conductor "' + data[i][j].user.name + '"</a></li>';
            if (i == 'remesas')
                ul += '<li><a href="' + RUTAURL + 'viaje/' + data[i][j].id + '#remesa"><i class="fa fa-picture-o text-green"></i> Se ha recibido las fotos de remesa de "' + data[i][j].titulo + '"</a></li>';
            if (i == 'basculas')
                ul += '<li><a href="' + RUTAURL + 'viaje/' + data[i][j].id + '"><i class="fa fa-picture-o text-blue"></i> Se ha recibido las fotos de la bascula para "' + data[i][j].titulo + '"</a></li>';
            if (i == 'disponibilidades')
                ul += '<li><a href="' + RUTAURL + 'transportador/' + data[i][j].id + '"><i class="fa fa-vcard text-yellow"></i> Confirme el cambio de estado del conductor ' + data[i][j].user.name + '</a></li>';
        }
    }
    
    $('#cant_notificaciones').html(cant);
    $('#cant_notificaciones_header').html("Usted tiene " + cant + " notificaciones");
    $("#notificaciones").html(ul);

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

function refrescar() {
    $.ajax({
        url: RUTAURL + 'notificaciones_web',
        data: {"_token": $('meta[name="csrf-token"]').attr('content')},
        type: 'post',
        dataType: 'json',
        success: function (data) {
            llenarNotif(data);
        }
    });
}

