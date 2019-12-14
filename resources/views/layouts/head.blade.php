<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> @yield('title') </title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="csrf-token" content="<?php echo csrf_token() ?>">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="{{ asset('css/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/bootstrap/css/bootstrap-datetimepicker.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/font-awesome-4.7.0/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{asset('/css/ionicons-2.0.1/css/ionicons.min.css')}}">
        <link rel="stylesheet" href="{{ asset('css/AdminLTE.css') }}">
        <link rel="stylesheet" href="{{asset('css/skins/_all-skins.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/iCheck/flat/blue.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/morris/morris.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/datepicker/datepicker3.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.0/css/buttons.dataTables.min.css">
        <link rel="stylesheet" href="{{asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
        <link rel="stylesheet" href="{{ asset('plugins/jquery-confirm-v3.3.4/css/jquery-confirm.css') }}">
        <link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}"/>
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
        <link rel="stylesheet" href="{{ asset('css/spacing.css') }}">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/favicon.ico') }}">
        

        <script src="{{asset('plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
        <script src="https://maps.googleapis.com/maps/api/js?libraries=drawing&key=AIzaSyB24YFTCfDBM7uEM8z1AU7tIo6ZDpl2ojA"></script>
    </head>
    <body class="hold-transition skin-green sidebar-mini">
        <div class="wrapper">           
            @include('layouts.navbar')
            @include('layouts.menu')           
            @yield('content')
            @include('layouts.footer')
        </div>
        @include('layouts.modals')
        <script src="{{asset('js/jquery-ui.min.js')}}"></script>
        <script> $.widget.bridge('uibutton', $.ui.button);</script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/raphael-min.js')}}"></script>
        <script src="{{asset('plugins/morris/morris.min.js')}}"></script>
        <script src="{{asset('plugins/sparkline/jquery.sparkline.min.js')}}"></script>
        <script src="{{asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
        <script src="{{asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
        <script src="{{asset('plugins/knob/jquery.knob.js')}}"></script>
        <script src="{{asset('js/moment.min.js')}}"></script>
        <script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
        <script src="{{asset('plugins/datepicker/bootstrap-datepicker.js')}}"></script>
        <script src="{{asset('js/bootstrap-datetimepicker.js')}}"></script>
        <script src="{{asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
        <script src="{{asset('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
        <script src="{{asset('plugins/fastclick/fastclick.js')}}"></script>
        <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
        <script src="{{asset('plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
        <script src="{{asset('plugins/jquery-confirm-v3.3.4/dist/jquery-confirm.min.js')}}"></script>
        <script src="{{asset('js/jquery.PrintArea.js')}}"></script>
        <script src="{{asset('js/jquery.priceformat.min.js')}}"></script>
        <script src="{{asset('plugins/select2/select2.full.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/jquery.jCombo.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/jquery.form.min.js')}}"></script>
        <script src="{{asset('js/app.min.js')}}"></script>
        <script src="{{asset('js/bootbox.js')}}"></script>
        <script src="{{asset('js/pages/dashboard.v4.js')}}"></script>
        <script src="{{asset('js/socket.io-1.4.5.js')}}"></script>
        <script src="{{asset('js/push.js')}}"></script>
        <script src="{{asset('js/demo.js')}}"></script>
        <script src="https://cdn.datatables.net/buttons/1.4.0/js/dataTables.buttons.min.js" type="text/javascript"></script>
        <script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.flash.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" type="text/javascript"></script>
        <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"type="text/javascript"></script>
        <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js" type="text/javascript"></script>
        <script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.html5.min.js" type="text/javascript"></script>
        <script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.print.min.js" type="text/javascript"></script>
        <script>
            $(document).ready(function () {
                openMenu();
            });

            function openMenu() {
                var urlMenu = location.href;
                $('.sidebar-menu li').each(function () {
                    var isThis = $(this);
                    var a = $(this).children().first();
                    var href = a.attr("href");
                    if (href == '#') {
                        $(this).children('ul').children().each(function () {
                            var a = $(this).children().first();
                            var href2 = a.attr("href");
                            if (urlMenu.indexOf(href2) !== -1) {
                                $(this).addClass('active');
                                isThis.addClass('active menu-open')
                            }
                        });
                    } else if (urlMenu.indexOf(href) !== -1) {
                        $(this).addClass('active');
                    }
                });
            }

            function openModal(){
                $('#onboarding').modal();
            }

            function confirmation(e, object, id) {
                e.preventDefault();
                return $.confirm({
                    title: 'Confirm!',
                    type: 'red',
                    content: 'Do you really want to delete ' + object + '?',
                    buttons: {
                        confirm: {
                            btnClass: 'btn-danger',
                            action: function () {
                                $(id).submit();
                            }
                        },
                        cancel: {
                            action: function () {
                                return;
                            }
                        }
                    }
                });
            }
        </script>
    </body>
</html>