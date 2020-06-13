<html>
    <head>
        <title>Execute Python With PHP</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    </head>
    <body>
        <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 bg-dark text-white" style="min-height: 668px">
                <center>
                    <svg class="bi bi-person-circle mt-4 mb-2" width="80" height="80" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 0 0 8 15a6.987 6.987 0 0 0 5.468-2.63z"/>
                        <path fill-rule="evenodd" d="M8 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                        <path fill-rule="evenodd" d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z"/>
                    </svg>
                    <br>
                    <p>Administrator</p>
                </center>
            </div>
            <div class="col-md-10 pt-2">
            
            <div class="col-md-12 row">
            
            <?php
                if(isset($_GET['chart'])){
                    
                    $chart = $_GET['chart'];
                    if($chart=='timeseries') {
                        $b = 'active'; $a = ''; $c = '';
                    } else {
                        $a = 'active';
                        $b = '';
                        $c = '';
                    }
                
                } else{
                    $chart = 'rawData';
                    $c = 'active'; $b = ''; $a='';
                }
            ?>
            <div class="col-md-2">
                <div class="dropdown">
                    <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Choose Chart
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item <?php echo $c ?>" href="execPython.php">Raw Data</a>
                        <a class="dropdown-item <?php echo $a ?>" href="?chart=kmeans">K-Means</a>
                        <a class="dropdown-item <?php echo $b ?>" href="?chart=timeseries">Time Series</a>
                    </div>
                </div>
            </div>
                    
    <?php
        $file = 'D:/xampp/htdocs/PythonPHP/'.$chart.'.py';
        if(file_exists($file)) {
            echo '<div class="alert alert-info col-md-10" role="alert">File is exist, and placed in '.$file.'</div></div>';
            $command = escapeshellcmd($file);
            $output = shell_exec($command);

            if($output) {
                echo '
                <div class="embed-responsive embed-responsive-16by9" style="border: 1px solid grey; border-radius: 5px;">
                    <iframe id="igraph" class="embed-responsive-item" style="border:none;" scrolling="no" seamless="seamless" 
                src="'.$chart.'.html" height="525" width="100%">
                    </iframe>
                </div>';
            }

            else echo '<div class="alert alert-warning" role="alert">
                        Failed: Unable to generate report :(
                        </div>';
        }

        else echo '<div class="alert alert-warning" role="alert">
                        Warning: The path is incorrect or file is not exist!
                    </div>';
    ?>
            </div>
        </div>
        </div>

    <!-- javasvript dependencies -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    
    </body>
</html>
