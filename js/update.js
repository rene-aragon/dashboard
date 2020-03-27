function updateAll()
{
  update("Sensor1",0);
  update("Sensor2",0);
  update("Sensor3",0);
  update("db_tbody",1);
  updateChart("Sensor1");
  updateChart("Sensor2");
  updateChart("Sensor3");
}

setInterval(function(){updateAll();}, 5000);

function update(id,func)
{
  var req = new XMLHttpRequest();

  req.onreadystatechange = function()
  {
    if (req.readyState == 4 && req.status == 200)
      document.getElementById(id).innerHTML = req.responseText;
  }

  req.open('GET', 'content.php?p='+id+'&f='+func, true);
  req.send();
}

function updateChart(sensor)
{
  var req = new XMLHttpRequest();

  req.onreadystatechange = function()
  {
    if (req.readyState == 4 && req.status == 200)
    {
      var res = req.responseText;
      var arr = res.split(",");
      chartId = sensor+"-chart";

      reloadChart(chartId,arr);
    }
  }

  req.open('GET', 'content.php?p='+sensor+'&f=2', true);
  req.send();
}

function reloadChart(chartId, values)
{
  var limit = values.length/2;
  var labelValue = values.slice(0,limit);
  var dataValue  = values.slice(limit);
  var dataLabel;

  if(chartId == "Sensor1-chart")
    dataLabel = "temperatura";
  else
    dataLabel = "ppm";

  try {
    var ctx = document.getElementById(chartId);
    if (ctx) {
      ctx.innerHTML="";
      ctx.height = 150;
      var myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: labelValue,
          type: 'line',
          defaultFontFamily: 'Poppins',
          datasets: [{
            label: dataLabel,
            data: dataValue,
            backgroundColor: 'transparent',
            borderColor: 'rgba(220,53,69,0.75)',
            borderWidth: 3,
            pointStyle: 'circle',
            pointRadius: 5,
            pointBorderColor: 'transparent',
            pointBackgroundColor: 'rgba(220,53,69,0.75)',
          }]
        },
        options: {
          responsive: true,
          tooltips: {
            mode: 'index',
            titleFontSize: 12,
            titleFontColor: '#000',
            bodyFontColor: '#000',
            backgroundColor: '#fff',
            titleFontFamily: 'Poppins',
            bodyFontFamily: 'Poppins',
            cornerRadius: 3,
            intersect: false,
          },
          legend: {
            display: false,
            labels: {
              usePointStyle: true,
              fontFamily: 'Poppins',
            },
          },
          scales: {
            xAxes: [{
              display: true,
              gridLines: {
                display: false,
                drawBorder: false
              },
              scaleLabel: {
                display: true,
                labelString: 'Hora'
              },
              ticks: {
                fontFamily: "Poppins"
              }
            }],
            yAxes: [{
              display: true,
              gridLines: {
                display: false,
                drawBorder: false
              },
              scaleLabel: {
                display: true,
                labelString: 'temperatura °C',
                fontFamily: "Poppins"

              },
              ticks: {
                fontFamily: "Poppins"
              }
            }]
          },
          title: {
            display: false,
            text: 'Normal Legend'
          }
        }
      });
    }
    else {
      console.log("Error");
    }

  } catch (error) {
    console.log(error);
  }
}
