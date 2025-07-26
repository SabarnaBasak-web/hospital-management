export const ajaxHandler = (
  type,
  url,
  data,
  beforeSendHandler,
  errorHandler,
  successHandler
) => {
  $.ajax({
    type: type,
    url: url,
    data: data,
    beforeSend: beforeSendHandler,
    error: errorHandler,
    success: successHandler,
  });
};

export const loadTableContent = (loader, tableBody, submitUrl, data = null) => {
  const beforeSendHandler = () => {
    loader.removeClass("hide");
    tableBody.addClass("hide");
  };

  const onSuccess = (response) => {
    loader.addClass("hide");
    tableBody.removeClass("hide");
    tableBody.html(response);
  };

  const errorHandler = (xhr) => {
    loader.addClass("hide");
    tableBody.removeClass("hide");
    tableBody.html("<h3>Something went wrong while loading the data</h3>");
  };

  ajaxHandler(
    "GET",
    submitUrl,
    data ? data : null,
    beforeSendHandler,
    errorHandler,
    onSuccess
  );
};
