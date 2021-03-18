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


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    if (empty($name)) {
        echo "Name is empty";
    } else {
      
          $sql = 'INSERT INTO employees (name) VALUES (?)';
          $stmt = $conn->prepare($sql);
          $stmt->bind_param('s', $name);
          $res = $stmt->execute();
          $stmt->close();
          mysqli_close($conn);
          header("Location: ?path=darbuotojai");
          die();

    }
}
?>
       <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $project_name = $_POST['project_name'];
            if (empty($project_name)) {
                echo "Project name is empty";
            } else {
      
            $sql = 'INSERT INTO Projects (project_name) VALUES (?)';
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $project_name);
            $res = $stmt->execute();
            $stmt->close();
            mysqli_close($conn);
            header("Location: ?path=projektai");
            die();
        }
      }
      ?>

      <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['submit'];
        if (!empty($id)) {
          $sql = 'DELETE FROM Employees WHERE id = ?';
          $stmt = $conn->prepare($sql);
          $stmt->bind_param('i', $id);
          $res = $stmt->execute();
          $stmt->close();
          mysqli_close($conn);
          header("Location: ?path=darbuotojai");
          die();
        }
      }
      ?>
      
          <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['submit'];
        if (!empty($id)) {
          $sql = 'DELETE FROM Projects WHERE id = ?';
          $stmt = $conn->prepare($sql);
          $stmt->bind_param('i', $id);
          $res = $stmt->execute();
          $stmt->close();
          mysqli_close($conn);
          header("Location: ?path=projektai");
          die();
        }
      }
      ?>

      <?php if(isset($_GET["path"]) and $_GET['path'] == 'darbuotojai'): ?>

    <?php
    $sql = 
          '
          SELECT
              Employees.id,
              Employees.name,
              Projects.project_name
          FROM Employees 
          LEFT JOIN Projects
            ON Employees.project_id = Projects.id;  
          ';
          $result = mysqli_query($conn, $sql);
          
          if (mysqli_num_rows($result) > 0) {
            print('<table class="table table-striped table-hover">');
            print('<thead style="background-color: lightblue"> ');
            print('<tr><th>Nr</th><th>Darbuotojas</th><th>Projektas</th><th>Veiksmai</th><tr><tbody>');
          $i = 1;
          while($row = mysqli_fetch_assoc($result)) {
              print ('<tr>
                        <td>' . $i . '</td>
                        <td>' . $row['name'] . '</td>
                        <td>' . $row['project_name'] . '</td>
                        <td>' . '<form action="'. $_SERVER['PHP_SELF'] .'" method="post">

                                  <button type="submit" name="submit" class="btn btn-outline-primary btn-sm" value="'. $row['id'] .'" style="background-color: lightblue; color:black; border-color:black">Ištrinti</button>

                                  <button type="button" name="submit" class="btn btn-primary btn-sm" style="background-color: lightblue; color:black; border-color:black">Atnaujinti</button>
                                  </form>' .  '</td></tr>'); 
              $i++;
          }
              print('</tbody></table>');
              
          } else {
          echo "0 results";
          }
      ?>

      <div class="container">
              <div class="row">
                  <div class="col-4">
                  <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>?path=darbuotojai">   
                        <input type="text" name="name" class="form-control" id="name" placeholder="Naujas darbuotojo vardas, pavardė">
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
            print('<tr><th>Nr</th><th>Projektas</th><th>Darbuotojas</th><th>Veiksmai</th><tr><tbody>');
            $i = 1;
            while($row = mysqli_fetch_assoc($result)) {
              print ('<tr>
                  <td>' . $i . '</td>
                  <td>' . $row['project_name']. '</td>'
              );

                echo '<td>';
                $sql2 = 'SELECT employees.name FROM employees WHERE project_id =' . $row['id'];
                $result2 = mysqli_query($conn, $sql2);
                $name = array();
                if (mysqli_num_rows($result2) > 0) {
                  while($row2 = mysqli_fetch_assoc($result2)) {
                    $name[] = $row2['name']; 
                  }
                }
                echo implode(', ', $name);
                echo '</td>';
                print ('<td>' .
                      '<form action="'. $_SERVER['PHP_SELF'] .'" method="post">

                      <button type="submit" name="submit" class="btn btn-primary btn-sm" value="'. $row['id'] .'" style="background-color: lightblue; color:black; border-color:black">Ištrinti</button>

                      <button type="button" name="submit" class="btn btn-primary btn-sm" style="background-color: lightblue; color:black; border-color:black">
                      Atnaujinti
                      </button>
                      </form>' .  '</td></tr>');
                print ('</tr>'); 
                $i++;
            }
                print('</tbody></table>');

            } else {
            echo "0 results";
            }
            
          ?>
                <div class="container">
              <div class="row">
                  <div class="col-4">
                  <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>?path=projektai"> 
                        <input type="text" name="name" class="form-control" id="name" placeholder="Naujas projekto pavadinimas">
                  </div>
                  <div class="col-2">
                        <button type="submit" name="submit" class="btn btn-primary" style="background-color: lightblue; color:black; border-color:black">Pridėti projektą</button>
                  </div>
                      </form>
              </div>
        </div>

        <?php endif; ?>
</body>
</html>