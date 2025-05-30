import { ajaxHandler } from "./common/commonUtils";

// calculate sale price based on discount provided
$("#discount").on("blur", () => {
  const originalPrice = $("#mrp").val();
  const discount = $("#discount").val();
  const salePrice = originalPrice - (discount / 100) * originalPrice;
  $("#price").val(`${salePrice.toFixed(0)}`);
});

// calculate due amount based on amount paid
$("#amountPaid").on("blur", () => {
  const paidAmount = $("#amountPaid").val();
  const price = $("#price").val();
  const pendingAmt = price - paidAmount;
  $("#dueAmount").val(pendingAmt);
});

$("#new-patient-blood-test-form").submit((e) => {
  e.preventDefault();

  const form = $("#new-patient-blood-test-form");
  const formData = form.serialize();
  const submitBtn = $("#saveEntryButton");
  const submitUrl = "patient-entry";
  const alertTextComponent = $("#new-patient-entry-alert");
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
