function exportTable()
{
    var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
    var textRange; var j=0;
    tab = document.getElementById('tablaRegistros'); // id of table


    for(j = 0 ; j < tab.rows.length ; j++)
    {
      tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
      //tab_text=tab_text+"</tr>";
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
    else                 //other browser not tested on IE 11
    sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));


    return (sa);
  }

  $( document ).ready(function()
  {
    document.getElementById('aDate').valueAsDate = new Date();
  });

  $("#aDate").change(function ()
  {
    element = document.getElementById("aDate");
    value   = element.value;
    filter(value,"tBody",0);
  });

  $("#aTime").change(function ()
  {
    element = document.getElementById("aTime");
    value   = element.value;
    filter(value,"tBody",1);
  });

  function filter(value,idTable,rowIndex)
  {
    table = document.getElementById(idTable);
    tr = table.getElementsByTagName("tr");

    for (a = 0; a < tr.length; a++)
    {
        e = tr[a].getElementsByTagName("td")[rowIndex];
        v = e.innerHTML;

        if(v == value)
          tr[a].style.display = "";
        else
          tr[a].style.display = "none";
    }
  }

  function clearFilters(idTable)
  {
    table = document.getElementById(idTable);
    tr = table.getElementsByTagName("tr");

    for (a = 0; a < tr.length; a++)
      tr[a].style.display = "";
    document.getElementById('aDate').valueAsDate = new Date();
    document.getElementById('aTime').value = "00:00";
  }
