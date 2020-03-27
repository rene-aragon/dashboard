$("#moreFilters").hide();
function exportTable()
{
    var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
    var textRange; var j=0;
    tab = document.getElementById('tablaRegistros'); // id of table


    for(j = 0 ; j < tab.rows.length ; j++)
    {
      tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
    }

    tab_text=tab_text+"</table>";
    tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
    tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
    tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE ");

    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
    {
      txtArea1.document.open("txt/html","replace");
      txtArea1.document.write(tab_text);
      txtArea1.document.close();
      txtArea1.focus();
      sa=txtArea1.document.execCommand("SaveAs",true,"Say Thanks to Sumit.xls");
    }
    else
      sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));


    return (sa);
  }

  $("#moreFiltersButton").click(function()
  {
    $("#moreFilters").slideToggle();
  });

  $( document ).ready(function()
  {
    document.getElementById('aDate').valueAsDate = new Date();
    document.getElementById('dateChackbox').style.visibility = "hidden";
    tableFilter();
  });

  function tableFilter()
  {
    element = document.getElementById("aDate");
    aDate = element.value;
    element = document.getElementById("aTime");
    aTime = (element.value=="") ? "00:00" : element.value;
    element = document.getElementById("bDate");
    bDate = (element.value=="") ? aDate : element.value;
    element = document.getElementById("bTime");
    bTime = (element.value=="") ? "23:59" : element.value;

    query = "SELECT * FROM sensores WHERE fecha BETWEEN '"+aDate+" "+aTime+"' AND '"+bDate+" "+bTime+"'";

    if(document.getElementById('dateChackbox').checked)
      query += " AND CAST(fecha AS TIME) = '"+aTime+":00'";

    if(aTime == bTime)
    {
      document.getElementById('dateChackbox').style.visibility = "visible";
      document.getElementById('labelChackbox').innerHTML = "Sólo registros de "+aTime;
    }
    else
    {
      document.getElementById('dateChackbox').checked = false;
      document.getElementById('dateChackbox').style.visibility = "hidden";
      document.getElementById('labelChackbox').innerHTML = "";
    }

    var req = new XMLHttpRequest();

    req.onreadystatechange = function()
    {
      if (req.readyState == 4 && req.status == 200)
        document.getElementById("mainTable").innerHTML = req.responseText;
    }

    req.open('GET', 'content.php?f=3&p='+query, true);
    req.send();
  }

  function clearFilters(idTable)
  {
    document.getElementById('aDate').valueAsDate = new Date();
    document.getElementById('aTime').value = "";
    tableFilter();
  }

  function resizeTable(px)
  {
    var height = $(window).height();
    px = height-px-($('#topBar').outerHeight());
    $('#mainTable').css('max-height',px+'px');
  }
  setInterval('resizeTable(120)',50);
