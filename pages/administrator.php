<?php 
require_once "config.php";
require_once LIBS . "administrator.php";
require_once LIBS . "validating.php";
require_once MODEL;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href=<?php echo ASSETS . "images/favicon.png" ?>>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | KMA CTF</title>

    <link rel="stylesheet" type="text/css" href=<?php echo ASSETS . "bootstrap/css/bootstrap.min.css"?> />
    <link rel="stylesheet" type="text/css" href=<?php echo ASSETS . "font-awesome/css/font-awesome.min.css"?> />
    <link rel="stylesheet" type="text/css" href=<?php echo ASSETS . "theme-dashboard/css/local.css"?> />

    <script type="text/javascript" src=<?php echo ASSETS . "js/jquery-1.10.2.min.js"?>></script>
    <script type="text/javascript" src=<?php echo ASSETS . "bootstrap/js/bootstrap.min.js"?>></script>

    <link id="gridcss" rel="stylesheet" type="text/css" href=<?php echo ASSETS . "theme-dashboard/css/dark-bootstrap-all.min.css"?> />

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
                <a class="navbar-brand" href="#">Administrator</a>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul id="active" class="nav navbar-nav side-nav">
                    <li class="selected"><a href="#"><i class="fa fa-bullseye"></i> Dashboard</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right navbar-user">
                    <li><a href="/?scoreboard"><b> Scoreboard</b></a></li>
                    <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo @xsssafe($data->username) . "&nbsp;"; ?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a id="reset"><i class="fa fa-refresh"></i> Reset Score</a></li>
                            <li><a id="logout"><i class="fa fa-power-off"></i> Log Out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="fa fa-bar-chart-o"></i> Events 
                                <button type="button" id="addScore" class="btn btn-info btn-sm" data-toggle="modal" data-target="#addModal" style="float: right; margin-top: -5px;">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </h3>

                        </div>
                        <div class="panel-body">
                            <div id="events"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="fa fa-bar-chart-o"></i> Confirmation 
                            </h3>
                        </div>
                        <div class="panel-body">
                            <div id="confirmation" onclick="btnClick()"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /#wrapper -->
    <!-- Model -->
    <div id="addModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add Event</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
                <label class="control-label" for="addEvent">Name:</label>
                <input type="text" class="form-control" id="addEvent">
            </div>
            <div class="form-group addScore">
                <label class="control-label" for="addWeight">Weight:</label>
                <input type="number" class="form-control" id="addWeight">
            </div>
            <div class="form-group addScore">
                <label class="control-label" for="addMaxScore">Max score:</label>
                <input type="number" class="form-control" id="addMaxScore">
            </div>
            <div class="form-group addScore">
                <label class="control-label" for="addDate">Start time:</label>
                <input type="date" class="form-control" id="addDate">
            </div>
          </div>
          <div class="modal-footer">
            <span id="noticeModal" style="color: red; float: left;">&nbsp;</span>
            <button type="button" id="addbtn" class="btn btn-default">Submit</button>
          </div>
        </div>

      </div>
    </div>
    <!-- Events -->
    <script type="text/javascript" src=<?php echo ASSETS . "js/administrator.js"; ?> charset="utf-8"></script>
</body>
</html>