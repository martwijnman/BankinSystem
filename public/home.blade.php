<?php 
session_start();
$_SESSION['username'];
$_SESSION['id'];
require_once "conn.php";

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BankingSystem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
    <?php
    $sql = "SELECT * FROM transaction";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $lst = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $rows = [];
    foreach($lst as $data){
        if(1 == $data['user']){
        // Maak een string met de waarden, let op de juiste syntax voor JavaScript arrays
        $rows[] = "['" . $data['title'] . "', " . $data['price'] . "]";
        }
    }

    // Echo de rijen, gescheiden door komma's
    echo implode(",", $rows);
    ?>
]);

        // Set chart options
        var options = {'title':'Your banking data',
                       'width':800,
                       'height':600};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('bankingdata'));
        chart.draw(data, options);
      }
    </script>
</head>
<body>
<header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <!-- Brand -->
                <a class="navbar-brand" href="#">Mybanking</a>

                <!-- Toggle button for mobile view -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navbar links -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Features</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Pricing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                        </li>
                    </ul>
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>
    <main style="padding: 20%; display:flex; justify-content:center; flex-direction:column;">
        <a class="btn btn-primary" href="add.blade.php">add new transaction</a>
        <div style="dispay: flex; justify-content: center;">
            <div>
        <?php
    $sql = "SELECT * FROM transaction";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $lst = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $i = 1000000;
    foreach($lst as $data){
        if($data['user'] == 1){
            $i -= $data['price']; 
        }
    }
    ?>
    <h1> Balance <?php echo $i; ?></h1>
    </div>
    </div>
<div id="bankingdata"></div>
<div class="tablecontainer">
    <table>
        <tr>
            <th>title</th>
            <th>price</th>
            <th>user</th>
        </tr>
        <?php
        $sql = "SELECT * FROM transaction";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $lst = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $j = 1000000;
        foreach($lst as $data){
            if($data['user'] == 1){
                $j -= $data['price']; 
           
        ?>
        <tr>
            <td><?php echo $data['title']; ?></td>
            <td><?php echo $data['price']; ?></td>
            <td><?php echo $data['user']; ?></td>
            <td><form action="controller.php" method="post"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?php echo $data['user']; ?>"><input value="delete" type="submit"></form></td>
        </tr>
        <?php }
        } ?>
    </table>
</div>
    </main>
    <footer style="background-color:#e9ecef;" class="footer mt-auto py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>About Us</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.</p>
                </div>
                <div class="col-md-3">
                    <h5>Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms of Service</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Follow Us</h5>
                    <a href="#" class="me-2"><img src="https://upload.wikimedia.org/wikipedia/commons/4/51/Facebook_f_logo_%282019%29.svg" alt="Facebook" width="24" height="24"></a>
                    <a href="#" class="me-2"><img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Instagram_Logo_2016.svg" alt="Instagram" width="24" height="24"></a>
                    <a href="#"><img src="https://upload.wikimedia.org/wikipedia/commons/c/c4/Twitter_logo_2021.svg" alt="Twitter" width="24" height="24"></a>
                </div>
            </div>
            <div class="text-center mt-3">
                <p>&copy; 2024 MyBanking. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>