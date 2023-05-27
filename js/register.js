$(document).ready(function () {
  $("#register").click(function () {
    let username = $("#username").val();
    let password = $("#password").val();

    if (username !== "" && password !== "") {
      console.log(username, password);
      $.ajax({
        url: 'http://localhost/myApp/php/register.php',
        type: "POST",
        data: { username: username, password: password },
        success: function (response) {
          console.log(response);
          if(response === "Registration successful!")
            window.location.href = "login.html";
        },
        error: function (xhr, status, error) {
          console.error(xhr);
        },
      });
    } else console.log("Please enter a valid username and password");
  });
});
