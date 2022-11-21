<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gosky</title>
    <!-- fontawsome -->
    <link rel="stylesheet" href="<?=base_url()?>assets_gosky/css/flight/fsIcon.css">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" /> -->

    <!--bootstrap  -->
    <link rel="stylesheet" href="<?=base_url()?>assets_gosky/css/bootstrap.min.css">
    <!-- datepicker -->
    <link rel="stylesheet" href="<?=base_url()?>assets_gosky/css/jquery-ui.css">

    <!-- custom css -->
    <!-- <link rel="stylesheet" href="<?=base_url()?>assets_gosky/css/style.css"> -->

    <link rel="stylesheet" href="<?=base_url()?>assets_gosky/css/flight/flight.css">
    <link rel="stylesheet" href="<?=base_url()?>assets_gosky/css/flight/flight_responsive.css">

    <style>
        @media (min-width: 1400px){
.container, .container-lg, .container-md, .container-sm, .container-xl, .container-xxl {
    max-width: 1140px;
}
}
    </style>

</head>

<body>
    <!-- heaader start -->
    <header class="bg_color header_padding">
        <nav class="navbar navbar-expand-lg navbar-dark ">
            <div class="container nav_display">
                <a class="navbar-brand" href="<?=base_url();?>">Gosky-Logo</a>
                <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="res_d_none">
                    <ul class="search_tab_ul">
                        <li class="mainlinks active">
                            <a class="main_icon_anchor"><span class="Main_icon"><i
                                        class="fa fa-plane rotate_icon "></i></span>Flights</a>
                        </li>
                        <li class="mainlinks">
                            <a class="main_icon_anchor" href="#"><span class="Main_icon"><i
                                        class="fa fa-bed"></i></span>Hotels</a>
                        </li>



                    </ul>
                </div>

                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">


                    <ul class="navbar-nav  mb-2 mb-lg-0">



                        <li class="nav-item dropdown nav_border">
                            <a class="nav-link " href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                                data-bs-offset="10,20" aria-expanded="false">
                                B2B
                            </a>

                        </li>
                        <li class="nav-item dropdown nav_border">
                            <a class="nav-link " href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                                data-bs-offset="10,20" aria-expanded="false">
                                B2C
                            </a>

                        </li>

                        <li class="nav-item dropdown nav_border2">
                            <a class="nav-link " href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                                data-bs-offset="10,20" aria-expanded="false">
                                Request a callback
                            </a>

                        </li>
                    </ul>

                </div>

            </div>
        </nav>
    </header>
    <!-- header end -->