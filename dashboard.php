<?php

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Admin Dashboard | Task Manager</title>
        <link rel="stylesheet" href="css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
    </head>
    <body>
    <!-- Menu Bar Start Here -->
    <nav class="navbar navbar-expand-sm navbar-dark bg-info">
        <div class="container">
            <a href="#" class="navbar-brand">
                <img src="images/task-manager-logo.png" alt="" style="width: 160px; height: 50px;" />
            </a>

            <div class="collapse navbar-collapse" id="mainMenu">
                <ul class="navbar-nav mr-auto" style="padding-left: 40px;">
                    <li class="font-weight-bold pl-3"><a href="add-client.html" class="nav-link">Add Client</a></li>
                    <li class="font-weight-bold pl-3"><a href="add-employee.html" class="nav-link">Add Employee</a></li>
                    <li class="dropdown font-weight-bold pl-3"><a href="" class="nav-link dropdown-toggle" data-toggle="dropdown">Manage Projects</a>
                        <ul class="dropdown-menu bg-info">
                            <li><a href="add-project.html" class="nav-link">Add Projects</a></li>
                            <li><a href="add-modules.html" class="nav-link">Add Modules</a></li>
                        </ul>
                    </li>
                    <li class="font-weight-bold pl-3"><a href="assign-project.html" class="nav-link">Assign Project</a></li>

                </ul>

                <ul class="navbar-nav ">

                    <li class="font-weight-bold"><a href="sign-out.php" class="nav-link">Sign Out</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Menu Bar End Here -->

    <!-- Main Body Part Start Here -->
    <div class="container">
        <div class="row">
            <!-- Side Menu Bar Start  -->
            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-12 float-left pt-5 pl-0 pr-0">
                <ul class="list-unstyled">
                    <a href="add-client.html" ><button type="button" class="btn btn-outline-info w-100 col-md-auto"> Add Client </button> </a>
                    <a href="add-employee.html" ><button type="button" class="btn btn-outline-info w-100 col-md-auto"> Add Employee </button> </a>
                    <a href="add-project.html" ><button type="button" class="btn btn-outline-info w-100"> Add Projects </button> </a>
                    <a href="add-modules.html" ><button type="button" class="btn btn-outline-info w-100"> Add Modules </button> </a>
                    <a href="assign-project.html" ><button type="button" class="btn btn-outline-info w-100"> Assign Project </button> </a>
                    <a href="sign-out.php" ><button type="button" class="btn btn-outline-info w-100"> Sign Out </button> </a>
                </ul>
            </div>

        <!-- Side Menu Bar End -->
        <!-- Main Operation Part Start Here -->
            <div class="col-xl-10 col-lg-10 col-md-6 col-sm-6 col-12 float-left pt-5 pl-0 pr-0 text-center">
                <h3>Welcome to <br /><br /> TASK MANAGEMENT SYSTEM</h3>
            </div>
        <!-- Main Operation Part Start Here -->
        </div>
    </div>
    <!-- Main Body Part End Here -->


        <script src="js/jquery-3.2.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="js/bootstrap.js"></script>
    </body>
</html>