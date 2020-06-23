<html>
    <head>
        <title>Execute Python With PHP</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

        <style>
            .sidebar{
                min-height: 668px; 
                background-image: linear-gradient(to bottom right, #10ac84, #0a3d62);
            }

            .iframe-wrapper{
                border: 1px solid grey; 
                border-radius: 5px;
            }

            iframe{
                border:none;
            }
        </style>
    </head>
    <body>
        <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 text-white pt-4 sidebar mr-0">
                <center>
                    <i class="fa fa-user-circle fa-5x"></i>
                    <br><p>Administrator</p>
                </center>
            </div>
            <div class="col-md-10 pt-2">
            
            <div class="col-md-12 row">
            
            <?php
                $a = ''; $b = ''; $c = '';
                if(isset($_GET['chart'])){
                    $chart = $_GET['chart'];
                    if($chart=='timeseries') $b = 'active'; 
                    else $a = 'active';                 
                } else{
                    $chart = 'unclustered';
                    $c = 'active'; 
                }
            ?>

            <div class="col-md-2">
                <div class="dropdown">
                    <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Choose Chart
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" >
                        <a class="dropdown-item <?php echo $c ?>" href="execPython.php">Unclustered Data</a>
                        <a class="dropdown-item <?php echo $a ?>" href="?chart=clustered">Clustered Data</a>
                        <a class="dropdown-item <?php echo $b ?>" href="?chart=timeseries">Time Series</a>
                    </div>
                </div>
            </div>
                    
    <?php
        $file = 'D:/xampp/htdocs/PythonPHP/'.$chart.'.py';
        if(file_exists($file)) {
            echo '<div class="alert alert-info col-md-10" role="alert">
                    File is exist, and placed in '.$file.'
                    </div>
                </div>';
            $command = escapeshellcmd($file);
            $output = shell_exec($command);

            if($output) {
                echo '
                
                <div class="embed-responsive embed-responsive-16by9 shadow iframe-wrapper">
                    <iframe id="igraph" class="embed-responsive-item" scrolling="no" seamless="seamless" 
                src="'.$chart.'-plot.html" height="525" width="100%">
                    </iframe>
                </div>';
            
            } else echo '<div class="alert alert-warning" role="alert">
                        Failed: Unable to generate report :(
                        </div>';
        
        } else echo '<div class="alert alert-warning" role="alert">
                    Warning: The path is incorrect or file is not exist!
                    </div>';
    ?>

                <div class="col-md-12 p-1 mt-5">
                    <center>
                        <p class="text-muted">Alpha Version</p>
                    </center>    
                </div>
 
            </div>
            <!-- End of Content Section -->

            

        </div>
        </div>

    <!-- javasvript dependencies -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    
    </body>
</html>
