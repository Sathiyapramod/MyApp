$(document).ready(function () {
  // if (localStorage.getItem("username")) {
  //   var detail = localStorage.getItem("username");
  $("#username").val(detail);
  $("#login-user").html(detail.toUpperCase());
  $("#updateProfile").click(function () {
    let dateOfBirth = $("#dateOfBirth").val();
    let age = $("#age").val();
    let address = $("#address").val();
    let contactNumber = $("#contactNumber").val();
    let profileData = {
      username: detail,
      dateOfBirth,
      age,
      address,
      contactNumber,
    };

    $.ajax({
      url: "http://localhost/myApp/php/profile.php",
      type: "POST",
      data: profileData,
      success: function (response) {
        console.log(response);
        alert("Data Saved Successfully !!");
        window.location.href = "viewprofile.html";
      },
      error: function (xhr, status, error) {
        console.error(xhr);
      },
    });
  });
  $("#log-out").click(function () {
    localStorage.clear();
    alert("Successfully Logged Out !!");
    window.location.href = "index.html";
  });
  // } else {
  //   window.location.href = "login.html";
  //   alert("Enter through Valid Username and Password only !!");
  // }
});
