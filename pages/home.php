<?php 
require_once "config.php";
require_once LIBS . "home.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href=<?php echo ASSETS . "images/favicon.png" ?>>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | KMA CTF</title>

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
                <a class="navbar-brand" href="#">CPanel</a>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul id="active" class="nav navbar-nav side-nav">
                    <li class="selected"><a href="#"><i class="fa fa-bullseye"></i> Dashboard</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right navbar-user">
                    <li>
                        <a href="/?scoreboard"><b> Scoreboard</b></a>
                    </li>
                    <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo @xsssafe($data->username) . "&nbsp;"; ?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a id="logout"><i class="fa fa-power-off"></i> Log Out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12" >
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="fa fa-bar-chart-o"></i> Scoreboard 
                                <button type="button" id="addScore" class="btn btn-info btn-sm" data-toggle="modal" data-target="#addModal" style="float: right; margin-top: -5px;">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </h3>

                        </div>
                        <div class="panel-body">
                            <div id="scoreboard"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-pencil"></i> Update Profile</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-user-circle "></i></span>
                                <input type="text" id="fullname" class="form-control" placeholder="Full name">
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-address-book-o"></i></span>
                                <input type="text" id="class" class="form-control" placeholder="Class">
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                                <input type="text" id="email" class="form-control" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <select class="form-control" id="mainCategory">
                                    <option selected>Web Exploit</option>
                                    <option>Reverse Engineer</option>
                                    <option>Pwnable</option>
                                    <option>Cryptography</option>
                                    <option>Forensic</option>
                                    <option>Misc</option>
                                </select>
                            </div>
                            <div>
                                <span id="notice" style="color: red"></span>
                                <button type="button" id="updateinfo" class="btn btn-sm btn-primary pull-right">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-address-card-o"></i> Profile</h3>
                        </div>
                        <div class="panel-body">
                            <div class="col-lg-4">
                                <p>Nickname:</p>
                                <p>Fullname:</p>
                                <p>Main category:</p>
                                <p>Class:</p>
                                <p>Email:</p>
                                <p>About:</p>
                            </div>
                            <div class="col-lg-4 info">
                                <p><?php echo @xsssafe($data->username) . "&nbsp;"; ?></p>
                                <p><?php echo @xsssafe($data->fullname) . "&nbsp;"; ?></p>
                                <p><?php echo @xsssafe($data->main_category) . "&nbsp;"; ?></p>
                                <p><?php echo @xsssafe($data->class) . "&nbsp;"; ?></p>
                                <p><?php echo @xsssafe($data->email) . "&nbsp;"; ?></p>
                                <p>...</p>
                            </div>
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
            <h4 class="modal-title">Add event and score</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
                <label class="control-label" for="addEvent">Event:</label>
                <select class="form-control" id="addEvent"></select>
            </div>
            <div class="form-group addScore">
                <label class="control-label" for="addWeb">Web Exploit:</label>
                <input type="number" class="form-control" id="addWeb">
                <label class="control-label" for="addRE">Reverse Engineer:</label>
                <input type="number" class="form-control" id="addRE">
            </div>
            <div class="form-group addScore">
                <label class="control-label" for="addPwn">Pwnable:</label>
                <input type="number" class="form-control" id="addPwn">
                <label class="control-label" for="addCrypt">Cryptography:</label>
                <input type="number" class="form-control" id="addCrypt">
            </div>
            <div class="form-group addScore">
                <label class="control-label" for="addFor">Forensic:</label>
                <input type="number" class="form-control" id="addFor">
                <label class="control-label" for="addMisc">Misc:</label>
                <input type="number" class="form-control" id="addMisc">
            </div>
          </div>
          <div class="modal-footer">
            <span id="noticeModal" style="color: red; float: left;"></span>
            <button type="button" id="addbtn" class="btn btn-default">Submit</button>
          </div>
        </div>

      </div>
    </div>
    <!-- Events -->
    <script type="text/javascript" src=<?php echo ASSETS . "js/home.js";?> charset="utf-8"></script>
</body>
</html>
