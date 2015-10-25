<?php
    include('../include/header.php');
    include('../include/dashboardNavbar.php');
    include('../include/enum.php');
?>
<link href="/css/dashboard.css" rel="stylesheet">

          <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Dashboard</h1>

          <div class="row placeholders">
            <div class="col-xs-6 col-sm-3 placeholder">
              <img data-src="holder.js/200x200/auto/sky" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Label</h4>
              <span class="text-muted">Something else</span>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              <img data-src="holder.js/200x200/auto/vine" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Label</h4>
              <span class="text-muted">Something else</span>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              <img data-src="holder.js/200x200/auto/sky" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Label</h4>
              <span class="text-muted">Something else</span>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              <img data-src="holder.js/200x200/auto/vine" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Label</h4>
              <span class="text-muted">Something else</span>
            </div>
          </div>

          <h2 class="sub-header">Section title</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>City</th>
                  <th>State</th>
                </tr>
              </thead>
              <tbody>
<?php

  $mysqli = new mysqli($dbIp, $dbUser, $dbPass, $dbDb);
  if ($mysqli->connect_errno){
    echo "Error connecting to database";
    echo $mysqli->connect_error;
    exit;
  }
  $sql = "SELECT * FROM `resteraunts`";
  $result = $mysqli->query($sql);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<td>" . $row['id'] . "</td>";
      echo "<td><a href='/admin/viewlocation.php?id=" . $row['id'] . "'>" . $row['name'] . "</a></td>";
      echo "<td>" . substr($row['description'], 0, 15) . "</td>";
      echo "<td>" . $row['city'] . "</td>";
      echo "<td>" . $row['state'] . "</td>";
      echo "</tr>";
    }
  } else {
    echo "Found 0 results";
  }
?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

<?php include('../include/footer.php');?>
