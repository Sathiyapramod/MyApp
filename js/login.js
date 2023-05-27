$(document).ready(function () {
  $("#login").click(function () {
    let username = $("#username").val();
    let password = $("#password").val();

    console.log(username, password);

    if (username !== "" && password !== "") {
      console.log(username, password);
      $.ajax({
        url: "http://localhost/myApp/php/login.php",
        type: "POST",
        data: { username: username, password: password },
        success: function (response) {
          console.log(response);
          if (response === "Login successful!") {
            localStorage.setItem("username", username);
            window.location.href = "profile.html";
          } else {
            alert("Invalid Credentials !");
            window.location.href = "index.html";
          }
        },
        error: function (xhr, status, error) {
          console.error(xhr);
        },
      });
    } else if (username == "") $("#username").addClass("is-invalid");
    else if (password == "") $("#password").addClass("is-invalid");
    else console.log("Please enter a valid username and password");
  });

  $("#goBack").click(function () {
    window.location.href = "index.html";
  });
});
