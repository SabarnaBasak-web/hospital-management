import { ajaxHandler } from "./common/commonUtils";
// create new entry
$("#new-blood-test-form").submit((event) => {
  event.preventDefault();
  const form = $("#new-blood-test-form");
  const formData = form.serialize();
  const submitBtn = $("#saveNewTest");
  const submitUrl = "new-blood-test-entry";
  const alertTextComponent = $("#custom-alert");
  const beforeSendButton =
    '<i class="fa fa-spinner fa-pulse"></i> Processing...';
  const defaultBtnText = "Save";
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
      alertTextComponent
        .removeClass("hide")
        .removeClass("alert-danger")
        .addClass("show")
        .addClass("alert-success")
        .html(`<i class="fa fa-check"></i> ${message}`);

      submitBtn
        .removeClass("btn-success")
        .addClass("btn-primary")
        .html(defaultBtnText);
    }
    if (status === "error") {
      alertTextComponent
        .removeClass("hide")
        .addClass("show")
        .html(`<i class="fa-solid fa-triangle-exclamation"></i> ${message}`);
      submitBtn.attr("disabled", false).html(defaultBtnText);
    }
    form[0].reset();
    setTimeout(() => {
      alertTextComponent
        .addClass("hide")
        .addClass("alert-danger")
        .removeClass("show")
        .removeClass("alert-success")
        .html("");
    }, 5000);
  };

  ajaxHandler(
    type,
    submitUrl,
    formData,
    beforeSendHandler,
    errorHandler,
    successHandler
  );
});

// reload
// Todo : Need to find a better approach to fix this reload issue
$("#close-btn").on("click", () => {
  window.location.reload();
});
