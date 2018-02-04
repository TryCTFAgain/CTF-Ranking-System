<?php 
require_once "config.php";
require_once LIBS . "profile.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href=<?php echo ASSETS . "images/favicon.png" ?>>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | KMA CTF</title>

    <link rel="stylesheet" type="text/css" href=<?php echo ASSETS . "bootstrap/css/bootstrap.min.css"?> />
    <link rel="stylesheet" type="text/css" href=<?php echo ASSETS . "font-awesome/css/font-awesome.min.css"?> />
    <link rel="stylesheet" type="text/css" href=<?php echo ASSETS . "theme-dashboard/css/local.css"?> />

    <script type="text/javascript" src=<?php echo ASSETS . "js/jquery-1.10.2.min.js"?>></script>
    <script type="text/javascript" src=<?php echo ASSETS . "bootstrap/js/bootstrap.min.js"?>></script>

    <link id="gridcss" rel="stylesheet" type="text/css" href=<?php echo ASSETS . "theme-dashboard/css/dark-bootstrap-all.min.css"?> />
    <link id="gridcss" rel="stylesheet" type="text/css" href=<?php echo ASSETS . "css/profile.css"?> />

    <script type="text/javascript" src=<?php echo ASSETS . "theme-dashboard/js/shieldui-all.min.js"?>></script>
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Profile</a>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav navbar-right navbar-user">
                    <li>
                        <a href="/?scoreboard"><b> Scoreboard</b></a>
                    </li>
                </ul>
            </div>
        </nav>

        <div id="page-wrapper">
            <div class="col-sm-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-address-card-o"></i> Profile</h3>
                        </div>
                        <div class="panel-body">
                            <div class="col-lg-4">
                                <p>Nickname:</p>
                                <p>Fullname:</p>
                                <p>Main:</p>
                                <p>Class:</p>
                                <p>Email:</p>
                                <p>About:</p>
                            </div>
                            <div class="col-lg-8 info" id="info">
                            </div>
                        </div>
                    </div>
            </div>

            <div class="col-sm-8">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="fa fa-bar-chart-o"></i> Scoreboard 
                            </button>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div id="scoreboard"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /#wrapper -->
    <!-- Events -->
    <script type="text/javascript" charset="utf-8" async defer>var userid = "<?php echo xsssafe($userid); ?>";</script>
    <script type="text/javascript" src=<?php echo ASSETS . "js/profile.js";?> charset="utf-8"></script>
</body>
</html>
