@extends('app')
@section('content')
<style>
    .selectWeather {
  font-family: 'FontAwesome', 'sans-serif';
}
</style>
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="text-center">Weather Conditions</i></h4>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Position</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>CONDITION NAME</th>
                                <th>SYMBOL</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="formmodal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated fadeInUp">
                <div class="modal-header">
                    <h5 class="modal-title">ADD WEATHER</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                
                    <form>
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">CONDITION NAME </label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" id="weatherName" placeholder="Enter Your Condition">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">SYMBOL</label>
                            <div class="col-sm-10">
                                <select id="symbolWeather" class="selectWeather form-control">
                                    <option value="<i class='fas fa-bolt'></i>">&#xf0e7; Bolt</option>
                                    <option value="<i class='fas fa-wind'></i>">&#xf72e; Wind</option>
                                    <option value="<i class='fas fa-water'></i>">&#xf773; Water</option>
                                    <option value="<i class='fas fa-temperature-low'></i>">&#xf76b; Low Temperature</option>
                                    <option value="<i class='fas fa-temperature-high'></i>">&#xf769; High Temperature</option>
                                    <option value="<i class='fas fa-sun'>">&#xf185; Sun</option>
                                    <option value="<i class='fas fa-snowflake'></i>">&#xf2dc; Snow</option>
                                    <option value="<i class='fas fa-smog'></i>">&#xf75f; Smog</option>
                                    <option value="<i class='fas fa-rainbow'></i>">&#xf75b; Rainbow</option>
                                    <option value="<i class='fas fa-poo-storm'></i>">&#xf75a; Storm</option>
                                    <option value="<i class='fas fa-meteor'></i>">&#xf753; Meteor</option>
                                    <option value="<i class='fas fa-cloud-sun-rain'></i>">&#xf743; Sunny Rain</option>
                                    <option value="<i class='fas fa-cloud-sun'></i>">&#xf6c4; Cloudy</option>
                                    <option value="<i class='fas fa-cloud-showers-heavy'></i>">&#xf740; Heavy Rain</option>
                                    <option value="<i class='fas fa-cloud-rain'></i>">&#xf73d; Cloudy Rain</option>
                                    <option value="<i class='fas fa-cloud-moon-rain'></i>">&#xf73c;Moon Rain</option>
                                    <option value="<i class='fas fa-cloud-moon'></i>">&#xf6c3;Moon</option>
                                    <option value="<i class='fas fa-cloud-meatball'></i>">&#xf73b;Heavy Cloud</option>
                                </select>
                            </div>
                        </div>
                    </form>
                    <div class="form-group float-right">
                        <button class="btn btn-success px-5" id="btn-submit-add"><i class="fa fa-save"></i> Save</button>
                        <button type="reset" class="btn btn-danger px-5" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i> Cancel</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="formmodaledit">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated fadeInUp">
                <div class="modal-header">
                    <h5 class="modal-title">EDIT WEATHER CONDITIONS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                    <input type="hidden" id="idWeatherEdit" class="form-control">
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">CONDITION NAME</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" id="weatherNameEdit" placeholder="Enter Your Position">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">SYMBOL</label>
                            <div class="col-sm-10">
                            <select id="symbolWeatherEdit" class="selectWeather form-control">
                            <option value="<i class='fas fa-bolt'></i>">&#xf0e7; Bolt</option>
                                    <option value="<i class='fas fa-wind'></i>">&#xf72e; Wind</option>
                                    <option value="<i class='fas fa-water'></i>">&#xf773; Water</option>
                                    <option value="<i class='fas fa-temperature-low'></i>">&#xf76b; Low Temperature</option>
                                    <option value="<i class='fas fa-temperature-high'></i>">&#xf769; High Temperature</option>
                                    <option value="<i class='fas fa-sun'>">&#xf185; Sun</option>
                                    <option value="<i class='fas fa-snowflake'></i>">&#xf2dc; Snow</option>
                                    <option value="<i class='fas fa-smog'></i>">&#xf75f; Smog</option>
                                    <option value="<i class='fas fa-rainbow'></i>">&#xf75b; Rainbow</option>
                                    <option value="<i class='fas fa-poo-storm'></i>">&#xf75a; Storm</option>
                                    <option value="<i class='fas fa-meteor'></i>">&#xf753; Meteor</option>
                                    <option value="<i class='fas fa-cloud-sun-rain'></i>">&#xf743; Sunny Rain</option>
                                    <option value="<i class='fas fa-cloud-sun'></i>">&#xf6c4; Cloudy</option>
                                    <option value="<i class='fas fa-cloud-showers-heavy'></i>">&#xf740; Heavy Rain</option>
                                    <option value="<i class='fas fa-cloud-rain'></i>">&#xf73d; Cloudy Rain</option>
                                    <option value="<i class='fas fa-cloud-moon-rain'></i>">&#xf73c; Moon Rain</option>
                                    <option value="<i class='fas fa-cloud-moon'></i>">&#xf6c3; Moon</option>
                                    <option value="<i class='fas fa-cloud-meatball'></i>">&#xf73b; Heavy Cloud</option>
                                </select>
                            </div>
                        </div>
                    </form>
                    <div class="form-group float-right">
                        <button class="btn btn-success px-5" id="btn-submit-edit"><i class="fa fa-save"></i> Save</button>
                        <button type="reset" class="btn btn-danger px-5" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i> Cancel</button>
                    </div>
                </div>

            </div>
        </div>
    </div>



</div><!-- End Row-->
@endsection
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
@section('script')
<script>
    $(document).ready(function() {
        
        //Default data table
        $('#default-datatable').DataTable();


        var table = $('#example').DataTable({
            lengthChange: false,
            //buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
            buttons: [{
                text: 'New',
                className: 'btn-primary',
                action: function(e, dt, button, config) {
                    $('#formmodal').modal('toggle');
                }
            }],
            ajax: {
                url: '/getWeather',
                method: "GET",
                dataSrc: "",
                data: {
                    _token: "{{ csrf_token() }}",
                }
            },
            columns: [{
                    data: "no"
                },
                {
                    data: "weatherName"
                },
                {
                    data: "symbol"
                },
                {
                    data: "action"
                }
            ],
            initComplete: function() {
                table.buttons().container()
                    .appendTo('#example_wrapper .col-md-6:eq(0)');
            }
        });

        $('#example tbody').on('click', '.edit-btn', function() {
            var id = $(this).data("id");
            $.ajax({
                type: "POST",
                url: '/getWeatherByid',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                }
            }).done(function(msg) {
                datob = JSON.parse(msg);
                $('#symbolWeatherEdit').val(datob[0].symbol);
                $('#weatherNameEdit').val(datob[0].weatherName);
                $('#idWeatherEdit').val(datob[0].id);
                $('#formmodaledit').modal('show');
            });
        });

        $('#btn-submit-edit').click(function(e) {
            e.preventDefault;
            $.ajax({
                type: "POST",
                url: '/updateWeather',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: $('#idWeatherEdit').val(),
                    symbol: $('#symbolWeatherEdit').val(),
                    name: $('#weatherNameEdit').val(),
                }
            }).done(function(msg) {
                datob = JSON.parse(msg);
                $('#example').DataTable().ajax.reload();
                if (datob != 'error') {
                    successAlert('Update', $('#idWeatherEdit').val(), 'success');
                } else {
                    errorAlert('Update', $('#idWeatherEdit').val(), 'error');
                }
                $('#formmodaledit').modal('toggle');
            });

        });

        $('#btn-submit-add').click(function(e) {
            e.preventDefault;
            $.ajax({
                type: "POST",
                url: '/addWeather',
                data: {
                    _token: "{{ csrf_token() }}",
                    symbol: $('#symbolWeather').val(),
                    name: $('#weatherName').val(),
                }
            }).done(function(msg) {
                datob = JSON.parse(msg);
                $('#example').DataTable().ajax.reload();
                if (datob != 'error') {
                    successAlert('Add', $('#weatherName').val(), 'success');
                    $('#weatherName').val('');
                    $('#symbolWeather').val('');
                } else {
                    errorAlert('Add', $('#weatherName').val(), 'error');
                    $('#weatherName').val('');
                    $('#symbolWeather').val('');
                }
                $('#formmodal').modal('toggle');
            });

        });

        $('#example tbody').on('click', '.confirm-btn-alert', function() {
            idData = $(this).attr('data-ids');
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this data!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: "POST",
                            url: '/deleteWeather',
                            data: {
                                _token: "{{ csrf_token() }}",
                                id: idData
                            }
                        }).done(function(msg) {
                            datob = JSON.parse(msg);
                            $('#example').DataTable().ajax.reload();
                            if (datob != 'error') {
                                swal("Your Data has been deleted!", {
                                    icon: "success",
                                });
                            } else {
                                swal("Your Data has Failed to delete!", {
                                    icon: "error",
                                });
                            }
                        });

                    } else {
                        swal("Your Data is safe!");
                    }
                });

        });

    });
</script>
@endsection