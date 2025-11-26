import { ajaxHandler } from "./common/commonUtils";

$("#clinic").on("change", (event) => {
  const selectedBranch = $(event.currentTarget).val();
  const submitUrl = "get-daily-reports";

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
});
