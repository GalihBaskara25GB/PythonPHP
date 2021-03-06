<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Python's Plotly with PHP</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="demo/demo.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

</head>

<body>

    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header pt-2">
                <h3>Python PHP</h3>
                <strong>PP</strong>
            </div>

            <ul class="list-unstyled components">
                <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">
                        <i class="fa fa-tachometer-alt"></i>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-copy"></i>
                        Pages
                    </a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="#">Analyze Data</a>
                        </li>
                        <li>
                            <a href="#">Report</a>
                        </li>
                        <li>
                            <a href="#">Manipulate Data</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-image"></i>
                        Portfolio
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-question"></i>
                        FAQ
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-paper-plane"></i>
                        Contact
                    </a>
                </li>
            </ul>

        </nav>

        <!-- Page Content  -->
        <div class="col-md-12 p-0" id="content">

            <nav class="navbar navbar-expand-lg navbar-dark bg-dark pt-0 pb-1 pr-2">

                    <button type="button" id="sidebarCollapse" class="navbar-btn rounded">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link text-white" href="#">
                                    <img src="demo/man.jpg" width="35px" height="35px" alt="Richard Zelinka" class="img rounded-circle">
                                    &emsp;|&emsp;Richard Z
                                </a>
                            </li>
                        </ul>
                    </div>

            </nav>

            <?php
                $ucl = ''; $cl = ''; $ts = '';
                if(isset($_GET['chart'])){
                    $chart = $_GET['chart'];
                    if($chart=='timeseries') $ts = 'active'; 
                    else $cl = 'active';                 
                } else{
                    $chart = 'unclustered';
                    $ucl = 'active'; 
                }
            ?>

            <div class="main-content shadow-lg pt-3 rounded">
                <ul class="nav nav-tabs pl-2">
                    <li class="nav-item">
                      <a class="nav-link border-0 <?php echo $ucl ?>" id="unclustered" href="index.php">Unclustered Data</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link border-0 <?php echo $cl ?>" id="clustered" href="?chart=clustered">Clustered Data</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link border-0 <?php echo $ts ?>" id="timeseries" href="?chart=timeseries">Timeseries</a>
                    </li>
                </ul>
                <div class="card border-0 rounded-0">
                    <div class="card-body">

                <?php
                    //
                    // $file is the path to the project, change the value based on your project's path
                    // e.g : if you placed your xampp folder in C drive, inside WEB folder, then you must change it like this:
                    //       $file = 'C:/WEB/xampp/htdocs/PythonPHP/'.$chart.'.py';
                    //

                    $file = 'D:/xampp/htdocs/PythonPHP/'.$chart.'.py';
                    if(file_exists($file)) {
                        $command = escapeshellcmd($file);
                        $output = shell_exec($command);

                        if($output) {
                            echo '
                            
                            <div class="embed-responsive embed-responsive-16by9 iframe-wrapper">
                                <iframe id="igraph" class="embed-responsive-item" scrolling="no" seamless="seamless" 
                            src="assets/'.$chart.'-plot.html" height="525" width="100%">
                                </iframe>
                            </div>';
                        
                        } else echo '<div class="alert alert-warning" role="alert">
                                    Failed: Unable to generate report :(
                                    </div>';
                    
                    } else echo '<div class="alert alert-warning" role="alert">
                                Warning: The path is incorrect or file is not exist!
                                </div>';
                ?>

                    </div>
                  </div>
                </div>
            </div>

        </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $('#content').toggleClass('active');
                $(this).toggleClass('active');
            });
        });
    </script>

</body>

</html>