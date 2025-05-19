$("#signOut").click(function (e) {
  e.preventDefault();
  $.post("logout", function (data) {
    window.location = "login";
  });
});
