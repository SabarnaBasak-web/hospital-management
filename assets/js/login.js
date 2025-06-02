import { ajaxHandler } from "./common/commonUtils.js";

$("#login-form").submit((e) => {
  e.preventDefault();

  const type = "POST";
  const form = $("#login-form");
  const formData = form.serialize();
  const submitUrl = "dashboard-login";
  const submitBtn = $("button");
  const alertTextComponent = $("#alert-text");
  const beforeSendButton =
    '<i class="fa fa-spinner fa-pulse"></i> Logging In...';
  const defaultBtnText =
    'Login <i id="btn-icon" class="fa-solid fa-right-to-bracket"></i>';
  const afterSaveButton =
    ' Successfully Logged In. <i class="fa fa-check"></i>';
  const beforeSendHandler = () => {
    submitBtn.attr("disabled", true).html(beforeSendButton);
    alertTextComponent.removeClass("show").addClass("hide");
  };
  const errorHandler = (xhr) => {
    submitBtn.attr("disabled", false).html(defaultBtnText);
  };
  const onSuccessHandler = (response) => {
    const parsedResponse = JSON.parse(response);
    const { status, message } = parsedResponse;

    if (status === "success") {
      submitBtn
        .attr("disabled", false)
        .removeClass("btn-primary")
        .addClass("btn-success")
        .html(afterSaveButton);
      setTimeout(() => {
        window.location = "dashboard";
      }, 1000);
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
    formData,
    beforeSendHandler,
    errorHandler,
    onSuccessHandler
  );
});
