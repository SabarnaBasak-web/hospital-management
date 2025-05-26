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
