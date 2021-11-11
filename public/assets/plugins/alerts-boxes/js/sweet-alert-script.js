
$(document).ready(function () {

  $("#alert-basic").click(function () {
    swal("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat, tincidunt vitae ipsum et, pellentesque maximus enim. Mauris eleifend ex semper, lobortis purus sed, pharetra felis");
  });

  $("#alert-title").click(function () {
    swal("Here's the title!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat, tincidunt vitae ipsum et, pellentesque maximus enim. Mauris eleifend ex semper, lobortis purus sed, pharetra felis");
  });

  $("#alert-success").click(function () {
    swal("Good job!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat, tincidunt vitae ipsum et, pellentesque maximus enim. Mauris eleifend ex semper, lobortis purus sed, pharetra felis", "success");
  });

  $("#alert-error").click(function () {
    swal("Somthing Wrong!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat, tincidunt vitae ipsum et, pellentesque maximus enim. Mauris eleifend ex semper, lobortis purus sed, pharetra felis,", "error");
  });

  $("#alert-info").click(function () {
    swal("Information!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat, tincidunt vitae ipsum et, pellentesque maximus enim. Mauris eleifend ex semper, lobortis purus sed, pharetra felis,", "info");
  });

  $("#alert-warning").click(function () {
    swal("Warning!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat, tincidunt vitae ipsum et, pellentesque maximus enim. Mauris eleifend ex semper, lobortis purus sed, pharetra felis,", "warning");
  });


  $("#confirm-btn-alert").click(function () {

    swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover this imaginary file!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
      .then((willDelete) => {
        if (willDelete) {
          swal("Poof! Your imaginary file has been deleted!", {
            icon: "success",
          });
        } else {
          swal("Your imaginary file is safe!");
        }
      });

  });

 

});

function successAlert(type, msg, condition) {
  if (condition == 'success') {
    status = 'Success';
  } else {
    status = 'Failed';
  }
  if(type=='Update'){
    swal("Success", 'Data with id#' + msg + ' has ' + status + ' to ' + type, "success");
  }else{
    swal("Success", 'Data ' + msg + ' has ' + status + ' to ' + type, "success");
  }
  
}

function loginAlert(type, msg, condition) {
  
    swal("Failed","Failed ! Wrong Username or Password", "error");
}

function emptyAlert(type, msg, condition) {
  if(type=="input"){
    swal(msg,"Please fill "+msg+" field first!", "warning");
  }else if(type=="session"){
    swal("Warning","Please Create or Set your Project first!", "warning");
  }
}

function errorAlert(type, msg, condition) {
  if (condition == 'success') {
    status = 'Success';
  } else {
    status = 'Failed';
  }
  swal("Failed", 'Data with id#' + msg + ' has ' + status + ' to ' + type, "error");
}

function errorAlertServer(type, msg, condition) {
  if (condition == 'success') {
    status = 'Success';
  } else {
    status = 'Failed';
  }
  swal("Failed", 'Response Not Found, Please Check Your Data', "error");
}