$(document).ready(() => {
  //Register script
  $("#register-btn").click((e) => {
    if ($("#register-form")[0].checkValidity()) {
      e.preventDefault();
      $("#register-btn").val("Please wait...");
      if ($("#r-password").val() !== $("#cpassword").val()) {
        $("#register-btn").val("Sign Up");
        $("#passMsg").text("Passwords do not match");
      } else {
        $("#passMsg").text("");
        $.ajax({
          url: "config/controller.php",
          method: "post",
          data: $("#register-form").serialize() + "&action=register",
          success: function (response) {
            // if (response === "Registered") {
            //   window.location = "home.php";
            // } else {
            //   $("#regAlert").html(response);
            //   $("#register-btn").val("Sign Up");
            // }
            $("#regAlert").html(response);
              $("#register-btn").val("Sign Up");
               $("#register-form")[0].reset();
            console.log(response);
          },
        });
      }
    }
  });

  // Login script
  $("#login-btn").click((e) => {
    if ($("#login-form")[0].checkValidity()) {
      e.preventDefault();
      $("#login-btn").val("Please wait...");
      $.ajax({
        url: "config/controller.php",
        method: "post",
        data: $("#login-form").serialize() + "&action=login",
        success: (res) => {
          console.log(res);
          //   if (res === "login") {
          //     window.location = "home.php";
          //   } else {
          //     $("#loginAlert").html(res);
          //     $("#login-btn").val("Sign in");
          //   }
        },
      });
    }
  });

  // forgot script
  $("#forgot-btn").click((e) => {
    if ($("#forgot-form")[0].checkValidity()) {
      e.preventDefault();
      $("#forgot-btn").val("Please wait...");
      $.ajax({
        url: "config/controller.php",
        method: "post",
        data: $("#forgot-form").serialize() + "&action=forgot",
        success: function (res) {
          $("#forgot-btn").val("Reset Password");
          $("#forgot-form")[0].reset();
          $("#forgotAlert").html(res);
        },
      });
    }
  });
});
