<?php
session_start();
$uf = $_GET['pesquisa'];
$url = "https://covid19-brazil-api.now.sh/api/report/v1/brazil/uf/".$uf;

$result = file_get_contents($url);

$final = json_decode($result, true);

$suspeitos =  $final["cases"]; 
$confirmados = $final["suspects"];
$mortos = $final["deaths"];
$recusados = $final["refuses"];

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CoronaVirus Status</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js"></script>
    
    <script type="text/javascript" src="chart.js"></script>
</head>
<body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="index.php"> Status CoronaVirus Brasil</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>   
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                      <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Estado</a>
                    </li>
                  </ul>
                  <form class="form-inline my-2 my-lg-0" action="buscar.php">
                    <input class="form-control mr-sm-2" name="pesquisa" id="pesquisa" type="search" placeholder="Informe a uf" aria-label="search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
                  </form>
                </div>
              </nav>
            <br>
            
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php"><?php echo $_SESSION['pais']; ?></a></li>
                <li class="breadcrumb-item"><a href="#"><?php echo $final["state"];?></a></li>
              </ol>
            </nav>
            <br>
            <div class="container">
                    <div class="row">
                    <div class="col-md-3">
                      <div class="card-counter primary">
                        <i class="fa fa-users"></i>
                        <span class="count-numbers"><?php echo $suspeitos; ?></span>
                        <span class="count-name">Casos Suspeitos</span>
                      </div>
                    </div>
                
                    <div class="col-md-3">
                      <div class="card-counter danger">
                        <i class="fa fa-users"></i>
                        <span class="count-numbers"><?php echo $confirmados; ?></span>
                        <span class="count-name">Casos Confirmados</span>
                      </div>
                    </div>
                
                    <div class="col-md-3">
                      <div class="card-counter success">
                        <i class="fa fa-users"></i>
                        <span class="count-numbers"><?php echo $mortos; ?></span>
                        <span class="count-name">Mortes</span>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="card-counter info bg-success">
                        <i class="fa fa-users"></i>
                        <span class="count-numbers"><?php echo $recusados; ?></span>
                        <span class="count-name">Recusados</span>
                      </div>
                    </div>
                  </div>
            </div>
            <br>
            <div class="container">
                <div class="row">
                    <div class="col-md-3"></div>
                        <canvas id="myChart" ></canvas>
                </div>
            </div>
<script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Casos confirmados', 'Casos Suspeitos', 'Mortes', 'Recusados'],
        datasets: [{
            label: '# Casos',
            data: [<?php echo $suspeitos; ?>, <?php echo $confirmados; ?>, <?php echo $mortos; ?>, <?php echo $recusados; ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(48, 48, 52, 0.9)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(0, 0.8, 0.8, 0)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script> 
<h6><?php echo "Ultima atualizacao em: ".$final["datetime"]?></h6>      
</body>
<footer class="page-footer font-small blue">

<!-- Copyright -->
<div class="footer-copyright text-center py-3">© 2020 Copyright:
  <a href="">Leonardo Ribeiro</a>
</div>
<!-- Copyright -->

</footer>  
</html>