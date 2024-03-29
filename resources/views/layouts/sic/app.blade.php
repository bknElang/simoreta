<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>{{Request::route()->getName()}}</title>
    <link rel="icon" href="{{asset('assets/icon.png')}}">

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/customhover.css')}}">

    <!-- Font Awesome CCS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <div class="row">
                    <div class="col">
                        <a href="/users/{{auth()->user()->id}}" id="imgAva"><img src="{{asset('images/'.auth()->user()->avatar)}}" class="rounded mx-auto d-block" style="width:75px; height:75px"></a>
                    </div>
                    
                    <div class="col" id="profile">
                        <label>{{auth()->user()->name}}</label>
                        <br>
                        <label>{{auth()->user()->NIP}}</label>
                    </div>
                </div>

                <a href="/users/{{auth()->user()->id}}"><strong><img src="{{asset('images/'.auth()->user()->avatar)}}" class="rounded mx-auto d-block" style="width:50px; height:50px"></strong></a>
            </div>

            <ul class="list-unstyled components">
                <li>
                    <a href="/home">
                        <i class="fas fa-home"></i>
                        Home
                    </a>
                </li>
                 <li>
                    <a href="#todolist" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-clipboard-list" style="margin-left:3px; margin-right:4px"></i>
                        To Do List
                    </a>
                    <ul class="collapse list-unstyled" id="todolist">
                        <li>
                            <a href="/todojob">Requested Job</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#logistikSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-dolly-flatbed"></i>
                        Logistik
                    </a>
                    <ul class="collapse list-unstyled" id="logistikSubmenu">
                        <li>
                            <a href="/aktiva">Kebutuhan Aktiva</a>
                        </li>
                        <li>
                            <a href="#">Kebutuhan Aktiva</a>
                        </li>
                        <li>
                            <a href="/atk">Kebutuhan ATK</a>
                        </li>
                        <li>
                            <a href="/ordercar">Kendaraan</a>
                        </li>
                        <li>
                            <a href="/reimbursement">Reimbursement</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-book" style="margin-left:3px; margin-right:3px"></i>
                        Pembukuan
                    </a>
                </li>
                <li>
                    <a href="/requestjob">
                        <i class="fas fa-hand-holding"></i>
                        Request Job
                    </a>
                </li>
                <li>
                    <a href="#myStatus" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-id-badge" style="margin-left:3px; margin-right:4px"></i>
                        My Status
                    </a>
                    <ul class="collapse list-unstyled" id="myStatus">
                        <li>
                            <a href="#myStatusLogistik" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                Logistik
                            </a>
                            <ul class="collapse list-unstyled" id="myStatusLogistik">
                                <li>
                                    <a href="/myaktiva">Kebutuhan Aktiva</a>
                                </li>
                                <li>
                                    <a href="/myatk">Kebutuhan ATK</a>
                                </li>
                                <li>
                                    <a href="/myordercar">Kendaraan</a>
                                </li>
                                <li>
                                    <a href="/myreimbursement">Reimbursement</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#myStatusBuku" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                Pembukuan
                            </a>
                            <ul class="collapse list-unstyled" id="myStatusBuku">
                                <li>
                                    <a href="/myjurnalmanual">Jurnal Manual</a>
                                </li>
                                <li>
                                    <a href="/myjurnalaak">Jurnal AAK</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="/myjob">Requested Jobs</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-folder-open"></i>
                        Laporan
                    </a>
                </li>
            </ul>

        </nav>

        <!-- Menu Bar di Atas  -->
        <div id="content" class="bg fade-in">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-light">
                        <i class="fas fa-align-left"></i>
                        <span></span>
                    </button>
                    <button class="btn btn-light d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>
                    <a href="/home"><img src="{{asset('assets/simoreta.png')}}" id="navimg" alt=""></a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="/changepassword/{{auth()->user()->id}}"> Change Password</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            
            <!-- Content -->
            @yield('content')
        </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            var prof = document.getElementById("profile");
            var ava = document.getElementById("imgAva");
            
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                if(prof.style.display === "none") prof.style.display = "block";
                else prof.style.display = "none";

                if(ava.style.display === "none") ava.style.display = "block";
                else ava.style.display = "none";
            });
        });
    </script>
</body>

</html>