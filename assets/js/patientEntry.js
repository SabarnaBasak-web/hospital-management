import { ajaxHandler, loadTableContent } from "./common/commonUtils.js";

let isCreated = false;

const updatePendingAmount = () => {
  const paidAmount = parseInt($("#amountPaid").val());
  const price = parseInt($("#price").val());
  const errorMessage = $("#amountPaidError");
  const submitBtn = $("#saveEntryButton");

  if (paidAmount > price) {
    errorMessage.text("Amount paid cannot exceed the price.");
    errorMessage.css("display", "block");
    submitBtn.attr("disabled", true);
  } else {
    const pendingAmt = price - paidAmount;
    $("#dueAmount").val(pendingAmt);
    errorMessage.text("").css("display", "none");
    submitBtn.attr("disabled", false);
  }
};

// calculate due amount based on amount paid
$("#amountPaid").on("blur", () => {
  updatePendingAmount();
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
    isCreated = true;
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

const loadPatientsList = () => {
  const loader = $("#loader > div");
  const tableBody = $("#blood-test-patient-list > tbody");
  const submitUrl = "get-patient-blood-tests-list";
  loadTableContent(loader, tableBody, submitUrl);
};
// load data
$(document).ready(() => {
  loadPatientsList();
});

// reload
$("#close-btn").on("click", () => {
  if (isCreated) loadPatientsList();
  isCreated = false;
});

// calculate updatedPending amount
const updatePendingAmountonEdit = () => {
  let paidAmount = parseInt($("#edit-amountPaid").val());
  const price = parseInt($("#edit-price").val());
  const prevAmount = parseInt($("#previous-payment").val());
  const dueAmount = parseInt($("#edit-dueAmount").val());

  if (paidAmount > dueAmount) {
    const errorMessage = $("#edit-amountPaidError");
    errorMessage.text("Amount paid cannot exceed the due amount.");
    errorMessage.css("display", "block");

    const submitBtn = $("#updateButton");
    submitBtn.attr("disabled", true);
  } else {
    $("#edit-amountPaidError").text("").css("display", "none");
    $("#updateButton").attr("disabled", false);
    const pendingAmt = price - (prevAmount + paidAmount);
    $("#edit-dueAmount").val(pendingAmt);
  }
};

$("#edit-amountPaid").on("blur", () => {
  const val = $("#edit-amountPaid").val();
  if (val) updatePendingAmountonEdit();
});

$("#edit-patient-blood-test-form").submit((e) => {
  e.preventDefault();

  const form = $("#edit-patient-blood-test-form");
  const formData = form.serialize();
  const submitBtn = $("#updateButton");
  const submitUrl = "update-patient-entry";
  const alertTextComponent = $("#edit-patient-entry-alert");
  const beforeSendButton =
    '<i class="fa fa-spinner fa-pulse"></i> Processing...';
  const defaultBtnText = "Update";
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
        .removeClass("btn-success")
        .addClass("btn-primary")
        .html(defaultBtnText);
      form[0].reset();
      isCreated = true;

      $("#editPatientBloodTest").modal("hide");
      window.location.reload();
    }
    if (status === "error") {
      alertTextComponent
        .removeClass("hide")
        .addClass("show")
        .html(`<i class="fa-solid fa-triangle-exclamation"></i> ${message}`);
      submitBtn.attr("disabled", false).html(defaultBtnText);
    }
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

$("#table-search").keypress(function (event) {
  if ($(this).val().length > 0) {
    $("#clear-search").css("visibility", "visible");
  } else {
    $("#clear-search").css("visibility", "hidden");
  }
  if (event.which === 13) {
    const loader = $("#loader > div");
    const tableBody = $("#blood-test-patient-list > tbody");
    const submitUrl = "get-patient-blood-tests-list-by-ticket";
    const searchedValue = $(this).val();

    const searchedString = { searchedString: searchedValue };
    loadTableContent(loader, tableBody, submitUrl, searchedString);
  }
});

$("#clear-search").on("click", function () {
  loadPatientsList();
  $("#table-search").val("");
  $(this).css("visibility", "hidden");
});
