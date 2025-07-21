// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';
// Pie Chart Example

function getRandomColor() {
  var letters = '0123456789ABCDEF';
  var color = '#';
  for (var i = 0; i < 6; i++) {
      color += letters[Math.floor(Math.random() * 16)];
  }
  return color;
}

function drawPieChart(labelsWord,datas,htmlId){
  color = ['#6499E9', '#9EDDFF', '#A6F6FF', '#BEFFF7','#687EFF','#9400FF','#27005D','#A6F8FF','#9EDDAA','#6477E2'];
  var ctx = document.getElementById(htmlId);

  var backgroundColors = [];
  for (var i = 0; i < datas.length; i++) {
      backgroundColors.push(getRandomColor());
  }
  
  var myPieChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: labelsWord,
      datasets: [{
        data: datas,
        backgroundColor: color,
        hoverBackgroundColor: color.map(color => {
            // Lighten the color for hover effect
            var lightenColor = color + '70'; // Adding transparency
            return lightenColor;
        }),
        hoverBorderColor: "rgba(234, 236, 244, 1)",
      }],
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
        callbacks: {
          label: function(tooltipItem, data) {
            var dataset = data.datasets[tooltipItem.datasetIndex];
            var currentValue = dataset.data[tooltipItem.index];
            var label = data.labels[tooltipItem.index];
            return label + ' : ' + convertToRupiah(currentValue);
          }
        }
      },
      legend: {
        display: false,
        position: 'bottom'
      },
      cutoutPercentage: 80
    },
  });
}