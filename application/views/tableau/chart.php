<style>
  * {
    margin: 0;
    padding: 0;
    font-family: sans-serif;
  }

  .chartMenu {
    width: 100vw;
    height: 40px;
    background: #1A1A1A;
    color: rgba(54, 162, 235, 1);
  }

  .chartMenu p {
    padding: 10px;
    font-size: 20px;
  }

  .chartBox {
    width: 700px;
    padding: 20px;
    border-radius: 20px;
    background: white;
  }
</style>
<center>
  <h1>Statistique de vente</h1>

  <div class="chartCard">

    <div class="chartBox">
      <form action="<?php echo site_url('tableau/getData'); ?>" class="mb-3" method="post">
        <select name="id">
          <?php
          foreach ($produit as $p) { ?>
            <option value="<?php echo $p['produitid']; ?>"><?php echo $p['nom_produit']; ?></option>
          <?php }
          ?>
        </select>
      </form>
      <canvas id="myChart"></canvas>
    </div>
  </div>
</center>


<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.min.js"></script>
<script>
  var ex = []
  const form = document.querySelector('form');
  const select = document.querySelector('select');
  var xhttp = new XMLHttpRequest();
  var val = select.value;
  var perte = []
  var exportation = []
  var local = []
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      ex = JSON.parse(this.responseText);
      for (let i = 0; i < 3; i++) {
        myChart.data.datasets[i].data = ex[i];
      }
      myChart.update();
    }
  };
  xhttp.open("POST", "http://localhost/vegmarket/tableau/getData/" + val, true);
  xhttp.send();


  select.addEventListener('change', (e) => {
    val = select.value;
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        ex = JSON.parse(this.responseText);
        for (let i = 0; i < 3; i++) {
          myChart.data.datasets[i].data = ex[i];
        }
        myChart.update();
      }
    };
    xhttp.open("POST", "http://localhost/vegmarket/tableau/getData/" + val, true);
    xhttp.send();
  })

  // setup 
  var data = {
    labels: ['Jan', 'Fev', 'Mars', 'Avr', 'Mai', 'Juin', 'Juil', 'Aout', 'Sept', 'Oct', 'Nov', 'Dec'],
    datasets: [{
        label: 'Exportation',
        data: ex,
        backgroundColor: 'rgba(55, 26, 24, 0.2)',
        borderColor: 'rgba(55, 26, 24, 1)',
        borderWidth: 1
      },
      {
        label: 'Local',
        data: [1, 12, 6, 9, 12, 3, 9, 2, 5, 14, 1, 7],
        backgroundColor: 'rgba(1, 47, 104, 0.2)',
        borderColor: 'rgba(1, 47, 104, 1)',
        borderWidth: 1
      },
      {
        label: 'Perte',
        data: [7, 12, 6, 9, 12, 3, 9, 2, 5, 14, 1, 7],
        backgroundColor: 'rgba(255, 26, 104, 0.2)',
        borderColor: 'rgba(255, 26, 104, 1)',
        borderWidth: 1
      }
    ]
  };

  // config 
  var config = {
    type: 'bar',
    data,
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  };

  // render init block
  var myChart = new Chart(
    document.getElementById('myChart'),
    config
  );

  // Instantly assign Chart.js version
  const chartVersion = document.getElementById('chartVersion');
  chartVersion.innerText = Chart.version;
</script>