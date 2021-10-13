@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="text-center">Weather Info</h4>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Info</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>DATE</th>
                                <th>TIME</th>
                                <th>UNTIL</th>
                                <th>TEMPERATURE</th>
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
                    <h5 class="modal-title">ADD WEATHER INFO</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">TIME</label>
                            <div class="col-sm-10">
                                <input type="time" name="inp[start_time]" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">UNTIL</label>
                            <div class="col-sm-10">
                                <input type="time" name="inp[end_time]" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">TEMPERATURE</label>
                            <div class="col-sm-10">
                                <input type="number" name="inp[temperature]" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">DATE</label>
                            <div class="col-sm-10">
                                <input type="date" name="inp[date]" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">CONDITION</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="inp[condition]">
                                    @foreach ($weathers as $weather)
                                    <option value="{{$weather->id}}">{{$weather->weatherName}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group float-right">

                            <button type="submit" class="btn btn-success px-5"><i class="fa fa-save"></i> Save</button>
                            <button type="reset" class="btn btn-danger px-5"><i class="fa fa-times"></i> Cancel</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="formmodaledit">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated fadeInUp">
                <div class="modal-header">
                    <h5 class="modal-title">EDIT WEATHER INFO</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frmedit">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" id="id" class="form-control" value="">
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">TIME</label>
                            <div class="col-sm-10">
                                <input type="time" name="edit[start_time]" id="start_time" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">UNTIL</label>
                            <div class="col-sm-10">
                                <input type="time" name="edit[end_time]" id="end_time" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">TEMPERATURE</label>
                            <div class="col-sm-10">
                                <input type="number" name="edit[temperature]" id="temperature" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">DATE</label>
                            <div class="col-sm-10">
                                <input type="date" name="edit[date]" id="date" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">CONDITION</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="edit[condition]" id="condition">
                                    @foreach ($weathers as $weather)
                                    <option value="{{$weather->id}}">{{$weather->weatherName}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group float-right">

                            <button type="submit" class="btn btn-success px-5"><i class="fa fa-save"></i> Save</button>
                            <button type="reset" class="btn btn-danger px-5"><i class="fa fa-times"></i> Cancel</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div><!-- End Row-->
@endsection
@section('script')
<script>
    $(document).ready(function() {
        table = $('#example').DataTable({
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
                url: '{{url("getWeatherInfo")}}',
                method: "GET",
                type:'json',
            },

            columns: [
                {
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: "date"
                },
                {
                    data: "start_time"
                },
                {
                    data: "end_time"
                },
                {
                    data: "temperature"
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


    });

    $("#frm").submit(function( event ) {
        event.preventDefault();
        var formData = new FormData($('#frm')[0]);
        $.ajax({
            url: '{{ url("addWeatherInfo") }}',
            type: 'post',
            data: formData,
            contentType: false, //untuk upload image
            processData: false, //untuk upload image
            timeout: 300000, // sets timeout to 3 seconds
            dataType: 'json',
            success: function (e) {
                if(e.status == 'ok;') {
                    swal("Data Berhasil Diinput!", {
                        icon: "success",
                    });
                    $('#example').DataTable().ajax.reload();
                    $('#formmodal').modal('toggle');
                } else {
                    alert(e.text);
                }
            }
        });
    });

    $("#frmedit").submit(function( event ) {
        event.preventDefault();
        var formData = new FormData($('#frmedit')[0]);
        $.ajax({
            url: '{{ url("updateWeatherInfo") }}',
            type: 'post',
            data: formData,
            contentType: false, //untuk upload image
            processData: false, //untuk upload image
            timeout: 300000, // sets timeout to 3 seconds
            dataType: 'json',
            success: function (e) {
                if(e.status == 'ok;') {
                    swal("Data Berhasil Diubah!", {
                        icon: "success",
                    });
                    $('#example').DataTable().ajax.reload();
                    $('#formmodaledit').modal('toggle');
                } else {
                    alert(e.text);
                }
            }
        });
    });

    function edit(id)
    {
        $.ajax({
            url:'{{ url("editWeatherInfo") }}',
            type:'post',
            dataType:'json',
            data: ({ id : id }),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(e) {
                $('#id').val(id);
                $.each(e, function(key, value) {
                    $('#'+key).val(value);
                });
                $('#example').DataTable().ajax.reload();
                $('#formmodaledit').modal({keyboard: false, backdrop: 'static'});
            }
        });
    }

    function del(id) {
        swal({
            title: 'Apakah Anda Yakin?',
            // text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result) {
                $.ajax({
                    url: '{{ url("deleteWeather") }}',
                    type: 'post',
                    dataType: 'json',
                    data: ({
                        id: id
                    }),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (e) {
                        if (e.status == 'ok;') {
                            swal(
                                'Deleted!',
                                'Data Berhasil Dihapus.',
                                'success'
                            );
                            $('#example').DataTable().ajax.reload();
                        } else {
                            alert(e.text);
                        }
                    }
                });
            }
        })
    }
    </script>
@endsection