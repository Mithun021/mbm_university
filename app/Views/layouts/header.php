<!DOCTYPE html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>The Central University of Jharkhand </title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>public/assets/img/favicon.png" />
    <!-- Normalize CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>public/assets/css/normalize.css" />
    <!-- Main CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>public/assets/css/main.css" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>public/assets/css/bootstrap.min.css" />
    <!-- Animate CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>public/assets/css/animate.min.css" />
    <!-- Font-awesome CSS-->
    <link rel="stylesheet" href="<?= base_url() ?>public/assets/css/font-awesome.min.css" />
    <!-- Owl Caousel CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendor/OwlCarousel/owl.carousel.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendor/OwlCarousel/owl.theme.default.min.css" />
    <!-- Main Menu CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>public/assets/css/meanmenu.min.css" />
    <!-- nivo slider CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendor/slider/css/nivo-slider.css" type="text/css" />
    <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendor/slider/css/preview.css" type="text/css" media="screen" />
    <!-- Datetime Picker Style CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>public/assets/css/jquery.datetimepicker.css" />
    <!-- Magic popup CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>public/assets/css/magnific-popup.css" />
    <!-- Switch Style CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>public/assets/css/hover-min.css" />
    <!-- ReImageGrid CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>public/assets/css/reImageGrid.css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>public/assets/css/style.css" />
    <!-- Modernizr Js -->
    <script src="<?= base_url() ?>public/assets/js/modernizr-2.8.3.min.js"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"/>
    <style>
        .go-corner {
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            width: 32px;
            height: 32px;
            overflow: hidden;
            top: 0;
            right: 0;
            background-color: #fdc800;
            border-radius: 0 4px 0 32px;
        }

        .go-arrow {
            margin-top: -4px;
            margin-right: -4px;
            color: white;
            font-family: courier, sans;
        }

        .card1 {
            display: flex;
            flex-direction: column;
            position: relative;
            justify-content: start;
            text-align: center;
            align-items: center;
            max-width: 234px;
            width: 108px;
            background-color: #f2f8f9;
            border-radius: 4px;
            padding: 10px 10px;
            margin: 10px;
            text-decoration: none;
            z-index: 0;
            overflow: hidden;
        }

        .card1:before {
            content: "";
            position: absolute;
            z-index: -1;
            top: -16px;
            right: -16px;
            background: #fdc800;
            height: 32px;
            width: 32px;
            border-radius: 32px;
            transform: scale(1);
            transform-origin: 50% 50%;
            transition: transform 0.25s ease-out;
        }

        .card1:hover:before {
            transform: scale(21);
        }

        .card1:hover p {
            transition: all 0.3s ease-out;
            color: rgba(255, 255, 255, 0.8);
        }

        .card1:hover h5 {
            transition: all 0.3s ease-out;
            color: #f2f8f9;
        }

        .card1 h5 {
            font-size: 15px;
            line-height: 18px;
        }

        #sticker {
            position: relative;
        }

        .header3-area .header-top-area .header-top-left ul li a {
            color: #000000;
        }

        .main-menu-area .logo-area {
            margin: 20px 10px;
        }

        .lecturers-img-wrapper img {
            border: 7px solid #f1bf02;
        }
    </style>
    <style>
        .social-btn {
            display: flex;
            align-items: center;
            padding-left: 30px;
            padding-right: 20px;
            padding-top: 5px;
            padding-bottom: 5px;
            border: 1px;
            border-bottom-right-radius: 30px;
            border-top-right-radius: 30px;
            margin-bottom: 5px;
            position: relative;
            left: -25px;
            transition: left 1s;
        }

        .social-btn:hover {
            left: -15px;
            transition: left 1s;
        }

        .social {
            position: fixed;
            top: 60%;
            z-index: 111;
        }

        .social a {
            text-decoration: none;
        }

        .color-online {
            background-color: #033774;
        }

        .color-admi {
            background-color: #f1bf02;
        }

        .color-fee {
            background-color: #24cc63;
        }

        .google-font a {
            font-family: "Lato", sans-serif;
            font-size: 1rem;
            color: white;
        }

        .social-btn img {
            width: 40px;
        }

        .social-btn p {
            color: white;
            margin-top: 0px;
            margin-bottom: 0px;
        }
    .style1 {font-weight: bold}
    </style>
</head>

<body>
    <!--[if lt IE 8]>
      <p class="browserupgrade">
        You are using an <strong>outdated</strong> browser. Please
        <a href="http://browsehappy.com/">upgrade your browser</a> to improve
        your experience.
      </p>
    <![endif]-->
    <!-- Add your site or application content here -->
    <!-- Preloader Start Here 
    <div id="preloader"></div>
    <!-- Preloader End Here -->
    <!-- Main Body Area Start Here -->

    

    <div id="wrapper">
        <!-- Header Area Start Here -->
         <header>
     <div id="header3" class="header3-area">
         

     <div class="header-top-area">
        <div class="container">
            <div class="">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                        <div class="header-top-left">
                            <a href="#">Screen Reader</a>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12">
                        <div class="header-top-right">
                            <ul>
                                <li class="dropdown">
                                    <a class="login-btn-area" href="#"><i class="" aria-hidden="true"></i>
                                        Press Release </a>
                                    <div class="dropdown-content">
                                        <a href="#">2023</a>
                                        <a href="#">2024</a>
                                    </div>
                                </li>

                                <li class="dropdown">
                                    <a class="login-btn-area" href="#"><i class="" aria-hidden="true"></i>
                                        Gallery</a>
                                    <div class="dropdown-content">
                                        <a href="#">2024</a>
                                        <a href="#">2023</a>
                                    </div>
                                </li>

                                <li>
                                    <a class="login-btn-area" href="#"><i class="" aria-hidden="true"></i>
                                        Placement</a>
                                </li>

                                <li>
                                    <a class="login-btn-area" href="#"><i class="" aria-hidden="true"></i>
                                        Tender</a>
                                </li>

                                <li class="dropdown">
                                    <a class="login-btn-area" href="#"><i class="" aria-hidden="true"></i>
                                        Samarth Login</a>
                                    <div class="dropdown-content">
                                        <a href="#">Employees</a>
                                        <a href="#">Student</a>
                                    </div>
                                </li>

                                <li>
                                    <a class="login-btn-area" href="#"><i class="" aria-hidden="true"></i>
                                        Contact</a>
                                </li>

                                <li><a class="login-btn-area" href="#"><i class="" aria-hidden="true"></i>
                                    Go to Old Site</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


         <div class="main-menu-area bg-primary" id="sticker">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-2 col-md-3">
                        <div class="logo-area">
                            <a href="<?= base_url() ?>"><img class="img-responsive" src="<?= base_url() ?>public/assets/image/logo.png" alt="logo" style="
                                height: 60px;
                                top: 0;
                                bottom: 0;
                                margin: auto;
                                position: absolute;
                                width: auto !important;
                                max-width: initial;
                            " /></a>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-9">
                        <nav id="desktop-nav">
                            <ul>
                                <li>
                                    <a href="<?= base_url() ?>">Home</a> 
                                    <ul class="">
                                        <li><a href="#">About Us</a></li>
                                        <li><a href="#">Statutory Body</a></li>
                                        <li><a href="#">Kulgeet</a></li>
                                        <li><a href="#">Act/Statute</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Governance</a>
                                    <ul class="mega-menu-area">
                                        <li><a href="#">Visitor</a></li>
                                        <li><a href="#">Chancellor</a></li>
                                        <li><a href="#">Founding Vice Chancellor</a></li>
                                        <li><a href="#">Vice Chancellor</a></li>
                                        <li><a href="#">Registrar</a></li>
                                        <li><a href="#">Finance Officer</a></li>
                                        <li><a href="#">Controller of Examination</a></li>
                                        <li><a href="#">Librarian</a></li>
                                        <li><a href="#">Dean Students Welfare</a></li>
                                        <li><a href="#">Proctorial Board</a></li>
                                        <li><a href="#">Statutory Officers</a></li>
                                        <li><a href="#">Teaching Employees</a></li>
                                        <li><a href="#">Officers & Staffs</a></li>
                                        <li><a href="#">Organogram</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Academics</a>
                                    <ul>
                                        <li><a href="#">Department</a></li>
                                        <li><a href="#">School</a></li>
                                        <li><a href="#">Deans</a></li>
                                        <li><a href="#">Faculty Profile</a></li>
                                        <li><a href="#">Institution's Innovation Council</a></li>
                                        <li><a href="#">Programs</a></li>
                                        <li><a href="#">Syllabus</a></li>
                                        <li><a href="#">Board of Studies</a></li>
                                        <li><a href="#">Research & Development</a></li>
                                        <li><a href="#">Achievement</a></li>
                                        <li><a href="#">ILMS</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Admission</a>
                                    <ul>
                                        <li><a href="#">Admission-2024</a></li>
                                        <li><a href="#">Admission-2023</a></li>
                                        <li><a href="#">Admission-2022</a></li>
                                        <li><a href="#">Admission Rules</a></li>
                                        <li><a href="#">Admission Cell</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Examination</a></li>
                                <li>
                                    <a href="#">Student</a>
                                    <ul>
                                        <li><a href="#">Students Corner</a></li>
                                        <li><a href="#">Hostel</a></li>
                                        <li><a href="#">Convocation</a></li>
                                        <li><a href="#">Alumni</a></li>
                                        <li><a href="#">Student/Exam Notices</a></li>
                                        <li><a href="#">Downloads Forms</a></li>
                                        <li><a href="#">NSS</a></li>
                                        <li><a href="#">NCC</a></li>
                                        <li><a href="#">Students Discipline and Conduct rules</a></li>
                                        <li><a href="#">Ragging</a></li>
                                        <li><a href="#">Digi-Locker Account</a></li>
                                        <li><a href="#">Fee Structure</a></li>
                                        <li><a href="#">Grievance Redressal</a></li>
                                        <li><a href="#">PhD Scholars</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Library</a></li>
                                <li><a href="#">IQAC</a></li>
                                <li><a href="#">Careers</a></li>
                                <li>
                                    <a href="#">Campus</a>
                                    <ul>
                                        <li><a href="#">Technical Cell(ICT)</a></li>
                                        <li><a href="#">राजभाषा प्रकोष्ठ</a></li>
                                        <li><a href="#">Health Centre</a></li>
                                        <li><a href="#">Engineering Cell</a></li>
                                        <li><a href="#">Guest House</a></li>
                                        <li><a href="#">Transport</a></li>
                                        <li><a href="#">Sports</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-lg-2 d-none d-lg-block">
                        <div class="apply-btn-area">
                            <a href="#"> <img src="<?= base_url() ?>public/assets/image/g20-2023.png" style="float: right; margin-right: 15px; vertical-align: top; height: 40px;"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>



     </div>
 </header>
 
 <!------------------------------------------------------Mobile Header---------------------------------------------------------------------->
 
 
 <mobile_header>
     <div id="header3" class="header3-area">
         <div class="header-top-area">
             <div class="container">
                 <div class="">
                     <div class="row">
                         <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                             <div class="header-top-left">
                                 <ul>
                                     <li>
                                         <i class="fa fa-phone" aria-hidden="true"></i><a href="#">
                                             +91-____ ____ ____</a>
                                     </li>
                                     <li>
                                         <i class="fa fa-envelope" aria-hidden="true"></i><a href="#">______________</a>
                                     </li>
                                 </ul>
                             </div>
                         </div>
                         <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12">
                             <div class="header-top-right">
                                 <ul>


                                     <li class="dropdown">
                                         <a class="login-btn-area" href="#" id="login-button"><i class=""
                                                 aria-hidden="true"></i>
                                             Press Release </a>
                                         <div class="dropdown-content">
                                             <a href="#">2023</a>
                                             <a href="#">2024</a>

                                             <a href="#">2025</a>
                                             <a href="#">2026</a>
                                         </div>

                                     </li>

                                     <li class="dropdown">
                                         <a class="login-btn-area" href="#" id="login-button"><i class=""
                                                 aria-hidden="true"></i>
                                             NIRF</a>
                                         <div class="dropdown-content">
                                             <a href="#">NIRF</a>
                                             
                                         </div>

                                     </li>

                                     


                                     <li>
                                         <a class="login-btn-area"
                                             href="careers.php" id="login-button"><i class=""
                                                 aria-hidden="true"></i>
                                             Careers</a>

                                     </li>

                                     <li>
                                         <a class="login-btn-area" href="placement.php" id="login-button"><i class=""
                                                 aria-hidden="true"></i>
                                             Placement</a>

                                     </li>

                                    <li>
                                         <a class="login-btn-area" href="tenders.php" id="login-button"><i class=""
                                                 aria-hidden="true"></i>
                                             Tender</a>

                                     </li>

                                     <li class="dropdown">
                                         <a class="login-btn-area" href="#" id="login-button"><i class=""
                                                 aria-hidden="true"></i>
                                             Samarth Login</a>
                                         <div class="dropdown-content">
                                             <a href="#">Employees</a>
                                             <a href="#">Student</a>

                                         </div>

                                     </li>

                                     <li>
                                         <a class="login-btn-area" href="contact-us.php"
                                             id="login-button"><i class="" aria-hidden="true"></i>
                                             Contact</a>

                                     </li>


                                     <li><img src="https://ficusglobal.com/CUJ/img/newItem.gif" alt="a">
                                         <a class="login-btn-area" href="http://cuj.cuj.ac.in/" id="login-button"><i
                                                 class="" aria-hidden="true"></i>
                                             Go to Old Site</a>

                                     </li>

                                     <!--

                                     <li>
                                         <div class="apply-btn-area">
                                             <a href="#" class="apply-now-btn">Apply Now</a>
                                         </div>
                                     </li>--->

                                 </ul>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>

         
         <div class="mobile-menu-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mobile-menu">
                            <nav id="dropdown">
                                <ul>
                                    <li class="active">
                                        <a href="<?= base_url() ?>">Home</a>
                                    </li>

                                    <li>
                                        <a href="#">Governance</a>
                                        <ul class="mega-menu-area">
                                            <li>
                                                <a href="#">Visitor</a>
                                                <a href="#">Chancellor</a>
                                                <a href="#">Founding Vice Chancellor</a>
                                                <a href="#">Vice Chancellor</a>
                                            </li>
                                            <li>
                                                <a href="#">Executive Council</a>
                                                <a href="#">Academic Council</a>
                                                <a href="#">Finance Committee</a>
                                                <a href="#">Court</a>
                                            </li>
                                            <li>
                                                <a href="#">Statutory Officers</a>
                                                <a href="#">Registrar</a>
                                                <a href="#">Finance Officer</a>
                                                <a href="#">Controller of Examination</a>
                                            </li>
                                            <li>
                                                <a href="#">Librarian</a>
                                                <a href="#">Teaching Employees</a>
                                                <a href="#">Officers & Staffs</a>
                                                <a href="#">DSW</a>
                                                <a href="#">Proctorial Board</a>
                                                <a href="#">SC/ST Cell</a>
                                                <a href="#">ICC</a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li>
                                        <a href="#">Academics</a>
                                        <ul>
                                            <li><a href="#">Department</a></li>
                                            <li class="has-child-menu">
                                                <a href="#">School</a>
                                                <ul class="thired-level">
                                                    <li><a href="#">Management Sciences</a></li>
                                                    <li><a href="#">Mass Communication & Media Technologies</a></li>
                                                    <li><a href="#">Languages</a></li>
                                                    <li><a href="#">Natural Sciences</a></li>
                                                    <li><a href="#">Engineering & Technology</a></li>
                                                    <li><a href="#">The Study of Culture</a></li>
                                                    <li><a href="#">Natural Resource Management</a></li>
                                                    <li><a href="#">Social Science & Humanities</a></li>
                                                    <li><a href="#">Education</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#">Faculty Profile</a></li>
                                            <li><a href="#">Rajbhasha Prakoshth (Hindi Cell)</a></li>
                                            <li><a href="#">Institution's Innovation Council</a></li>
                                            <li><a href="#">Programs</a></li>
                                            <li><a href="#">Syllabus</a></li>
                                            <li><a href="#">Board of Studies</a></li>
                                            <li><a href="#">Academic Calendar 2023-24</a></li>
                                            <li><a href="#">Research & Development</a></li>
                                            <li><a href="#">Faculty C.V.</a></li>
                                            <li><a href="#">Achievement</a></li>
                                            <li><a href="#">LMS @ CUJ</a></li>
                                        </ul>
                                    </li>

                                    <li>
                                        <a href="#">Admission</a>
                                        <ul>
                                            <li class="has-child-menu"><a href="#">Admission-2024</a>
                                                <ul class="thired-level">
                                                    <li><a href="#">CUET UG-2024</a></li>
                                                    <li><a href="#">B.Tech. - M.Tech. Admission 2024-25</a></li>
                                                    <li><a href="#">CUET PG - 2024</a></li>
                                                    <li><a href="#">Ph.D. - 2024</a></li>
                                                </ul>
                                            </li>
                                            <li class="has-child-menu"><a href="#">Admission-2023</a>
                                                <ul class="thired-level">
                                                    <li><a href="#">CUET UG-2023</a></li>
                                                    <li><a href="#">CUET PG - 2023</a></li>
                                                    <li><a href="#">Ph.D. - 2023</a></li>
                                                </ul>
                                            </li>
                                            <li class="has-child-menu"><a href="#">Admission-2022</a>
                                                <ul class="thired-level">
                                                    <li><a href="#">CUET UG - 2022</a></li>
                                                    <li><a href="#">CUET PG - 2022</a></li>
                                                    <li><a href="#">Ph.D. - 2022</a></li>
                                                    <li><a href="#">MBA Through CAT - 2022</a></li>
                                                    <li><a href="#">M.Tech. Through GATE - 2022</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#">Admission Rules</a></li>
                                            <li><a href="#">Admission Cell</a></li>
                                        </ul>
                                    </li>

                                    <li>
                                        <a href="#">Student</a>
                                        <ul>
                                            <li><a href="#">Convocation</a></li>
                                            <li><a href="#">Students Corner</a></li>
                                            <li><a href="#">Hostel</a></li>
                                            <li><a href="#">Digi-Locker Account</a></li>
                                            <li><a href="#">Alumni</a></li>
                                            <li><a href="#">Student/Exam Notices</a></li>
                                            <li><a href="#">NSS</a></li>
                                            <li><a href="#">NCC</a></li>
                                            <li><a href="#">Student Services Support Cell</a></li>
                                            <li><a href="#">Fee Structure</a></li>
                                            <li><a href="#">The Energiea</a></li>
                                            <li><a href="#">Khelotsav 2019</a></li>
                                            <li><a href="#">Students Discipline and Conduct rules</a></li>
                                            <li class="has-child-menu">
                                                <a href="#">Ragging</a>
                                                <ul class="thired-level">
                                                    <li><a href="#">Students Discipline and Conduct rules</a></li>
                                                    <li><a href="#">Anti-Ragging Helpline</a></li>
                                                    <li><a href="#">Anti-Ragging Gazette</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#">Grievance Redressal</a></li>
                                            <li><a href="#">Academic Calendar 2022-23</a></li>
                                            <li><a href="#">Opportunity for Students</a></li>
                                            <li><a href="#">PhD Scholars</a></li>
                                            <li><a href="#">Scholarship</a></li>
                                        </ul>
                                    </li>

                                    <li>
                                        <a href="#">Exam</a>
                                    </li>

                                    <li>
                                        <a class="login-btn-area" href="#">IQAC</a>
                                    </li>

                                    <li>
                                        <a href="#">Gallery</a>
                                        <ul>
                                            <li><a href="#">2023-2024</a></li>
                                            <li><a href="#">2024-2025</a></li>
                                        </ul>
                                    </li>

                                    <li>
                                        <a href="#">Campus</a>
                                        <ul>
                                            <li><a href="#">Health Centre</a></li>
                                            <li><a href="#">Guest House</a></li>
                                            <li><a href="#">Transport</a></li>
                                            <li><a href="#">Sports</a></li>
                                        </ul>
                                    </li>

                                    <li>
                                        <a href="#">Library</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="col-lg-2 d-none d-lg-block">
                            <div class="apply-btn-area">
                                <a href="#"><img src="../img/Viksit Bharat 204790-1 (1).jpg" style="float: right;margin-right: 15px; vertical-align:top"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


     </div>
 </mobile_header>        <!-- Header Area End Here -->