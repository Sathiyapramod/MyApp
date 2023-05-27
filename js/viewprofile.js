$(document).ready(function () {
  let username = localStorage.getItem("username");
  $("#username").val(username);
  $.ajax({
    url: "http://localhost/myApp/php/viewprofile.php",
    type: "GET",
    data: { username: username },
    success: function (response) {
      if (response) {
        var data = JSON.parse(response);
        $("#username").val(data.username);
        $("#dateOfBirth").val(data.dateOfBirth);
        $("#contactNumber").val(data.contactNumber);
        $("#age").val(data.age);
        $("#address").val(data.address);
      }
    },
    error: function(xhr, status, error) {
      console.log(xhr.responseText);
      alert('Error: ' + error);
    }
  });
  $("#log-out").click(function () {
    localStorage.clear();
    alert("Successfully Logged Out !!");
    window.location.href = "index.html";
  });
  $("#GoToLogin").click(function(){
    window.location.href="login.html";
  })
});
