// Change password
$("#change-password-form").submit((event) => {
  event.preventDefault();
  const form = $("#change-password-form");
  const data = form.serialize();
  const submitBtn = $("#change-pwd-btn");
  const submitUrl = "change-password";
  const alertTextComponent = $("#custom-alert");
  const beforeSendButton =
    '<i class="fa fa-spinner fa-pulse"></i> Processing...';
  const defaultBtnText = "Change Password";

  $.ajax({
    type: "POST",
    url: submitUrl,
    data: data,
    beforeSend: function () {
      submitBtn.attr("disabled", true).html(beforeSendButton);
    },
    error: function (xhr) {
      submitBtn.attr("disabled", false).html(defaultBtnText);
    },
    success: function (response) {
      const jsonResponse = JSON.parse(response);
      const { status, message } = jsonResponse;
      if (status == "success") {
        submitBtn
          .attr("disabled", false)
          .removeClass("btn-primary")
          .addClass("btn-success")
          .html(`${message} <i class="fa fa-check"></i>`);

        setTimeout(() => {
          submitBtn
            .removeClass("btn-success")
            .addClass("btn-primary")
            .html(defaultBtnText);
        }, 5000);
        $.post("logout", function (data) {
          window.location = "login";
        });
      }
      if (status === "error") {
        alertTextComponent
          .removeClass("hide")
          .addClass("show")
          .html(`<i class="fa-solid fa-triangle-exclamation"></i> ${message}`);
        submitBtn.attr("disabled", false).html(defaultBtnText);
      }
      form[0].reset();
    },
  });
});
// end change-password-form

// add-staff start
$("#add_staff_form").submit((event) => {
  event.preventDefault();
  const form = $("#add_staff_form");
  const data = form.serialize();
  const submitBtn = $("#add-staff-btn");
  const submitUrl = "add-staff";
  const alertTextComponent = $("#custom-alert");
  const beforeSendButton =
    '<i class="fa fa-spinner fa-pulse"></i> Processing...';
  const defaultBtnText = "Add User";
  $.ajax({
    type: "POST",
    url: submitUrl,
    data: data,
    beforeSend: function () {
      submitBtn.attr("disabled", true).html(beforeSendButton);
    },
    error: function (xhr) {
      submitBtn.attr("disabled", false).html(defaultBtnText);
    },
    success: function (response) {
      const jsonResponse = JSON.parse(response);
      console.log(jsonResponse);
      // const { status, message } = jsonResponse;
      // if (status == "success") {
      //   submitBtn
      //     .attr("disabled", false)
      //     .removeClass("btn-primary")
      //     .addClass("btn-success")
      //     .html(`${message} <i class="fa fa-check"></i>`);

      //   setTimeout(() => {
      //     submitBtn
      //       .removeClass("btn-success")
      //       .addClass("btn-primary")
      //       .html(defaultBtnText);
      //   }, 5000);
      //   $.post("logout", function (data) {
      //     window.location = "login";
      //   });
      // }
      // if (status === "error") {
      //   alertTextComponent
      //     .removeClass("hide")
      //     .addClass("show")
      //     .html(`<i class="fa-solid fa-triangle-exclamation"></i> ${message}`);
      //   submitBtn.attr("disabled", false).html(defaultBtnText);
      // }
      // form[0].reset();
    },
  });
});
