<?php
  $con = mysqli_connect("localhost","root","","ash");
  
?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" id="bar-chart-horizontal">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Nom', 'capacite'],
         <?php
         $sql = "SELECT Nom,capacite FROM salle";
         $fire = mysqli_query($con,$sql);
          while ($result = mysqli_fetch_assoc($fire)) {
            echo"['".$result['Nom']."',".$result['capacite']."],";
          }

         ?>
        ]);

        var options = {
          title: 'capacite totale'
          
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 1000px; height: 350px;"></div>
  </body>
</html>