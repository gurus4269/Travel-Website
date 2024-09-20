<?php
    //session
    session_start();
    $_SESSION['id_now'] = $_GET['id'];//修
    $user = $_SESSION['Username'] ;
    $password = $_SESSION['Password'] ;
    $id_now = $_SESSION['id_now'];
    $level = $_SESSION['level'];

    //======================================

    //門票數
    if (isset($_COOKIE["adult_tic"]))
        $adults = $_COOKIE["adult_tic"] ;
    else
        $adults=1;
    setcookie("adult_tic", $adults , time()+3600);

    if (isset($_COOKIE["kid_tic"]))
        $kids = $_COOKIE["kid_tic"] ;
    else
        $kids=1;
    setcookie("kid_tic", $kids , time()+3600);
    //===================================
    //資料庫連結
    $link = mysqli_connect("localhost", "root", "root123456", "group_05") // 建立MySQL的資料庫連結
    or die("無法開啟MySQL資料庫連結!<br>");

    // 送出編碼的MySQL指令
    mysqli_query($link, 'SET CHARACTER SET utf8');
    mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

    if ( !$link ) {
        echo "連結錯誤代碼: ".mysqli_connect_errno()."<br>";//顯示錯誤代碼
        echo "連結錯誤訊息: ".mysqli_connect_error()."<br>";//顯示錯誤訊息
        exit();
    }
    //===========================================
    //主要
    if ($result = mysqli_query($link, "SELECT * FROM goods where goods_id = ' $id_now'")) {
        while ($aaa = mysqli_fetch_assoc($result)) {
            $name =$aaa["goods_name"]; //名稱
            $adult_price =$aaa["price"]; //全票
            $kid_price =$aaa["price_small"]; //半票
            $information =$aaa["information"]; //資訊
            $pic = "<img src='images/$aaa[file_name]' />";//圖片
            $belong = $aaa["belong"]; //從屬
            $array_where=array(1=>"淺草","新宿","原宿","豐洲","上野","澀谷","六本木","迪士尼","河口湖","箱根","輕井澤","鎌倉","日光","橫濱");
            $where =$aaa["goods_where"]; //地區(編號
            $where_word = $array_where[$where] ;//地區(文字
        }
        mysqli_free_result($result); // 釋放佔用的記憶體
    }
    //==================================================
    //從屬
    $i = 0;
    if ($result = mysqli_query($link, "SELECT * FROM goods where belong = ' $id_now'")) {
        while ($ccc = mysqli_fetch_assoc($result)) {
            
            $be_name[$i] =$ccc["goods_name"]; //名稱
            $be_information[$i] =$ccc["information"]; //資訊
            $be_pic[$i] = "<img src='images/$ccc[file_name]' />";//圖片
            $i++;
        }
        mysqli_free_result($result); // 釋放佔用的記憶體
    }
    //===========================================

    //新增到行程表(資料庫)
    if(isset($_POST['month'])){$month = $_POST['month'];}
    if(isset($_POST['day'])){$day = $_POST['day'];}
    if(isset($_POST['adult'])){$adult = $_POST['adult'];}
    else{$adult =1;}
    if(isset($_POST['kid'])){$kid = $_POST['kid'];}
    else{$kid =1;}

    if(isset($_COOKIE["adult_tic"]))
    {
        $total = (($kid_price*$kid)+($adult_price*$adult));
        $sql = "INSERT INTO `schedule` (`user_name`,`goods_id`,`name`,`month`,`day`,`price`,`quantity`,`price_kid`,`quantity_kid`,`total`) VALUE ('$user','$id_now','$name','$month','$day','$adult_price','$adult','$kid_price','$kid','$total')";
        $test = "SELECT * FROM `schedule` WHERE `user_name` = '$user' and `goods_id` = '$id_now' and `month` = '$month' and `day` = '$day'";
        
        $result = mysqli_query($link, $test);
        if (!($num = mysqli_num_rows($result)))
        {
            $result = mysqli_query($link, $sql);
        }
    }
    //=====================================

    //讀取購物車
    $schedule = "";
    $count = 0;
    if ($result = mysqli_query($link, "SELECT * FROM schedule where user_name = '$user' and buy = 0 order by `month`,`day`")) {
        while ($aaa = mysqli_fetch_assoc($result)) {
            if($aaa['month']!=0)
            {
                $schedule .= "<tr><td>" . $aaa["month"]."/".$aaa["day"] . "</td><td>" . $aaa["name"] . "</td><td>" .  $aaa["price"]."/".$aaa["price_kid"] . "</td><td>" . $aaa["quantity"]."/".$aaa["quantity_kid"] . "</td><td>" . $aaa["total"] ."</td></tr>";
                $count = $count + $aaa['total'];
            }
        }
        mysqli_free_result($result); // 釋放佔用的記憶體
    }
    //新行程表搜尋
    $schedule3 = "";
    $count2 = 0;


    if ($result = mysqli_query($link, "SELECT * FROM schedule where user_name = '$user' and buy = 1 order by `month`,`day`")) {
        while ($aaa = mysqli_fetch_assoc($result)) {
            if($aaa['month']!=0)
            {
                $goods_id = $aaa['goods_id'];
                $month = $aaa["month"];
                $day = $aaa["day"];
                $schedule3 .= "<tr><td>" . $aaa["month"]."/".$aaa["day"] . "</td><td>" . $aaa["name"] . "</td><td>" . $aaa["quantity"]."/".$aaa["quantity_kid"] . '</td><td align = "center"><form><button type="button" class="btn-sm btn-danger" onclick = "location.href=\'delete_buy.php?delete_id_goods='.$user.'&delete_goods='.$goods_id.'&delete_month='.$month.'&delete_day='.$day.' \'">退票</button></form></td></tr>';
                $count2 = $count2 + $aaa['total'];
            }                                                                                                  
        }
        mysqli_free_result($result); // 釋放佔用的記憶體
    }
    mysqli_close($link); // 關閉資料庫連結
    //========================================
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="images/fv-icon.png" type="image/gif">
    <title>Jetrip</title>
    <!--bootstrap.min.css-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!--animate.css-->
    <link rel="stylesheet" href="css/animate.min.css">
    <!--fontawesome 5-->
    <link rel="stylesheet" href="css/all.min.css">
    <!--slicknav.css-->
    <link rel="stylesheet" href="css/slicknav.min.css">
    <!--lity.css-->
    <link rel="stylesheet" href="css/lity.min.css">
    <!--slickslider.css-->
    <link rel="stylesheet" href="css/slick-theme.css">
    <link rel="stylesheet" href="css/slick.css">
    <!-- Custom.css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <script src="https://kit.fontawesome.com/d7c3957bee.js" crossorigin="anonymous"></script><!--自己的新code-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
    <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
    
    <script src = "one.js"></script>
    <link rel="stylesheet" type="text/css" href="wrong.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="http://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="http://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <!-- Preloader -->
    <div id="preloader"></div>
    <!-- Start-Header-Section -->
    <header>
        <!-- Topbar-start-area -->
        <div class="header_top_area type-two">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="contact_wrapper_top">
                            <ul class="header_top_contact">
                                <li><i class="fa fa-envelope" aria-hidden="true"></i>koalatrip@gmail.com</li>
                            </ul>
                            <div class="topbar-icon">
                                <ul>
                                    <li><a data-toggle="modal" data-target="#loggin"><i class="fa-solid fa-circle-user"></i></a></li>
                                    <?php 
                                        if($level < 1)
                                        {
                                            echo '<li><a data-toggle="modal" data-target="#ssale"><i class="fa-solid fa-plus"></i></a></li>';
                                            echo '<li><a data-toggle="modal" data-target="#sschedule"><i class="fa-solid fa-cart-shopping"></i></a></li>
                                                  <li><a data-toggle="modal" data-target="#ssche_true_not"><i class="fa-solid fa-calendar-check"></i></a></li>';
                                        }
                                        else
                                        {
                                            echo '<li><a href = "input.php"><i class="fa-solid fa-plus"></i></a></li>
                                            <li><a data-toggle="modal" data-target="#sschedule2"><i class="fa-solid fa-cart-shopping"></i></a></li>
                                            <li><a data-toggle="modal" data-target="#ssche_true_yes"><i class="fa-solid fa-calendar-check"></i></a></li>';
                                        }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End-Topbar-area -->
        <!-- Menu-start-area -->
        <div class="header-fixed header-two">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="index.php">
                        <img src="images/logo_2.png" alt="logo">
                    </a>
                    <div class="collapse navbar-collapse my-lg-0" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item "><a class="nav-link" href="index.php">首頁</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="modal" data-target="#sschedule2">行程表</a></li>
                        </ul>
                    </div>
                </nav>
                <div class="mobile-menu" data-logo="images/logo_3_sm.png"></div>
            </div>
        </div>
        <!-- End-Menu-area-->
    </header>
    <!-- Banner-area -->
   <!--- <section class="same-section-spacing bg-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="banner-box">
                        <h2>About Us</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">About Us</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>-->
    <!-- End-banner-area -->
    <!-- about-area -->
    
    <!--註冊浮動視窗-->
    <?php include("Register_floating.php"); ?>
    <!--登入浮動視窗-->
    <?php include("login_floating.php"); ?>
    <!--不是賣家浮動視窗-->
    <?php include("not_saler.php"); ?>
    <!--商品加入頁面-->
    <?php include("add_good.php"); ?>
    <!--行程表(新購物車)   無料-->
    <?php include("schedule_not.php"); ?>
    <!--有料購物車(新行程表)浮動視窗-->
    <?php include("sche_true_yes.php"); ?>
    <!--有料行程表(新購物車)   有料-->
    <?php include("schedule_yes.php"); ?>
    <!--不是賣家浮動視窗-->
    <?php include("schedule_not.php"); ?>
    
    </div>
    
    <section class="ws-section-spacing about-three"><!--晴空塔頁面 1-->
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="img-wapper">
                        <?php echo $pic;?>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-content">
                        <h2><?php echo $name?></h2>
                        <p><?php echo $information?></p>
                        <p> </p>    
                        <p>地區 : <?php echo $where_word?></p>
                        <button type="button" class="read-btn" data-toggle="modal" data-target="#ggood">加入購物車</button>
                    </div>
                </div>

            </div> 
            <div align="center">-----詳細資訊-----</div>
        </div>
    </section>
    <!-- End-about-area -->
    <!-- about-area -->
    <section class="ws-section-spacing bg-gray">
       <?php 
       /*for($j = 0;$j>$i;$j++)
       {*/
        include("belong.php");
       //}

       
       ?> 
    </section>
    <!-- End-about-area -->
    <!-- offer-section -->
    <!-- End-offer-section -->
    <!-- service-section -->
    <!-- End-service-section -->
    <!-- Partner-section附近景點 -->
    <section class="same-section-spacing bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="center-title ">
                        <h2 class="title">附近景點推薦</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="client-slide">
                        <div class="item">
                            <div class="img-wapper">
                                <img src="images/client1.png" alt="">
                            </div>
                        </div>
                        <!-- item -->
                        <div class="item">
                            <div class="img-wapper">
                                <img src="images/client2.png" alt="">
                            </div>
                        </div>
                        <!-- item -->
                        <div class="item">
                            <div class="img-wapper">
                                <img src="images/client3.png" alt="">
                            </div>
                        </div>
                        <!-- item -->
                        <div class="item">
                            <div class="img-wapper">
                                <img src="images/client4.png" alt="">
                            </div>
                        </div>
                        <div class="item">
                            <div class="img-wapper">
                                <img src="images/client1.png" alt="">
                            </div>
                        </div>
                        <!-- item -->
                        <div class="item">
                            <div class="img-wapper">
                                <img src="images/client2.png" alt="">
                            </div>
                        </div>
                        <!-- item -->
                        <div class="item">
                            <div class="img-wapper">
                                <img src="images/client3.png" alt="">
                            </div>
                        </div>
                        <!-- item -->
                        <div class="item">
                            <div class="img-wapper">
                                <img src="images/client4.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--熱門景點-->
    <section class="same-section-spacing bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="center-title ">
                        <h2 class="title">熱門景點推薦</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="client-slide">
                        <div class="item">
                            <div class="img-wapper">
                                <img src="images/client1.png" alt="">
                            </div>
                        </div>
                        <!-- item -->
                        <div class="item">
                            <div class="img-wapper">
                                <img src="images/client2.png" alt="">
                            </div>
                        </div>
                        <!-- item -->
                        <div class="item">
                            <div class="img-wapper">
                                <img src="images/client3.png" alt="">
                            </div>
                        </div>
                        <!-- item -->
                        <div class="item">
                            <div class="img-wapper">
                                <img src="images/client4.png" alt="">
                            </div>
                        </div>
                        <div class="item">
                            <div class="img-wapper">
                                <img src="images/client1.png" alt="">
                            </div>
                        </div>
                        <!-- item -->
                        <div class="item">
                            <div class="img-wapper">
                                <img src="images/client2.png" alt="">
                            </div>
                        </div>
                        <!-- item -->
                        <div class="item">
                            <div class="img-wapper">
                                <img src="images/client3.png" alt="">
                            </div>
                        </div>
                        <!-- item -->
                        <div class="item">
                            <div class="img-wapper">
                                <img src="images/client4.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End-Partner-section -->
    <!--評論區-->
    <section class="same-section-spacing  bg-gray Testimonial-one"><!--評論區-->
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="center-title ">
                        <h2 class="title">看看你們都說了什麼屁話</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="testi-slide-one">
                        <div class="item">
                            <img src="images/user_1.png" alt="testi-one">
                            <div class="testi-content">
                                <p>@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@</p>
                                <span class="rating"> <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i></span>
                                <h4>瘋狗一隻</h4>
                            <!--    <p>Thailand Trip </p>-->
                            </div>
                        </div>
                        <div class="item">
                            <img src="images/user_2.png" alt="testi-one">
                            <div class="testi-content">
                                <p>@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@</p>
                                <span class="rating"> <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i></span>
                                <h4>波吉王子</h4>
                            <!--    <p>Thailand Trip </p>-->
                            </div>
                        </div>
                        <div class="item">
                            <img src="images/user_3.png" alt="testi-one">
                            <div class="testi-content">
                                <p>@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@</p>
                                <span class="rating"> <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i></span>
                                <h4>工委拉!!國恩</h4>
                            <!--    <p>Thailand Trip </p>-->
                            </div>
                        </div>
                        <div class="item">
                            <img src="images/user_4.png" alt="testi-one">
                            <div class="testi-content">
                                <p>@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@</p>
                                <span class="rating"> <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i></span>
                                <h4>再給我一次機會</h4>
                            <!--    <p>Thailand Trip </p>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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