<?php
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
    // <th>名稱</th>
    // <th>編號</th>
    // <th>上傳者</th>
    // <th>全票</th>
    // <th>孩童票</th>
    // <th>刪除</th>
    // <th>修改</th>

    session_start();
    $user = $_SESSION['Username'] ;
    $password = $_SESSION['Password'] ;
    $level = $_SESSION['level'] ;
    if(isset($_SESSION['check']))
    {
        $check = $_SESSION['check'];
    }
    else
        $check = 0;
    

    if($check == 2)
    {
        $aft_us_name = $_POST['us_na'];
        $aft_us_id = $_POST['us_id'];
        $aft_pwd = $_POST['us_pwd'];
        $aft_email = $_POST['us_email'];
        $aft_per = $_POST['us_permission'];

        $sql = "UPDATE `user` SET `name` = '$aft_us_name', `password` = '$aft_pwd', `email` = '$aft_email' , `permission` = '$aft_per' where `id` = '$aft_us_id';";
        $result = mysqli_query($link, $sql)	;
        $_SESSION['check'] = 0;
    }

    else if($check == 1)
    {
        $aft_name = $_POST['na'];
        $aft_adprice = $_POST['ad'];
        $aft_kiprice = $_POST['ki'];
        $aft_id = $_POST['id'];

        $sql = "UPDATE `goods` SET `goods_name` = '$aft_name', `price` = '$aft_adprice', `price_small` = '$aft_kiprice'  where `goods_id` = '$aft_id';";
        $result = mysqli_query($link, $sql)	;
        $_SESSION['check'] = 0;
    }

    if($level >= 3)
    {   
        //匯入商品
        $input = "";
        if ($result = mysqli_query($link, "SELECT * FROM goods ")) {
            while ($aaa = mysqli_fetch_assoc($result)) {
                $name =$aaa["goods_name"];
                $goodid = $aaa["goods_id"];
                $inputer = $aaa["inputer"];
                $adult_price =$aaa["price"]; 
                $kid_price =$aaa["price_small"]; 
                $input .= "<tr><td>" . $name . "</td><td>" . $goodid . "</td><td>" . $inputer . "</td><td>" . $adult_price . "</td><td>" . $kid_price . '</td><td align = "center"><button type="button" class="btn-sm btn-success" onclick = "location.href=\'update.php?update_id='.$goodid.'\'">修改</button></td><td align = "center"><button type="button" class="btn-sm btn-danger" onclick = "location.href=\'delete.php?delete_no='.$goodid.'\'" >刪除</button></td></tr>';
            }
            mysqli_free_result($result); // 釋放佔用的記憶體
        }
        //匯入會員資料
        $input2 = "";                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
        if ($result = mysqli_query($link, "SELECT * FROM user ")) {
            while ($aaa = mysqli_fetch_assoc($result)) {
                $user_name =$aaa["name"];
                $user_id = $aaa["id"];
                $user_pass = $aaa["password"];
                $mail =$aaa["email"]; 
                $level =$aaa["permission"]; 
                $input2 .= "<tr><td>" . $user_name . "</td><td>" . $user_id . "</td><td>" . $user_pass . "</td><td>" . $mail . "</td><td>" . $level . '</td><td align = "center"><form><button type="button" class="btn-sm btn-danger" onclick = "location.href=\'delete_mem.php?delete_id='.$user_id.'\'">刪除</button></form></td></tr>';
            }
            mysqli_free_result($result); // 釋放佔用的記憶體
        }

        //新增
        $a = 0;
        if(isset($_POST['new_good_name']))
        {
            $new_good_name = $_POST['new_good_name'];
            $a = 1;
        }
        if(isset($_POST['picture'])){$picture = $_POST['picture'];}
        if(isset($_POST['where'])){$where = $_POST['where'];}
        if(isset($_POST['introduction'])){$introduction = $_POST['introduction'];}
        if(isset($_POST['adult'])){$adult = $_POST['adult'];}
        if(isset($_POST['half'])){$half = $_POST['half'];}

        if($a == 1)
        {
            $goodid ++;
            $sql = "INSERT INTO `goods` (`goods_name`,`goods_id`,`belong`,`inputer`,`price`,`price_small`,`goods_where`,`information`,`file_name`) VALUE ('$new_good_name','$goodid','0','$user','$adult','$half','$where','$introduction','$picture')";
            $test = "SELECT * FROM `goods` WHERE `goods_name` = '$new_good_name' ";
            $result = mysqli_query($link, $test);
            if (!($num = mysqli_num_rows($result)))
            {
                $result = mysqli_query($link, $sql);
            }
            else
            $goodid --;
        }

        //刪除商品
        
       

        // 如果有異動到資料庫數量(更新資料庫)
    }
    else if($level == 2)//個人
    {
        $input = "";
        if ($result = mysqli_query($link, "SELECT * FROM goods where inputer = '$user'")) {
            while ($aaa = mysqli_fetch_assoc($result)) {
                $name =$aaa["goods_name"];
                $goodid = $aaa["goods_id"];
                $inputer = $aaa["inputer"];
                $adult_price =$aaa["price"]; 
                $kid_price =$aaa["price_small"]; 
                $input .= "<tr><td>" . $name . "</td><td>" . $goodid . "</td><td>" . $inputer . "</td><td>" . $adult_price . "</td><td>" . $kid_price . '</td><td align = "center"><button type="button" class="btn-sm btn-success" onclick = "location.href=\'update.php?update_id='.$goodid.'\'">修改</button></td><td align = "center"><button type="button" class="btn-sm btn-danger" onclick = "location.href=\'delete.php?delete_no='.$goodid.'\'" >刪除</button></td></tr>';
            }
            mysqli_free_result($result); // 釋放佔用的記憶體
        }
        if ($result = mysqli_query($link, "SELECT * FROM goods ")) {
            while ($aaa = mysqli_fetch_assoc($result)) {
                $goodid = $aaa["goods_id"];
            }
            mysqli_free_result($result); // 釋放佔用的記憶體
        }
        $input2 = "";
        if ($result = mysqli_query($link, "SELECT * FROM user where id = '$user'")) {
            while ($aaa = mysqli_fetch_assoc($result)) {
                $user_name =$aaa["name"];
                $user_id = $aaa["id"];
                $user_pass = $aaa["password"];
                $mail =$aaa["email"]; 
                $level =$aaa["permission"]; 
                $input2 .= "<tr><td>" . $user_name . "</td><td>" . $user_id . "</td><td>" . $user_pass . "</td><td>" . $mail . "</td><td>" . $level . '</td></td><td align = "center"><form><button type="button" class="btn-sm btn-success" onclick = "location.href=\'update_mem.php?update_id='.$user_id.'\'">修改</button></form></td></tr>';            }
            mysqli_free_result($result); // 釋放佔用的記憶體
        }

        //新增
        $a = 0;
        if(isset($_POST['new_good_name']))
        {
            $new_good_name = $_POST['new_good_name'];
            $a = 1;
        }
        if(isset($_POST['picture'])){$picture = $_POST['picture'];}
        if(isset($_POST['where'])){$where = $_POST['where'];}
        if(isset($_POST['introduction'])){$introduction = $_POST['introduction'];}
        if(isset($_POST['adult'])){$adult = $_POST['adult'];}
        if(isset($_POST['half'])){$half = $_POST['half'];}

        if($a == 1)
        {
            $goodid ++;
            $sql = "INSERT INTO `goods` (`goods_name`,`goods_id`,`belong`,`inputer`,`price`,`price_small`,`goods_where`,`information`,`file_name`) VALUE ('$new_good_name','$goodid','0','$user','$adult','$half','$where','$introduction','$picture')";
            $test = "SELECT * FROM `goods` WHERE `goods_name` = '$new_good_name' ";
            $result = mysqli_query($link, $test);
            if (!($num = mysqli_num_rows($result)))
            {
                $result = mysqli_query($link, $sql);
            }
            else
                $goodid --;
        }
        

        //刪除
    }
    else if($level == 1)
    {
        $input2 = "";
        if ($result = mysqli_query($link, "SELECT * FROM user where id = '$user'")) {
            while ($aaa = mysqli_fetch_assoc($result)) {
                $user_name =$aaa["name"];
                $user_id = $aaa["id"];
                $user_pass = $aaa["password"];
                $mail =$aaa["email"]; 
                $level =$aaa["permission"]; 
                $input2 .= "<tr><td>" . $user_name . "</td><td>" . $user_id . "</td><td>" . $user_pass . "</td><td>" . $mail . "</td><td>" . $level . '</td><td align = "center"><form><button type="button" class="btn-sm btn-success" onclick = "location.href=\'update_mem.php?update_id='.$user_id.'\'">修改</button></form></td></tr>';
            }
            mysqli_free_result($result); // 釋放佔用的記憶體
        }

    }
    ///新購物車搜尋
    $schedule = "";
    $count = 0;


    if ($result = mysqli_query($link, "SELECT * FROM schedule where user_name = '$user_id' and buy = 0 order by `month`,`day`")) {
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


    if ($result = mysqli_query($link, "SELECT * FROM schedule where user_name = '$user_id' and buy = 1 order by `month`,`day`")) {
        while ($aaa = mysqli_fetch_assoc($result)) {
            if($aaa['month']!=0)
            {
                $goods_id = $aaa['goods_id'];
                $month = $aaa["month"];
                $day = $aaa["day"];
                $schedule3 .= "<tr><td>" . $aaa["month"]."/".$aaa["day"] . "</td><td>" . $aaa["name"] . "</td><td>" . $aaa["quantity"]."/".$aaa["quantity_kid"] . '</td><td align = "center"><form><button type="button" class="btn-sm btn-danger" onclick = "location.href=\'delete_buy.php?delete_id_goods='.$user_id.'&delete_goods='.$goods_id.'&delete_month='.$month.'&delete_day='.$day.' \'">退票</button></form></td></tr>';
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

    <!--新增表單驗證-->
    <script src="two.js"></script>
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
    <!--註冊浮動視窗-->
    <?php include("Register_floating.php"); ?>
    <!--登入浮動視窗-->
    <?php include("login_floating.php"); ?>
    <!--行程表(新購物車)   無料-->
    <?php include("schedule_not.php"); ?>
    <!--有料購物車(新行程表)浮動視窗-->
    <?php include("sche_true_yes.php"); ?>
    <!--有料行程表(新購物車)   有料-->
    <?php include("schedule_yes.php"); ?>
    <!--不是賣家浮動視窗-->
    <?php include("schedule_not.php"); ?>

    
    <!--管理員新增-->
      <div class="modal fade bd-example-modal-lg" id="iinput"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
        <form class="form-horizontal" role="form" id="input_form"  action="" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLongTitle">新增商品</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body" align="center">
                            <table width="800" height="500">
                                <tr>
                                <div class="form-group">
                                    <th>商品名稱</th>
                                    <td><input type = "text" size = "20" name = "new_good_name"></input></td>
                                </div>
                                </tr>
                                <tr>
                                <div class="form-group">
                                    <th>位置</th>
                                    <td><input type="radio" id ="" name = "where" value = "1" >銀座、築地
                                        <input type="radio" id ="" name = "where" value = "2" >淺草
                                        <input type="radio" id ="" name = "where" value = "3" >上野、秋葉原
                                        <input type="radio" id ="" name = "where" value = "4" >新宿、池袋
                                        <input type="radio" id ="" name = "where" value = "5" >澀谷、中目黑
                                        <input type="radio" id ="" name = "where" value = "6" >六本木
                                        <input type="radio" id ="" name = "where" value = "7" >台場、豐洲
                                        <input type="radio" id ="" name = "where" value = "8" >迪士尼
                                        <input type="radio" id ="" name = "where" value = "9" >日光
                                        <input type="radio" id ="" name = "where" value = "10" >輕井澤
                                        <input type="radio" id ="" name = "where" value = "11" >河口湖
                                        <input type="radio" id ="" name = "where" value = "12" >箱根
                                        <input type="radio" id ="" name = "where" value = "13" >鎌倉
                                        <input type="radio" id ="" name = "where" value = "14" >橫濱
                                        <label for="where" class="error"></td>
                                </div>
                                </tr>
                                <tr>
                                <div class="form-group">
                                    <th>商品資訊</th>
                                    <td><textarea type = "text" rows = "8" cols = "40" style="overflow-y: scroll; resize: none;" name = "introduction"></textarea></td>
                                </div>
                                </tr>
                                <tr>
                                <div class="form-group">
                                    <th>圖片(檔名+格式)</th>
                                    <td><input type = "text" size = "20" name = "picture"></input></td>
                                </div>
                                </tr>
                                <tr>
                                <div class="form-group">
                                    <th>全票價格</th>
                                    <td><input type = "text" size = "20" name = "adult"></input></td>
                                </div>
                                </tr>
                                <tr>
                                <div class="form-group">
                                    <th>半票價格</th>
                                    <td><input type = "text" size = "20" name = "half"></input></td>
                                </div>
                                </tr>

                            </table>
                        
                </div>
                <div class="modal-footer" >
                    <button type="submit" class="btn-tour" >加入購物車</button>
                </div>
            </div>
        </form>
        </div>

    </div>

    
    <!--晴空塔頁面 1-->
    
    <!--這裡加入表格-->
    <!--商品--><?php
    if($level >= 2)
    {
        echo '
    <section class="ws-section-spacing bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="center-title ">
                    <h2 class="title" name="goods" id="goods">商品</h2>
                    <h4 class="sub-title"></h4><!--這裡可以輸入文字-->
                </div>
            </div>
        </div>
        <table width="1120" border="1" >
            <thead>
                <tr>
                    <th>名稱</th>
                    <th>編號</th>
                    <th>上傳者</th>
                    <th>全票</th>
                    <th>孩童票</th>
                    <th>修改</th>
                    <th>刪除</th>
                </tr>
            </thead>
            <tbody>
                '.$input.'
            
                <tr>
                    <td colspan="7" align="center">
                        <button type="button" class="btn-sm btn-success"  data-toggle="modal" data-target="#iinput">新增</button>
                    </td>
                </tr>
            </tbody>
        </table>
            <!-- item-end -->
        </div>
    </div>
</section>';
    }
?>
    <!--用戶-->
    <section class="ws-section-spacing bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="center-title ">
                    <h2 class="title" name="user" id="user">用戶</h2>
                    <h4 class="sub-title"></h4><!--這裡可以輸入文字-->
                </div>
            </div>
        </div>
        <table width="1120" border="1" >
            <thead>
                <tr>
                    <th>名稱</th>
                    <th>帳號</th>
                    <th>密碼</th>
                    <th>email</th>
                    <th>權限</th>
                    <th><?php if($level ==3 )echo '刪除';else echo'修改'?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    echo $input2;
                ?>
            </tbody>
        </table>
            <!-- item-end -->
        </div>
    </div>
</section>
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

