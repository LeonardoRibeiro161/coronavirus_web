<?php
session_start();

$url = "https://covid19-brazil-api.now.sh/api/report/v1";

$result = file_get_contents($url);

$final = json_decode($result, true);


//echo $final['data'][0]['uid'];

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
    
   
</head>
<body >
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#"> Status CoronaVirus Brasil</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>   
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                      <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="estado.php">Estados</a>
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
                <li class="breadcrumb-item active" aria-current="page"><a href="index.php ">Brasil</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="estado.php">Estados</a></li>
              </ol>
            </nav>
            <br>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">UF</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Confirmados</th>
                    <th scope="col">Mortos</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0; while ($i <=26){?>
                    <tr>
                    <?php echo "<td scope='row'>". $final['data'][$i]['uf'] ."</td>";?>
                    <?php echo "<td scope='row'>". $final['data'][$i]['state'] ."</td>";?>
                    <?php echo "<td scope='row'>". $final['data'][$i]['cases'] ."</td>";?>
                    <?php echo "<td scope='row'>". $final['data'][$i]['deaths']."</td>";?>
                    <?php $i++ ?>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
            

<br>           
<h6><?php echo "Ultima atualizacao em:".$final['data'][0]['datetime'];?></h6>             
</body>
<footer id="sticky-footer" class="py-4 bg-secondary text-white-50">
    <div class="container text-center">
      <small>Copyright &copy; Leodev</small>
    </div>
  </footer>

</html>