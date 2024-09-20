<?php

    $link = mysqli_connect("localhost", "root", "root123456", "group_05") // 建立MySQL的資料庫連結
    or die("無法開啟MySQL資料庫連結!<br>");

    // 送出編碼的MySQL指令
    mysqli_query($link, 'SET CHARACTER SET utf8');
    mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

    //登入
    $loggg = 0;
    $level = 0;
    session_start();
    if(isset($_SESSION['Username']) && isset($_SESSION['Password']))
    {   
        $loggg = 1;
        $bbb = $_SESSION['Username'];
        if ($result = mysqli_query($link, "SELECT * FROM user where id = '$bbb'")) {
            while ($aaa = mysqli_fetch_assoc($result)) 
            {
                $level = $aaa["permission"]; 
                $_SESSION['level'] = $level;
            }
            $num = mysqli_num_rows($result); //查詢結果筆數
            mysqli_free_result($result); // 釋放佔用的記憶體
        }
    }

    //熱門搜尋
    if ($result = mysqli_query($link, "SELECT * FROM goods order by hot DESC")) {
        $count = 0;
        while ($count < 6) 
        {   $aaa = mysqli_fetch_assoc($result);
            $name[$count] =$aaa["goods_name"]; //名稱
            $adult_price[$count] =$aaa["price"]; //全票
            $pic[$count] = "<img src='images/$aaa[file_name]' />";//圖片
            $popular[$count] = $aaa["hot"];
            $id[$count] = $aaa["goods_id"];
            $count++;
        }
        $num = mysqli_num_rows($result); //查詢結果筆數
        mysqli_free_result($result); // 釋放佔用的記憶體
    }
    ///新購物車搜尋
    $schedule = "";
    $count = 0;


    if ($result = mysqli_query($link, "SELECT * FROM schedule where user_name = '$bbb' and buy = 0 order by `month`,`day`")) {
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


    if ($result = mysqli_query($link, "SELECT * FROM schedule where user_name = '$bbb' and buy = 1 order by `month`,`day`")) {
        while ($aaa = mysqli_fetch_assoc($result)) {
            if($aaa['month']!=0)
            {
                $goods_id = $aaa['goods_id'];
                $month = $aaa["month"];
                $day = $aaa["day"];
                $schedule3 .= "<tr><td>" . $aaa["month"]."/".$aaa["day"] . "</td><td>" . $aaa["name"] . "</td><td>" . $aaa["quantity"]."/".$aaa["quantity_kid"] . '</td><td align = "center"><form><button type="button" class="btn-sm btn-danger" onclick = "location.href=\'delete_buy.php?delete_id_goods='.$bbb.'&delete_goods='.$goods_id.'&delete_month='.$month.'&delete_day='.$day.' \'">退票</button></form></td></tr>';
                $count2 = $count2 + $aaa['total'];
            }                                                                                                  
        }
        mysqli_free_result($result); // 釋放佔用的記憶體
    }
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
    <!--AJAX-->
    <!--<script src="http://code.jquery.com/jquery-latest.min.js"></script>-->
    
    <!--外包表單驗證-->
    <script src = "one.js"></script>
    <!--<script src = "two.js"></script>-->
    <link rel="stylesheet" type="text/css" href="wrong.css">
        
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
                                    <li><a data-toggle="modal" data-target="#loggin"><i class="fa-solid fa-circle-user" <?php  if($loggg == 1){echo 'style="visibility:hidden"';}  ?> ></i></a></li>
                                    <!--檢查點-->
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
        <div class="header-fixed header-one">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="index.php">
                        <img src="images/logo_3.png" alt="logo">
                    </a>
                    <div class="collapse navbar-collapse my-lg-0" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item "><a class="nav-link" href="#hot">熱門</a></li>
                            <li class="nav-item "><a class="nav-link" href="#city">市區</a></li>
                            <li class="nav-item "><a class="nav-link" href="#country">近郊</a></li>
                        </ul>
                        <div class="log-btn">
                            <div id="search-btn">
                                <form>
                                    <input id="search" name="search" type="text" placeholder="Search here...">
                                    <a href="#" class="fa fa-search"></a>
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
                                <h2 class="hero-slider__title">無尾熊東京</h2>
                                <p class="hero-slider__text">東京  想怎麼玩  就怎麼玩</p>
                                <a class="hero-slider__btn active mr-2" data-toggle="modal" data-target="#loggin" <?php  if($loggg == 1){echo 'style="visibility:hidden"';}  ?>>登入</a>
                                <a class="hero-slider__btn" data-toggle="modal" data-target="#ssubmit" <?php  if($loggg == 1){echo 'style="visibility:hidden"';}  ?>>註冊</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="item">
            <img src="images/3.2.jpg" alt="hero-1">
            <div class="hero-slider__content-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7 col-md-12">
                            <div class="hero-slider__content">
                                <h2 class="hero-slider__title">景點應有盡有</h2>
                                <p class="hero-slider__text">食衣住行育樂皆包</p>
                                <a class="hero-slider__btn active mr-2" data-toggle="modal" data-target="#loggin" <?php  if($loggg == 1){echo 'style="visibility:hidden"';}  ?>>登入</a>
                                <a class="hero-slider__btn" data-toggle="modal" data-target="#ssubmit" <?php  if($loggg == 1){echo 'style="visibility:hidden"';}  ?>>註冊</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="item">
            <img src="images/3.3.jpg" alt="hero-1">
            <div class="hero-slider__content-wrapper">
                <div class="container">
                    <div class="row justify-content-lg-center">
                        <div class="col-lg-10 text-center">
                            <div class="hero-slider__content">
                                <h2 class="hero-slider__title">旅行  起飛</h2>
                                <p class="hero-slider__text">輕鬆體驗自己規劃的完美行程</p>
                                <a class="hero-slider__btn active mr-2" data-toggle="modal" data-target="#loggin" <?php  if($loggg == 1){echo 'style="visibility:hidden"';}  ?>>登入</a>
                                <a class="hero-slider__btn" data-toggle="modal" data-target="#ssubmit" <?php  if($loggg == 1){echo 'style="visibility:hidden"';}  ?>>註冊</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!--註冊浮動視窗-->
    <?php include("Register_floating.php"); ?>
    <!--登入浮動視窗-->
    <?php include("login_floating.php"); ?>
    <!--無料購物車(新行程表)浮動視窗-->
    <?php include("sche_true_not.php"); ?>
    <!--行程表(新購物車)   無料-->
    <?php include("schedule_not.php"); ?>
    <!--有料購物車(新行程表)浮動視窗-->
    <?php include("sche_true_yes.php"); ?>
    <!--有料行程表(新購物車)   有料-->
    <?php include("schedule_yes.php"); ?>
    <!--不是賣家浮動視窗-->
    <?php include("schedule_not.php"); ?>

    <!-- End-Main-Section -->
 <!-- searching area -->
 <div class="search_area search_area_three">
    <div class="container">

        <!--Search Form-->
        <form class="row search_area-inner" role="form" id="form4" name="formsearch" action="#">
            <div class="form-group icon_down">
                <select class="selectpicker search-fields form-control">
                    <option value="0"> 選擇主要遊玩地區</option>
                    <option value="1"> 淺草</option>
                    <option value="2"> 新宿</option>
                    <option value="3"> 原宿</option>
                    <option value="4"> 豐洲</option>
                    <option value="5"> 上野</option>
                    <option value="6"> 澀谷</option>
                    <option value="7"> 六本木</option>
                    <option value="8"> 迪士尼</option>
                    <option value="9"> 河口湖</option>
                    <option value="10"> 箱根</option>
                    <option value="11"> 輕井澤</option>
                    <option value="12"> 鎌倉</option>
                    <option value="13"> 日光</option>
                    <option value="14"> 橫濱</option>
                </select>
            </div>

            <div class="form-group">
                <input type="number" class="zt-control" placeholder="成人" min="1" max="100">
            </div>
            <div class="form-group">
                <input type="number" class="zt-control" placeholder="小孩" min="0" max="100">
            </div>
            <div class="form-group date input-datepicker">
                <input type="text" class="form-control " id="datepicker" name="DateFron"
                    data-date-format="yyyy-mm-dd" placeholder="啟程" value="">
                <span class="input-group-addon"><i class="far fa-calendar-alt"></i></span>
            </div>
            <div>
                <button type="submit" class="btn-tour">搜尋</button>
            </div>
        </form>
    </div>
</div>
<!-- End-searching-area-->
<!-- about-area -->

<!-- End-about-area -->
<!-- service-section -->

<!-- End-service-section -->
<!-- Start-Package-Section -->
<section class="ws-section-spacing bg-gray"><!--熱門-->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="center-title ">
                    <h2 class="title" name="hot" id="hot">熱門推薦</h2>
                    <h4 class="sub-title"></h4><!--這裡可以輸入文字-->
                </div>
            </div>
        </div>
        <div class="row masonry-item">
            <?php include("index_block.php"); ?>
            <!-- item-end -->
        </div>
    </div>
</section>
<!--市區-->
<section class="ws-section-spacing bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="center-title ">
                    <h2 class="title" name="city" id="city">東京市區熱門景點推薦</h2>
                    <h4 class="sub-title"></h4><!--這裡可以輸入文字-->
                </div>
            </div>
        </div>
        <div class="row masonry-item">
            <div class="col-lg-4 col-md-6 col-sm-12 masonry">
                <div class="package-one">
                    <div class="img-wapper">
                        <a href="object.php?id=1"><img src="images/popular_1.jpg" alt="package-img"></a>
                    </div>
                    <div class="package-content">
                        <h3>東京迪士尼樂園</h3>
                        <p>門票代訂 <span>$500</span></p>
                        <ul class="ct-action">
                            <li>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- item -->
            <div class="col-lg-4 col-md-6 col-sm-12 masonry">
                <div class="package-one">
                    <div class="img-wapper">
                        <a href="object.php?id=2"><img src="images/popular_2.jpg"  alt="package-img"></a>
                    </div>
                    <div class="package-content">
                        <h3>晴空塔</h3>
                        <p>門票代訂 <span>$600</span></p>
                        <ul class="ct-action">
                            <li>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- item -->
            <div class="col-lg-4 col-md-6 col-sm-12 masonry">
                <div class="package-one">
                    <div class="img-wapper">
                        <a href="object.php?id=3"><img src="images/popular_3.jpg" alt="package-img"></a>
                    </div>
                    <div class="package-content">
                        <h3>淺草</h3>
                        <p>免費行程(含旅遊指南) <span>$0</span></p>
                        <ul class="ct-action">
                            <li>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <i class="fa-regular fa-star"></i>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- item -->
            <div class="col-lg-4 col-md-6 col-sm-12 masonry">
                <div class="package-one">
                    <div class="img-wapper">
                        <a href="object.php?id=4"><img src="images/popular_4.jpg" alt="package-img"></a>
                    </div>
                    <div class="package-content">
                        <h3>東京鐵塔</h3>
                        <p>門票代訂 <span>$300</span></p>
                        <ul class="ct-action">
                            <li>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa-regular fa-star"></i>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- item -->
            
            <!-- item -->
            <div class="col-lg-4 col-md-6 col-sm-12 masonry">
                <div class="package-one">
                    <div class="img-wapper">
                        <a href="object.php?id=5"><img src="images/popular_8.jpg" alt="package-img"></a>
                    </div>
                    <div class="package-content">
                        <h3>吉卜力美術館</h3>
                        <p>門票代訂 <span>$300</span></p>
                        <ul class="ct-action">
                            <li>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 masonry">
                <div class="package-one">
                    <div class="img-wapper">
                        <a href="object.php?id=6"><img src="images/popular_9.jpg" alt="package-img"></a>
                    </div>
                    <div class="package-content">
                        <h3>澀谷</h3>
                        <p>免費行程(含旅遊指南) <span>$0</span></p>
                        <ul class="ct-action">
                            <li>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa-regular fa-star"></i>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- item-end -->
        </div>
    </div>
</section>
<section class="ws-section-spacing bg-gray"><!--近郊-->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="center-title ">
                    <h2 class="title" name="country" id="country">東京近郊一日遊行程推薦</h2>
                    <h4 class="sub-title"></h4><!--這裡可以輸入文字-->
                </div>
            </div>
        </div>
        <div class="row masonry-item">
            <div class="col-lg-4 col-md-6 col-sm-12 masonry">
                <div class="package-one">
                    <div class="img-wapper">
                        <a href="object.php?id=7"><img src="images/oneday_1.jpg" alt="package-img"></a>
                    </div>
                    <div class="package-content">
                        <h3>河口湖一日遊</h3>
                        <p>一日遊套裝 <span>$500</span></p>
                        <ul class="ct-action">
                            <li>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- item -->
            <div class="col-lg-4 col-md-6 col-sm-12 masonry">
                <div class="package-one">
                    <div class="img-wapper">
                        <a href="object.php?id=8"><img src="images/oneday_2.jpg" alt="package-img"></a>
                    </div>
                    <div class="package-content">
                        <h3>箱根一日遊</h3>
                        <p>一日遊套裝 <span>$600</span></p>
                        <ul class="ct-action">
                            <li>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- item -->
            <div class="col-lg-4 col-md-6 col-sm-12 masonry">
                <div class="package-one">
                    <div class="img-wapper">
                        <a href="object.php?id=9"><img src="images/oneday_3.jpg" alt="package-img"></a>
                    </div>
                    <div class="package-content">
                        <h3>橫濱一日遊</h3>
                        <p>一日遊套裝 <span>$0</span></p>
                        <ul class="ct-action">
                            <li>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <i class="fa-regular fa-star"></i>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- item -->
            <!-- item -->
            <div class="col-lg-4 col-md-6 col-sm-12 masonry">
                <div class="package-one">
                    <div class="img-wapper">
                        <a href="object.php?id=10"><img src="images/oneday_5.jpg" alt="package-img"></a>
                    </div>
                    <div class="package-content">
                        <h3>輕井澤一日遊</h3>
                        <p>一日遊套裝 <span>$0</span></p>
                        <ul class="ct-action">
                            <li>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 masonry">
                <div class="package-one">
                    <div class="img-wapper">
                        <a href="object.php?id=11"><img src="images/oneday_6.jpg" alt="package-img"></a>
                    </div>
                    <div class="package-content">
                        <h3>日光東照宮一日遊</h3>
                        <p>一日遊套裝 <span>$0</span></p>
                        <ul class="ct-action">
                            <li>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- item-end -->
        </div>
    </div>
</section>

<!-- End-Package-Section -->
<!-- Counter-section -->
<section class="ws-section-spacing bg-img-counter"><!--計數器-->
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="counter-box">
                    <span class="count-icon"><i class="fas fa-user"></i></span>
                    <h2 class="counter">22400</h2>
                    <h3 class="count-title">會員</h3>
                </div>
            </div>
            <!-- item -->
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="counter-box">
                    <span class="count-icon"><i class="fas fa-umbrella-beach"></i></span>
                    <h2 class="counter">540</h2>
                    <h3 class="count-title">景點</h3>
                </div>
            </div>
            <!-- item -->
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="counter-box">
                    <span class="count-icon"><i class="fas fa-luggage-cart"></i></span>
                    <h2 class="counter">3340</h2>
                    <h3 class="count-title">行李寄放處</h3>
                </div>
            </div>
            <!-- item -->
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="counter-box">
                    <span class="count-icon"><i class="fas fa-life-ring"></i></span>
                    <h2 class="counter">240</h2>
                    <h3 class="count-title">據點</h3>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End-Counter-section -->
<!-- offer-section -->

<!-- End-offer-section -->
<!-- Desination-slide -->

<!-- End-Desination-slide -->
<!-- Testimonial-section -->
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

