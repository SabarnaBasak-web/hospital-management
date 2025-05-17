$("#login-form").submit((e) => {
  e.preventDefault();

  const form = $("#login-form");
  const data = form.serialize();
  const submitUrl = "../models/login/ajax_login.php";
  const submitBtn = $("button");
  const alertTextComponent = $("#alert-text");
  const beforeSendButton =
    '<i class="fa fa-spinner fa-pulse"></i> Logging In...';
  const defaultBtnText =
    'Login <i id="btn-icon" class="fa-solid fa-right-to-bracket"></i>';
  const afterSaveButton =
    ' Successfully Logged In. <i class="fa fa-check"></i>';

  $.ajax({
    type: "POST",
    url: submitUrl,
    data: data,
    beforeSend: function () {
      submitBtn.attr("disabled", true).html(beforeSendButton);
      alertTextComponent.removeClass("show").addClass("hide");
    },
    error: function (xhr) {
      submitBtn.attr("disabled", false).html(defaultBtnText);
    },
    success: function (response) {
      const parsedResponse = JSON.parse(response);
      const { status, message } = parsedResponse;

      if (status === "success") {
        submitBtn
          .attr("disabled", false)
          .removeClass("btn-primary")
          .addClass("btn-success")
          .html(afterSaveButton);
        setTimeout(() => {
          window.location = "./dashboard.php";
        }, 1000);
      }
      if (status === "error") {
        alertTextComponent
          .removeClass("hide")
          .addClass("show")
          .html(`<i class="fa-solid fa-triangle-exclamation"></i> ${message}`);
        submitBtn.attr("disabled", false).html(defaultBtnText);
        form[0].reset();
      }
    },
  });
});
