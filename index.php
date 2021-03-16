<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  
  <title>Sprint2</title>

</head>
<body>

<?php
    $servername = "localhost";
    $username = "root";
    $password = "mysql";
    $dbname = "sprint2";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
     die("Connection failed: " . mysqli_connect_error());
    } 
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="?path=darbuotojai">Darbuotojai</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?path=projektai">Projektai</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
  <div class="container-fluid ">
    <div class="row">
      <div class="col-12">

      <?php if(isset($_GET["path"]) and $_GET['path'] == 'darbuotojai'): ?>           


    <?php
    $sql = 
          '
          SELECT
              Employees.id,
              Employees.name,
              Projects.project_name
          FROM Employees 
          JOIN Projects
            ON Employees.project_id = Projects.id;  
          ';
          $result = mysqli_query($conn, $sql);
          
          if (mysqli_num_rows($result) > 0) {
            print('<table class="table table-striped table-hover">');
            print('<thead style="background-color: lightblue"> ');
            print('<tr><th>Id</th><th>Vardas</th><th>Projektas</th><th>Veiksmai</th><tr><tbody>');
          
          while($row = mysqli_fetch_assoc($result)) {
              print ('<tr>
                        <td>' . $row['id'] . '</td>
                        <td>' . $row['name'] . '</td>
                        <td>' . $row['project_name'] . '</td>
                        <td>' . '<form action="" method="post">
                                  <button type="button" name="submit" class="btn btn-primary btn-sm" style="background-color: lightblue; color:black; border-color:black">Ištrinti</button>
                                  <button type="button" name="submit" class="btn btn-primary btn-sm" style="background-color: lightblue; color:black; border-color:black">Atnaujinti</button>
                                  </form>' .  '</td></tr>');  
          }
              print('</tbody></table>');
              
          } else {
          echo "0 results";
          }
          
      ?>

      <div class="container">
              <div class="row">
                  <div class="col-4">
                      <form action="" method="post">    
                        <input type="name" name="name" class="form-control" id="name" placeholder="Naujas darbuotojo vardas, pavardė">
                  </div>
                  <div class="col-2">
                        <button type="submit" name="submit" class="btn btn-primary" style="background-color: lightblue; color:black; border-color:black">Pridėti darbuotoją</button>
                  </div>
                      </form>
              </div>
        </div>
        <?php elseif(isset($_GET["path"]) and $_GET['path'] == 'projektai'): ?>

          <?php 
            $sql = 
            '
            SELECT
                Projects.id,
                Projects.project_name
            FROM Projects  
            ';
            $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result) > 0) {
            print('<table class="table table-striped table-hover">');
            print('<thead style="background-color: lightblue"> ');
            print('<tr><th>Id</th><th>Projektas</th><th>Vardas</th><th>Veiksmai</th><tr><tbody>');

            while($row = mysqli_fetch_assoc($result)) {
              print ('<tr>
                  <td>' . $row['id'] . '</td>
                  <td>' . $row['project_name']. '</td>'
              );

                echo '<td>';
                $sql2 = 'SELECT employees.name FROM employees WHERE project_id =' . $row['id'];
                $result2 = mysqli_query($conn, $sql2);
                $name = array();
                if (mysqli_num_rows($result2) > 0) {
                  while($row2 = mysqli_fetch_assoc($result2)) {
                    $name[] = $row2['name']; //<td>' . $row['project_name'] . '</td>
                  }
                }
                echo implode(', ', $name);
                echo '</td>';
                print ('<td>' . '<form action="" method="post">
                                  <button type="button" name="submit" class="btn btn-primary btn-sm" style="background-color: lightblue; color:black; border-color:black">Ištrinti</button>
                                  <button type="button" name="submit" class="btn btn-primary btn-sm" style="background-color: lightblue; color:black; border-color:black">Atnaujinti</button>
                                  </form>' .  '</td></tr>');
                print ('</tr>'); 
            }
                print('</tbody></table>');
          }
            
          ?>
                <div class="container">
              <div class="row">
                  <div class="col-4">
                      <form action="" method="post">    
                        <input type="name" name="name" class="form-control" id="name" placeholder="Naujas darbuotojo vardas, pavardė">
                  </div>
                  <div class="col-2">
                        <button type="submit" name="submit" class="btn btn-primary" style="background-color: lightblue; color:black; border-color:black">Pridėti darbuotoją</button>
                  </div>
                      </form>
              </div>
        </div>

        <?php endif; ?>
</body>
</html>