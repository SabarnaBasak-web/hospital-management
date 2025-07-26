import { ajaxHandler, loadTableContent } from "./common/commonUtils.js";

let isCreated = false;
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
// edit blood test
$("#edit-blood-test-form").submit((event) => {
  event.preventDefault();
  const form = $("#edit-blood-test-form");
  const formData = form.serialize();
  const submitBtn = $("#updateBloodTestDetails");
  const submitUrl = "update-blood-test-entry";
  const alertTextComponent = $("#custom-alert");
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

  // Todo: Persisting previous state values while launching the modal

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

      $("#editBloodTest").modal("hide");
      loadBloodTestList();
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

// reload
$("#close-btn").on("click", () => {
  const loader = $("#loader > div");
  const tableBody = $("#blood-test-table > tbody");
  const submitUrl = "get-blood-tests-list";
  if (isCreated) loadTableContent(loader, tableBody, submitUrl);
  isCreated = false;
});

const loadBloodTestList = () => {
  const loader = $("#loader > div");
  const tableBody = $("#blood-test-table > tbody");
  const submitUrl = "get-blood-tests-list";
  loadTableContent(loader, tableBody, submitUrl);
};

// load data
$(document).ready(() => {
  loadBloodTestList();
});

$("#table-search").keypress(function (event) {
  if ($(this).val().length > 0) {
    $("#clear-search").css("visibility", "visible");
  } else {
    $("#clear-search").css("visibility", "hidden");
  }
  if (event.which === 13) {
    const loader = $("#loader > div");
    const tableBody = $("#blood-test-table > tbody");
    const submitUrl = "get-blood-tests-list-by-test-name";
    const searchedValue = $(this).val();

    console.log("@@ table-search", searchedValue);
    const searchedString = { searchedString: searchedValue };
    loadTableContent(loader, tableBody, submitUrl, searchedString);
  }
});

$("#clear-search").on("click", function () {
  loadBloodTestList();
  $("#table-search").val("");
  $(this).css("visibility", "hidden");
});
