import { ajaxHandler } from "./common/commonUtils.js";

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

  const type = "POST";

  const beforeSendHandler = () => {
    submitBtn.attr("disabled", true).html(beforeSendButton);
  };
  const errorHandler = (xhr) => {
    submitBtn.attr("disabled", false).html(defaultBtnText);
  };

  const successHandler = (response) => {
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
  };

  ajaxHandler(
    type,
    submitUrl,
    data,
    beforeSendHandler,
    errorHandler,
    successHandler
  );
});
// end change-password-form

// add-staff start
$("#add_staff_form").submit((event) => {
  event.preventDefault();
  const form = $("#add_staff_form");
  const data = form.serialize();
  const submitBtn = $("#add-staff-btn");
  const submitUrl = "add-staff";
  const alertTextComponent = $("#add-staff-alert");
  const beforeSendButton =
    '<i class="fa fa-spinner fa-pulse"></i> Processing...';
  const defaultBtnText = "Add User";

  const beforeSend = () => {
    submitBtn.attr("disabled", true).html(beforeSendButton);
  };
  const errorHandler = () => {
    submitBtn.attr("disabled", false).html(defaultBtnText);
  };
  const successHandler = (response) => {
    const jsonResponse = JSON.parse(response);
    const { status, message } = jsonResponse;
    if (status == "success") {
      submitBtn
        .attr("disabled", false)
        .removeClass("btn-primary")
        .addClass("btn-success")
        .html(`<i class="fa fa-check"></i> Success!`);
      alertTextComponent.removeClass("hide").addClass("show").html(message);

      setTimeout(() => {
        submitBtn
          .removeClass("btn-success")
          .addClass("btn-primary")
          .html(defaultBtnText);
      }, 5000);
    }
    if (status === "error") {
      alertTextComponent
        .removeClass("hide")
        .addClass("show")
        .removeClass("alert-success")
        .addClass("alert-danger")
        .html(message);
      submitBtn.attr("disabled", false).html(defaultBtnText);
    }
    form[0].reset();
  };

  ajaxHandler(
    "POST",
    submitUrl,
    data,
    beforeSend,
    errorHandler,
    successHandler
  );
});

// edit-staff start
$("#edit_staff_form").submit((event) => {
  event.preventDefault();
  const form = $("#edit_staff_form");
  const data = form.serialize();
  const submitBtn = $("#edit-staff-btn");
  const submitUrl = "edit-staff";
  const alertTextComponent = $("#edit-staff-alert");
  const beforeSendButton =
    '<i class="fa fa-spinner fa-pulse"></i> Processing...';
  const defaultBtnText = "Update";
  const beforeSend = () => {
    submitBtn.attr("disabled", true).html(beforeSendButton);
  };
  const errorHandler = (xhr) => {
    submitBtn.attr("disabled", false).html(defaultBtnText);
  };
  const successHandler = (response) => {
    const jsonResponse = JSON.parse(response);

    const { status, message } = jsonResponse;
    if (status == "success") {
      submitBtn
        .attr("disabled", false)
        .removeClass("btn-primary")
        .addClass("btn-success")
        .html(`<i class="fa fa-check"></i> Success!`);
      alertTextComponent
        .removeClass("hide")
        .removeClass("alert-danger")
        .addClass("alert-success")
        .addClass("show")
        .html(`<i class="fa fa-check"></i> ${message}`);

      setTimeout(() => {
        submitBtn
          .removeClass("btn-success")
          .addClass("btn-primary")
          .html(defaultBtnText);
        $("#edit-staff-modal").modal("hide");
      }, 10000);
    }
    if (status === "error") {
      alertTextComponent
        .removeClass("hide")
        .addClass("show")
        .removeClass("alert-success")
        .addClass("alert-danger")
        .html(`<i class="fa-solid fa-triangle-exclamation"></i> ${message}`);
      submitBtn.attr("disabled", false).html(defaultBtnText);
    }
  };

  ajaxHandler(
    "POST",
    submitUrl,
    data,
    beforeSend,
    errorHandler,
    successHandler
  );
});
