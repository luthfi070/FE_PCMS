@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="text-center">Monthly Meeting</h4>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Meeting</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>DATE</th>
                                <th>SUBJECT</th>
                                <th>AGENDA</th>
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
                    <h5 class="modal-title">ADD MONTHLY MEETING</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm">
                        {{ csrf_field() }}
                        <input type="hidden" name="inp[ProjectID]" value="{{Session::get('ProjectID')}}">
                        {{-- <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">PROJECT NAME</label>
                            <div class="col-sm-10">
                                <p>TEST</p>
                            </div>
                        </div> --}}
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">MEETING DATE</label>
                            <div class="col-sm-10">
                                <input type="date" name="inp[meeting_date]"class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">SUBJECT</label>
                            <div class="col-sm-10">
                                <input type="text" name="inp[subject]"class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">AGENDA</label>
                            <div class="col-sm-10">
                                <input type="text" name="inp[agenda]"class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">ATTACH FILE</label>
                            <div class="col-sm-10">
                                <input type="file" name="inp[file]"class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">PERSON</label>
                            <div class="col-sm-10">
                                <input type="text" name="inp[attendee]" class="form-control" id="attendeetoken">
                            </div>
                        </div>
                        {{-- <div class="form-group row">
                            <div class="container p-3 m-3 border">
                                <div class="form-group row">
                                    <label for="input-23" class="col-sm-2 col-form-label">COMPANY</label>
                                    <div class="col-sm-10">
                                        <select class="form-control">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-23" class="col-sm-2 col-form-label">PERSON</label>
                                    <div class="col-sm-7">
                                        <select class="form-control">
                                            <option></option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <button class="btn btn-success waves-effect waves-light m-1">Save</button>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="example2" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>COMPANY</th>
                                                <th>PERSON</th>
                                                <th>ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>TEST</td>
                                                <td>TEST</td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-danger  waves-effect waves-light m-1">DELETE</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> --}}

                        <div class="form-group float-right">

                            <button type="submit" class="btn btn-success px-5"><i class="fa fa-save"></i> Save</button>
                            <button type="reset" class="btn btn-danger px-5" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i> Cancel</button>

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
                    <h5 class="modal-title">EDIT MONTHLY MEETING</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frmedit">
                        {{ csrf_field() }}
                        <input type="hidden" name="edit[ProjectID]" id="ProjectID" value="{{Session::get('ProjectID')}}">
                        <input type="hidden" name="id" id="id">
                        {{-- <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">PROJECT NAME</label>
                            <div class="col-sm-10">
                                <p>TEST</p>
                            </div>
                        </div> --}}
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">MEETING DATE</label>
                            <div class="col-sm-10">
                                <input type="date" name="edit[meeting_date]" id="meeting_date" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">SUBJECT</label>
                            <div class="col-sm-10">
                                <input type="text" name="edit[subject]" id="subject" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">AGENDA</label>
                            <div class="col-sm-10">
                                <input type="text" name="edit[agenda]" id="agenda" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">ATTACH FILE</label>
                            <div class="col-sm-10">
                                <input type="file" name="edit[file]" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">PERSON</label>
                            <div class="col-sm-10">
                                <input type="text" name="edit[attendee]" id="attendee" class="form-control" id="attendee">
                            </div>
                        </div>
                        {{-- <div class="form-group row">
                            <div class="container p-3 m-3 border">
                                <div class="form-group row">
                                    <label for="input-23" class="col-sm-2 col-form-label">COMPANY</label>
                                    <div class="col-sm-10">
                                        <select class="form-control">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-23" class="col-sm-2 col-form-label">PERSON</label>
                                    <div class="col-sm-7">
                                        <select class="form-control">
                                            <option></option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <button class="btn btn-success waves-effect waves-light m-1">Save</button>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="example2" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>COMPANY</th>
                                                <th>PERSON</th>
                                                <th>ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>TEST</td>
                                                <td>TEST</td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-danger  waves-effect waves-light m-1">DELETE</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> --}}

                        <div class="form-group float-right">

                            <button type="submit" class="btn btn-success px-5"><i class="fa fa-save"></i> Save</button>
                            <button type="reset" class="btn btn-danger px-5" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i> Cancel</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div><!-- End Row-->
@endsection
@section('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.min.js" integrity="sha512-lUZZrGg8oiRBygP81yUZ4XkAbmeJn7u7HW5nq7npQ+ZXTRvj3ErL6y1XXDq6fujbiJlu6gHsgNUZLKE6eSDm8w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.min.css" integrity="sha512-YWDtZYKUekuPMIzojX205b/D7yCj/ZM82P4hkqc9ZctHtQjvq3ei11EvAmqxQoyrIFBd9Uhfn/X6nJ1Nnp+F7A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
                url: '{{url("getMeeting")}}',
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
                    data: "meeting_date"
                },
                {
                    data: "subject"
                },
                {
                    data: "agenda"
                },
                {
                    data: "action"
                },
            ],
            initComplete: function() {
                table.buttons().container()
                    .appendTo('#example_wrapper .col-md-6:eq(0)');
            }
        });


    });

    $('#attendeetoken').tokenfield();
    $('#attendee').tokenfield();

    $("#frm").submit(function( event ) {
        event.preventDefault();
        var formData = new FormData($('#frm')[0]);
        $.ajax({
            url: '{{ url("addMeeting") }}',
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
            url: '{{ url("updateMeeting") }}',
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
            url:'{{ url("editMeeting") }}',
            type:'post',
            dataType:'json',
            data: ({ id : id }),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(e) {
                $('#id').val(id);
                $.each(e, function(key, value) {
                    if (key == 'attendee') {
                        let tokenvalue = value.split(',')
                        $('#'+key).tokenfield('setTokens', tokenvalue);
                    }else{
                        $('#'+key).val(value);
                    }
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
                    url: '{{ url("deleteMeeting") }}',
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