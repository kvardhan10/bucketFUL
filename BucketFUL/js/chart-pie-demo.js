// Set new default font family and font color to mimic Bootstrap's default styling
// Chart.defaults.global.defaultFontFamily = 'sans-serif';
// Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example

function definepie(completed, notcompleted, total){

  console.log(completed, notcompleted, total);
  var c = completed;
  var nc = notcompleted;
  var t = total;
  console.log(c, nc, t);

    var ctx = document.getElementById("myPieChart");

    var myPieChart = new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: ["Completed", "Pending", "Total"],
        datasets: [{
          data: [c, nc, t],
          backgroundColor: ['#1cc88a', '#696969' ,'#36b9cc'],
          hoverBackgroundColor: ['#17a673', '#494949', '#2c9faf'],
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
        },
        legend: {
          display: false
        },
        cutoutPercentage: 80,
      },
    });


}
