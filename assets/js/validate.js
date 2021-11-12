$(document).ready(function(){
  $("#registration-form").validate({
    rules: {
      username: "required",
      user_email: {
        required: true,
        email: true,
      },
      user_pwd: "required",
    },
    messages: {
      username: "Please enter a valid username",
      user_email: {
        required: "Please enter your email",
        email: "Please enter a valid email address",
      },
      user_pwd: "Please your password",
    },
    submitHandler: function (form) {
      form.submit();
    },
  });

  $("#login-form").validate({
    rules: {
      user_email: {
        required: true,
        email: true,
      },
      user_pwd: {
        required: true,
      },
    },
    messages: {
      user_email: {
        required: "Please enter your email",
        email: "Please enter a valid email address",
      },
      user_pwd: {
        required: "Please your password",
      },
    },
    submitHandler: function (form) {
      form.submit();
    },
  });
});