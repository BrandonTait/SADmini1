<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Simple Database App</title>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>

<style>
    /* adds some margin below the link sets  */
    .navbar .dropdown-menu div[class*="col"] {
        margin-bottom:1rem;
    }

    .navbar .dropdown-menu {
        border:none;
        background-color:#0060c8!important;
    }

    /* breakpoint and up - mega dropdown styles */
    @media screen and (min-width: 992px) {

        /* remove the padding from the navbar so the dropdown hover state is not broken */
        .navbar {
            padding-top:0px;
            padding-bottom:0px;
        }

        /* remove the padding from the nav-item and add some margin to give some breathing room on hovers */
        .navbar .nav-item {
            padding:.5rem .5rem;
            margin:0 .25rem;
        }

        /* makes the dropdown full width  */
        .navbar .dropdown {position:static;}

        .navbar .dropdown-menu {
            width:100%;
            left:0;
            right:0;
            /*  height of nav-item  */
            top:45px;
        }

        /* shows the dropdown menu on hover */
        .navbar .dropdown:hover .dropdown-menu, .navbar .dropdown .dropdown-menu:hover {
            display:block!important;
        }

        .navbar .dropdown-menu {
            border: 1px solid rgba(0,0,0,.15);
            background-color: #fff;
        }

    }


</style>
<script>
    $(document).ready(function() {
        // executes when HTML-Document is loaded and DOM is ready

// breakpoint and up
        $(window).resize(function(){
            if ($(window).width() >= 980){

                // when you hover a toggle show its dropdown menu
                $(".navbar .dropdown-toggle").hover(function () {
                    $(this).parent().toggleClass("show");
                    $(this).parent().find(".dropdown-menu").toggleClass("show");
                });

                // hide the menu when the mouse leaves the dropdown
                $( ".navbar .dropdown-menu" ).mouseleave(function() {
                    $(this).removeClass("show");
                });

                // do something here
            }
        });

// document ready
    });
</script>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="/index.php">Ann+Bill Management</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/create.php">Add New Customer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/custtable.php">View Customers</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Customer Management
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">


                        <div class="container">
                            <div class="row">
                                <div class="col-md-4">
                                    <span class="text-uppercase text-white">Add New Customer</span>
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="">Active</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Link item</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Link item</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--  /.container  -->


                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Category 2
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">


                        <div class="container">
                            <div class="row">
                                <div class="col-md-4">
                                    <span class="text-uppercase text-white">Category 2</span>
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#">Active</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Link item</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Link item</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- /.col-md-4  -->
                                <div class="col-md-4">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#">Active</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Link item</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Link item</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- /.col-md-4  -->
                                <div class="col-md-4">
                                    <a href="">
                                        <img src="https://dummyimage.com/200x100/ccc/000&text=image+link" alt="" class="img-fluid">
                                    </a>
                                    <p class="text-white">Short image call to action</p>

                                </div>
                                <!-- /.col-md-4  -->
                            </div>
                        </div>
                        <!--  /.container  -->


                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Category 3
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">


                        <div class="container">
                            <div class="row">
                                <div class="col-md-4">
                                    <span class="text-uppercase text-white">Category 3</span>
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#">Active</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Link item</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Link item</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- /.col-md-4  -->
                                <div class="col-md-4">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#">Active</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Link item</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Link item</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- /.col-md-4  -->
                                <div class="col-md-4">

                                    <a href="">
                                        <img src="https://dummyimage.com/200x100/ccc/000&text=image+link" alt="" class="img-fluid">
                                    </a>
                                    <p class="text-white">Short image call to action</p>

                                </div>
                                <!-- /.col-md-4  -->
                            </div>
                        </div>
                        <!--  /.container  -->


                    </div>
                </li>

            </ul>
<!--            <form class="form-inline my-2 my-lg-0">-->
<!--                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">-->
<!--                <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>-->
<!--            </form>-->
        </div>


    </nav>
<br>
</body>