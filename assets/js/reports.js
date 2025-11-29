import { ajaxHandler } from "./common/commonUtils.js";

const reportHandler = (event) => {
  const selectedBranch = event
    ? $(event.currentTarget).val()
    : $("#clinic").val();
  const submitUrl = "get-reports";

  const successHandler = (response) => {
    const res = JSON.parse(response);
    $("#bloodTestCountText").text(res.bloodTestCount);
    $("#reportProvidedText").text(res.reportProvided);
    $("#amountReceivedText").text(res.totalAmountReceived);

    $("#monthlyBloodTestCountText").text(res.monthlyBloodTestCount);
    $("#monthlyReportProvidedText").text(res.monthlyReportProvided);
    $("#monthlyAmountReceivedText").text(res.monthlyAmountReceived);
  };

  const errorHandler = (error) => {
    console.log("@@ error handler", error);
  };

  ajaxHandler(
    "GET",
    submitUrl,
    { branchCode: selectedBranch },
    () => {},
    errorHandler,
    successHandler
  );
};

$(document).ready(() => {
  console.log("@@ document loaded");
  reportHandler();
});
