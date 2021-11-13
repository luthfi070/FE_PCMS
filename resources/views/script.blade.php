<script src="{{url('assets/js/jquery.min.js')}}"></script>
<script src="{{url('assets/js/popper.min.js')}}"></script>
<script src="{{url('assets/js/bootstrap.min.js')}}"></script>
{{-- <script src="{{url('assets/plugins/raphael/raphael-min.js')}}"></script> --}}
{{-- <script src="{{url('assets/plugins/morris/js/morris.js')}}"></script> --}}

<!-- simplebar js -->
<script src="{{url('assets/plugins/simplebar/js/simplebar.js')}}"></script>
<!-- sidebar-menu js -->
<script src="{{url('assets/js/sidebar-menu.js')}}"></script>

<!-- Custom scripts -->
<script src="{{url('assets/js/app-script.js')}}"></script>

<!-- Chart js -->
{{-- <script src="{{url('assets/plugins/Chart.js/Chart.min.js')}}"></script> --}}
<!--Peity Chart -->
<script src="{{url('assets/plugins/peity/jquery.peity.min.js')}}"></script>
<!-- Index2 js -->
{{-- <script src="{{url('assets/js/service-support.js')}}"></script> --}}
<script src="{{url('assets/plugins/bootstrap-datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{url('assets/plugins/bootstrap-datatable/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{url('assets/plugins/bootstrap-datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{url('assets/plugins/bootstrap-datatable/js/buttons.bootstrap4.min.js')}}"></script>
{{-- <script src="{{url('assets/plugins/bootstrap-datatable/js/jszip.min.js')}}"></script> --}}
{{-- <script src="{{url('assets/plugins/bootstrap-datatable/js/pdfmake.min.js')}}"></script> --}}
<script src="{{url('assets/plugins/bootstrap-datatable/js/vfs_fonts.js')}}"></script>
<script src="{{url('assets/plugins/bootstrap-datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{url('assets/plugins/bootstrap-datatable/js/buttons.print.min.js')}}"></script>
<script src="{{url('assets/plugins/bootstrap-datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{url('assets/plugins/alerts-boxes/js/sweetalert.min.js')}}"></script>
<script src="{{url('assets/plugins/alerts-boxes/js/sweet-alert-script.js')}}"></script>
<script src="{{url('assets/plugins/notifications/js/lobibox.min.js')}}"></script>
<script src="{{url('assets/plugins/notifications/js/notifications.min.js')}}"></script>
<script src="{{url('assets/plugins/notifications/js/notification-custom-script.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{url('assets/plugins/jquery-validation/js/jquery.validate.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js" integrity="sha512-Tn2m0TIpgVyTzzvmxLNuqbSJH3JP8jm+Cy3hvHrW7ndTDcJ1w5mBiksqDBb8GpE2ksktFvDB/ykZ0mDpsZj20w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $('.Planning').hide();
    $('.Report').hide();
    $('.Master').hide();
    $('.Execute').hide();
    $('#Execute2_parent').hide();

    for (var i = 0; i < 7; i++) {
        $('#Planning' + i).hide();
    }

    for (var i = 0; i < 12; i++) {
        $('#Execute' + i).hide();
    }

    for (var i = 0; i < 12; i++) {
        $('#Master' + i).hide();
    }

    $('#Report1').hide();

    $.ajax({
        type: "POST",
        url: '/getPrivilegedPage',
        data: {
            _token: "{{ csrf_token() }}",
        },
        dataType: 'JSON'
    }).done(function(msg) {
        if (msg[0].PrivilegedStatus == 1) {
            $('.Planning').show();
            $('.Report').show();
            $('.Master').show();
            $('.Execute').show();
            $('#Execute2_parent').show();
            for (var i = 0; i < 7; i++) {
                $('#Planning' + i).show();
            }

            for (var i = 0; i < 12; i++) {
                $('#Execute' + i).show();
            }

            for (var i = 0; i < 12; i++) {
                $('#Master' + i).show();
            }

            $('#Report1').show();
        } else {
            for (var i = 0; i < msg.length; i++) {

                if (msg[i].UserPrivileged.includes("Planning")) {
                    $('.Planning').show();
                } else if (msg[i].UserPrivileged.includes("Report")) {
                    $('.Report').show();
                } else if (msg[i].UserPrivileged.includes("Master")) {
                    $('.Master').show();
                } else if (msg[i].UserPrivileged.includes("Execute")) {
                    $('.Execute').show();
                }
                if (msg[i].UserPrivileged == "Execute2" || msg[i].UserPrivileged == "Execute3" || msg[i].UserPrivileged == "Execute4" || msg[i].UserPrivileged == "Execute5") {
                    $('#Execute2_parent').show();
                }
                $('#' + msg[i].UserPrivileged).show();
            }

        }
    }).fail(function(jqXHR, textStatus, errorThrown) {
        errorAlertServer('Response Not Found, Please Check Your Data');
    });

    var id="<?php echo session('ProjectID'); ?>";

    $.ajax({
        type: "POST",
        url: '/getContractor',
        data: {
            _token: "{{ csrf_token() }}",
            id: id=="" ? 0:id
        },
        dataType: "JSON"
    }).done(function(msg) {
        var option = "<option value='0' selected>-- Select Contractor Name --</option>";
        for (var i = 0; i < msg.length; i++) {
      
            option += "<option value='" + msg[i].id + "'>" + msg[i].BussinessName + "</option>";
            
        }
        $('#contractor-list').html(option);

    }).fail(function(jqXHR, textStatus, errorThrown) {
        errorAlertServer('Response Not Found, Please Check Your Data');
    });
</script>

@yield('script')