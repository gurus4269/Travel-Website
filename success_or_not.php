<?php 

    $link = mysqli_connect("localhost", "root", "root123456", "group_05") // 建立MySQL的資料庫連結
    or die("無法開啟MySQL資料庫連結!<br>");

    // 送出編碼的MySQL指令
    mysqli_query($link, 'SET CHARACTER SET utf8');
    mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

    // // 資料庫查詢(送出查詢的SQL指令)
    $login = 0;
    if ($result = mysqli_query($link, "SELECT * FROM user")) {
        while ($check = mysqli_fetch_assoc($result)) 
        {
            $user_id = $check["id"]; 
            $user_password = $check["password"]; 
            if($user_id==$_POST['account2'] && $user_password==$_POST['pwd3'])
            {
                $login = 1;
                break;
            }
        }
        mysqli_free_result($result); // 釋放佔用的記憶體
    }

    //產生Session變數
    session_start();
    $_SESSION['Username']=$user_id;
    $_SESSION['Password']=$user_password;
    //echo "username=" . $_SESSION['Username'] ;


    mysqli_close($link); // 關閉資料庫連結


?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="images/fv-icon.png" type="image/gif">
    <title>Home</title>
    <!--bootstrap.min.css-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!--animate.css-->
    <link rel="stylesheet" href="css/animate.min.css">
    <!--fontawesome 5-->
    <link rel="stylesheet" href="css/all.min.css">
    <!--slicknav.css-->
    <link rel="stylesheet" href="css/slicknav.min.css">
    <!--slickslider.css-->
    <link rel="stylesheet" href="css/slick-theme.css">
    <link rel="stylesheet" href="css/slick.css">
    <!-- lity.css -->
    <link rel="stylesheet" href="css/lity.min.css">
    <!-- Custom.css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <script src="https://kit.fontawesome.com/d7c3957bee.js" crossorigin="anonymous"></script><!--自己的新code-->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="http://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="http://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!--表單驗證-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
    <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
    
</head>

<body>
    <!-- Preloader -->
    <div id="preloader"></div>
    <!-- Start-Header-Section -->
    <header class="header-type-three">
        <!-- Topbar-start-area -->
        <div class="header_top_area">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="contact_wrapper_top">
                            <ul class="header_top_contact">
                                <!--<li><a href="#"></a><i class="fa-solid fa-ticket-airline" aria-hidden="true"></i></a></li>-->
                                <li><i class="fa fa-envelope" aria-hidden="true"></i>koalatrip@gmail.com</li>
                            </ul>
                            <div class="topbar-icon">
                                <ul>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End-Topbar-area -->
        <!-- Menu-start-area -->
        <div class="header-fixed header-one">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="index.php">
                        <img src="images/logo_3.png" alt="logo">
                    </a>
                    <div class="collapse navbar-collapse my-lg-0" id="navbarNav">
                        <ul class="navbar-nav">
                            
                        </ul>
                        <div class="log-btn">
                            <div id="search-btn">
                                <form>
                                    <input id="search" name="search" type="text" placeholder="Search here...">
                                    <!--<a href="#" class="fa fa-search"></a>-->
                                </form>
                            </div>
                        </div>
                    </div>
                </nav>
                <div class="mobile-menu" data-logo="images/logo_3_sm.png"></div>
            </div>
        </div>
        <!-- End-Menu-area-->
    </header>
    <!-- Start-Main-Section -->
    <main class="hero-slide-three ">
        <div class="item">
            <img src="images/3.1.jpg" alt="hero-1">
            <div class="hero-slider__content-wrapper">
                <div class="container">
                    <div class="row justify-content-lg-center">
                        <div class="col-lg-10 text-center">
                            <div class="hero-slider__content">
                                    
                                    <h2 class="hero-slider__title">
                                        
                                        <?php 
                                            if($login==1)
                                                {echo "登入成功";}
                                            else
                                                {echo "登入失敗";}
                                        ?></h2>
                                        <p class="hero-slider__text"><?php 
                                            if($login==1)
                                                {echo "按下方進入跳轉";}
                                            else
                                                {echo "回上一頁重新輸入";}
                                        ?></p>
                                    <?php if ($login==1){echo '<a href="index.php" type="submit" class="hero-slider__btn">前往無尾熊旅遊</a>';}?>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </main>

<!-- End-Testimonial-section -->
<!-- Blog-section -->

<!-- End-Blog-section -->
<!-- Partner-section -->

<!-- End-Partner-section -->
<!-- Footer-section -->

<!-- copyright-area -->
<div class="footer-bottom text-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="left-text">
                    無尾熊東京旅行網站
                </div>
            </div>

        </div>
    </div>
</div>
<!-- End-footer-section -->
 
    <!-- Back to top button -->
    <a id="btn-to-top" class="show"></a>
    <!-- Jquery.min.js-->
    <script src="js/jquery.1.12.4.js"></script>
    <!--bootstrap.min.js-->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <!--slicknav.min.js-->
    <script src="js/jquery.slicknav.min.js"></script>
    <!--slickslider.min.js-->
    <script src="js/slick.min.js"></script>
    <!-- counterup.min.js -->
    <script src="js/waypoints.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <!-- magnific-popup.js -->
    <script src="js/lity.min.js"></script>
    <!-- isotope.pkgd.min.js -->
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/imagesloaded.js"></script>
    <!-- main.js -->
    <script src="js/main.js"></script>

</body>

</html>

