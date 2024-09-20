<?php
    session_start();
    $_SESSION['check'] = 1;
    $id=$_GET["update_id"];
   
    
    $link = mysqli_connect("localhost", "root", "root123456", "group_05") // 建立MySQL的資料庫連結
	or die("無法開啟MySQL資料庫連結!<br>");
						
	// 送出編碼的MySQL指令
	mysqli_query($link, 'SET CHARACTER SET utf8');
	mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

    $input = "";
    if ($result = mysqli_query($link, "SELECT * FROM goods where goods_id = '$id'")) {
        while ($aaa = mysqli_fetch_assoc($result)) {
            $name =$aaa["goods_name"];
            $inputer = $aaa["inputer"];
            $adult_price =$aaa["price"]; 
            $kid_price =$aaa["price_small"]; 
            $input .= "<tr><td>原資料</td><td>" . $name . "</td><td>" . $id . "</td><td>" . $inputer . "</td><td>" . $adult_price . "</td><td>" . $kid_price . '</td></tr>';
        }
        mysqli_free_result($result); // 釋放佔用的記憶體
    }
	



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

    <script src="three.js"></script>
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
                                    <li><a data-toggle="modal" data-target="#sschedule2"><i class="fa-solid fa-cart-shopping"></i></a></li>
                                    <li><a data-toggle="modal" data-target="#ssale"><i class="fa-solid fa-plus"></i></a></li>
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
                            <li class="nav-item "><a class="nav-link" href="#goods">商品</a></li>
                            <li class="nav-item "><a class="nav-link" href="#user">用戶</a></li>
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
    <!--晴空塔頁面 1-->
    
    <!--這裡加入表格-->
    <!--商品-->
    <section class="ws-section-spacing bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="center-title ">
                    <h2 class="title" name="goods" id="goods">修改商品</h2>
                    <h4 class="sub-title"></h4><!--這裡可以輸入文字-->
                </div>
            </div>
        </div>
        <form class="form-horizontal" role="form" action="input.php" method="POST" id = "update_form">
                <table width="1120" border="1" >
                <thead>
                    <tr>
                        <th></th>
                        <th>名稱</th>
                        <th>編號</th>
                        <th>上傳者</th>
                        <th>全票</th>
                        <th>孩童票</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php
                        echo $input;
                    ?>
                    <tr>
                        <td>新商品</td>
                        <div class="form-group">
                            <td><input type="text" name="na" value="<?php echo $name ?>"></td>
                        </div>
                        <div class="form-group">
                        </div>
                        <div class="form-group">
                            <td><input type="text" readonly = "readonly" name="id" value="<?php echo $id ?>"></td>
                        </div>
                        <div class="form-group">
                            <td><?php echo $inputer ?></td>
                        </div>
                        <div class="form-group">
                            <td><input type="text" name="ad" value="<?php echo $adult_price ?>"></td>
                        </div>
                        <div class="form-group">
                        <td><input type="text" name="ki" value="<?php echo $kid_price ?>"></td>
                        </div>
                    </tr>
                    <tr>
                        <td colspan="7" align="center">
                            <button type="submit" class="btn-sm btn-success"  >確定修改</button>
                        </td>
                    </tr>
                    
                </tbody>
            </table>
        </form>
            <!-- item-end -->
        </div>
    </div>
</section>

    <!--用戶-->
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