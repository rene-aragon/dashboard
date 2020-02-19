<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Dashboard</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5.12.1/css/all.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

    <!-- Database Connection -->
    <?php
        include 'database.php';
        $DB = new dataBase();
    ?>

    <!-- ChartJS -->
    <script src="js/charts.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <img src="images/icon/logo.png" alt="CoolAdmin" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li>
                            <a href="index.php">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
                        <li>
                            <a href="tabla.php">
                                <i class="fas fa-table"></i>Tablas</a>
                        </li>
                        <li>
                            <a href="grafica.php">
                                <i class="fas fa-chart-bar"></i>Graficas</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="images/icon/logo.png" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li>
                            <a href="index.php">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
                        <li>
                            <a href="tabla.php">
                                <i class="fas fa-table"></i>Tablas</a>
                        </li>
                        <li>
                            <a href="grafica.php">
                                <i class="fas fa-chart-bar"></i>Graficas</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content p-t-10">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row m-t-25">
                            <div class="col-12 col-sm-4">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="fas fa-temperature-low"></i>
                                            </div>
                                            <div class="text">
                                                <h2>
                                                    <?php echo $DB->getLastValueOf("Sensor1")." °C"; ?>
                                                </h2>
                                                <span>Temperatura</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="overview-item overview-item--c2">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="fas fa-flask"></i>
                                            </div>
                                            <div class="text">
                                                <h2>
                                                    <?php echo $DB->getLastValueOf("Sensor2")." ppm"; ?>
                                                </h2>
                                                <span>CH4</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="overview-item overview-item--c3">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="fas fa-flask"></i>
                                            </div>
                                            <div class="text">
                                                <h2>
                                                    <?php echo $DB->getLastValueOf("Sensor3")." ppm"; ?>
                                                </h2>
                                                <span>CO2</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="table-responsive table--no-card m-b-20">
                                    <table class="table table-borderless table-striped table-earning text-center">
                                        <thead>
                                            <tr>
                                                <th>Hora</th>
                                                <th>Temp.</th>
                                                <th>CH4</th>
                                                <th>CO2</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                              $n   = 5;
                                              $tmp = $DB->getLastNValuesOf($n,"Sensor1");
                                              $ch4 = $DB->getLastNValuesOf($n,"Sensor2");
                                              $co2 = $DB->getLastNValuesOf($n,"Sensor3");

                                              for($a=0; $a<$n; $a++)
                                              {
                                                echo "<tr><td></td><td>".$tmp[$a]['valor']." °C</td><td>".$ch4[$a]['valor']." ppm</td><td>".$co2[$a]['valor']." ppm</td></tr>";
                                              }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="au-card m-b-20">
                                    <div class="au-card-inner">
                                        <h3 class="title-2 m-b-40">Temperatura</h3>
                                        <canvas id="temp-chart"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="au-card m-b-20">
                                    <div class="au-card-inner">
                                        <h3 class="title-2 m-b-40">CH4</h3>
                                        <canvas id="metano-chart"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="au-card m-b-20 pb-sm-80">
                                    <div class="au-card-inner">
                                        <h3 class="title-2 m-b-40">CO2</h3>
                                        <canvas id="carbono-chart"></canvas>
                                    </div>
                                </div>
                            </div>
                            <?php
                                $labelValues = ["13:00","13:30","14:00","14:30","15:00"];

                                echo "<script type='text/javascript'> var dv_tmp =[]; var dv_ch4 = []; var dv_co2 = []; var lv = [];";
                                for($a=0; $a<$n; $a++)
                                {
                                    echo 'dv_tmp['.$a.'] = "'.$tmp[$a]['valor'].'";';
                                    echo 'dv_ch4['.$a.'] = "'.$ch4[$a]['valor'].'";';
                                    echo 'dv_co2['.$a.'] = "'.$co2[$a]['valor'].'";';
                                    echo 'lv['.$a.'] = "'.$labelValues[$a].'";';
                                }
                                echo "updateChart(\"temp-chart\",lv,dv_tmp);";
                                echo "updateChart(\"metano-chart\",lv,dv_ch4);";
                                echo "updateChart(\"carbono-chart\",lv,dv_co2);</script>";
                            ?>
                        </div>
                        <div class="end">
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->
