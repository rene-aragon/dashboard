function updateAll()
{
  var req = new XMLHttpRequest();

  req.onreadystatechange = function()
  {
    if (req.readyState == 4 && req.status == 200)
    {
      document.getElementById('db_tbody').innerHTML = req.responseText;

      var lastValues = [];

      $("table#startTable tr").each(function () 
      {
        var arrayOfThisRow = [];
        var tableData = $(this).find('td');
        if (tableData.length > 0) {
          tableData.each(function () { arrayOfThisRow.push($(this).text()); });
          lastValues.push(arrayOfThisRow);
        }
      });

      //Update last temperature value
      document.getElementById("temperatura").innerHTML = lastValues[0][2];
      //Update last ch4 value
      document.getElementById("metano").innerHTML = lastValues[0][3];
      //Update last co2 value
      document.getElementById("co2").innerHTML = lastValues[0][4];

      var hours = []
      for (a = 4; a >= 0; a--)
        hours.push(lastValues[a][1])

      console.log("[INFO] hours: " + hours);
      //Update temperature chart
      var data = []
      for (a = 4; a >= 0; a--)
        data.push((lastValues[a][2]).replace(" °C", ""))
      updateChart("temperatura-chart",hours,data)

      //Update metano chart
      var data = []
      for (a = 4; a >= 0; a--)
        data.push((lastValues[a][3]).replace(" ppm", ""))
      updateChart("metano-chart",hours,data)

      //Update co2 chart
      var data = []
      for (a = 4; a >= 0; a--)
        data.push((lastValues[a][4]).replace(" ppm", ""))
      updateChart("co2-chart",hours,data)

      date = lastValues[0][0].split('-');
      hour = lastValues[0][1].split(':');
      lastDate = new Date(date[2],date[1]-1,date[0],hour[0],hour[1],0)
      today = new Date()
      console.log("[INFO] lastDate: "+lastDate+" today: "+today+" Difference: "+(today-lastDate));
      if(today-lastDate > 1800000)
        document.getElementById("warning-message").style.display="block";
      else
        document.getElementById("warning-message").style.display="none";

    }
  }

  req.open('GET', 'content.php?p=db_tbody&f=1', true);
  req.send();
}

function checkErrors()
{
  
}

setInterval(function(){updateAll();}, 1800000);//cada 30 mins.

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

function updateChart(chartId, labelValue, dataValue)
{
  var dataLabel;

  if(chartId == "temperatura-chart")
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


