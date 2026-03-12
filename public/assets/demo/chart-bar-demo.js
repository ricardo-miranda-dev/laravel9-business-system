// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Bar Chart Example
// Bar Chart
var ctxBar = document.getElementById("myBarChart");

var barChart = new Chart(ctxBar, {
  type: 'bar',
  data: {
    labels: ventasLabels,
    datasets: [{
      label: "Ventas",
      backgroundColor: "rgba(54,162,235,0.7)",
      borderColor: "rgba(54,162,235,1)",
      borderWidth: 1,
      data: ventasData
    }]
  },
  options: {
    responsive: true,
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true
        }
      }]
    },
    legend: {
      display: true
    }
  }
});
