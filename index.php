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

  <div class="container-fluid">
    <div class="row">
      <div class="col-12">

            <div class="card text-center">
              <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                  <li class="nav-item">
                    <a class="nav-link active" style="background-color: lightblue; color:black" aria-current="true" href="#">Darbuotojai</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" style="color:black" href="#">Projektai</a>
                  </li>
                </ul>
              </div>
            </div>

    <?php
    $sql = 'SELECT id, name FROM employees';
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
      print('<table class="table table-striped table-hover">');
      print('<thead style="background-color: lightblue"> <tbody>');
      print('<tr><th>Id</th><th>Vardas</th><th>Projektas</th><th>Veiksmai</th>');
     
     while($row = mysqli_fetch_assoc($result)) {
        print ('<tr><td>' . $row['id'] . '</td><td>' . $row['name'] . '</td><td>' . "" . '</td><td>' . "" .  '</td></tr>');  
     }
        print('</table></tbody>');

    } else {
     echo "0 results";
    }
?>

<div class="container">
        <div class="row">
            <div class="col-4">
                <form action="" method="">    
                  <input type="name" name="name" class="form-control" id="name" placeholder="Naujas darbuotojo vardas, pavardė">
            </div>
            <div class="col-2">
                  <button type="button" name="submit" class="btn btn-primary" style="background-color: lightblue; color:black; border-color:black">Pridėti darbuotoją</button>
            </div>
                </form>
        </div>
  </div>
<br>
<br>
<div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <table class="table table-striped table-hover">

          <thead style="background-color: lightblue">
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Vardas Pavardė</th>
          <th scope="col">Projektas</th>
          <th scope="col">Veiksmas</th>
        </tr>
      </thead>

  <tbody>
    <tr>
      <th scope="row">1</th>
        <td>Petras Petraitis</td>
        <td>Personalo skyrius</td>
      <td>               
         <form action="" method="post">
         <button type="button" name="submit" class="btn btn-primary btn-sm" style="background-color: lightblue; color:black; border-color:black">Ištrinti</button>
         <button type="button" name="submit" class="btn btn-primary btn-sm" style="background-color: lightblue; color:black; border-color:black">Atnaujinti</button>
          </form>
      </td>
    </tr>
  </tbody>
</table>

    <div class="container">
        <div class="row">
          <div class="col-4">
              <form action="" method="">    
                <input type="name" name="name" class="form-control" id="name" placeholder="Naujas darbuotojo vardas, pavardė">
          </div>
            <div class="col-2">
                <button type="button" name="submit" class="btn btn-primary" style="background-color: lightblue; color:black; border-color:black">Pridėti darbuotoją</button>
            </div>
            </form>
        </div>
    </div>
   </div>
  </div>
 </div>
</body>
</html>