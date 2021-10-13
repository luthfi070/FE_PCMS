@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="text-center">SETTING</h4>
            </div>
        </div>
    </div>
</div>
<div class="card card-authentication1 mx-auto my-5">
    <div class="card-body">
        <div class="card-content p-2">
            <div class="card-title text-uppercase pb-2">Reset Password</div>
            <p class="pb-2">Please enter your current and new password</p>
            <form id="Editpassword">
                <div class="form-group">
                    <label for="exampleInputEmailAddress" class="">New Password</label>
                    <div class="position-relative has-icon-right">
                        <input type="hidden" id="idUser2" name="idUser2" class="form-control" value="{{session('UserID')}}">
                        <input type="password" id="passwordEdit" name="passwordEdit" class="form-control input-shadow" placeholder="New Password">
                        <div class="form-control-position">
                            <i class="icon-key"></i>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmailAddress" class="">Verify New Password</label>
                    <div class="position-relative has-icon-right">
                        <input type="password" id="password2" class="form-control input-shadow" placeholder="Verify New Password">
                        <div class="form-control-position">
                            <i class="icon-key"></i>
                        </div>
                    </div>
                </div>
            </form>
            <button type="button" id="btn-reset-pass" class="btn btn-light btn-block mt-3">Reset Password</button>

        </div>
    </div>
</div>

@endsection
@section('script')

<script>
    $(document).ready(function() {
        $('#btn-reset-pass').click(function(e) {
            e.preventDefault;
            if ($('#passwordEdit').val() == $('#password2').val()) {
                $.ajax({
                    type: "POST",
                    url: '/updateUserPassword',
                    data: $('#Editpassword').serialize() + "&_token=" + '{{ csrf_token() }}'
                }).done(function(msg) {
                    datob = JSON.parse(msg);
                    $('#example').DataTable().ajax.reload();
                    if (datob != 'error') {
                        successAlert('Update', "Password", 'success');
                        $('#passwordEdit').val('');
                        $('#password2').val('');
                    } else {
                        errorAlert('Update', "Password", 'error');
                        $('#passwordEdit').val('');
                        $('#password2').val('');
                    }
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    errorAlertServer('Response Not Found, Please Check Your Data');
                });

            } else {
                swal({
                    title: "Fail",
                    text: "Password Not Matched, Please Try Again !",
                    icon: "error",
                    // buttons: true,
                    dangerMode: true,
                });
            }

        });
    });
</script>
@endsection