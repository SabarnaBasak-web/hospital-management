const barChartCanvas = (
  elementId,
  datasetLabel,
  backgroundColor,
  borderColor
) => {
  const canvas = document.getElementById(elementId);
  if (!canvas) return;

  const labels = canvas.dataset.labels ? JSON.parse(canvas.dataset.labels) : [];
  const values = canvas.dataset.values ? JSON.parse(canvas.dataset.values) : [];

  if (!labels.length || !values.length) return;

  const ctx = canvas.getContext("2d");
  new Chart(ctx, {
    type: "bar",
    data: {
      labels: labels,
      datasets: [
        {
          label: datasetLabel,
          data: values,
          backgroundColor,
          borderColor,
          borderWidth: 1,
        },
      ],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            precision: 0,
          },
        },
      },
    },
  });
};

document.addEventListener("DOMContentLoaded", function () {
  barChartCanvas(
    "dailyBloodTestsChart",
    "Daily Blood Tests",
    "rgba(54, 162, 235, 0.5)",
    "rgba(54, 162, 235, 1)"
  );

  barChartCanvas(
    "dailyTotalAmountChart",
    "Daily Amount received",
    "rgba(107, 142, 35,0.5)",
    "rgba(107, 142, 35,1)"
  );

  barChartCanvas(
    "dailyReportChart",
    "Daily Report provided",
    "rgba(54, 162, 235, 0.5)",
    "rgba(54, 162, 235, 1)"
  );
});
