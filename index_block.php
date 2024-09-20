<?php 
for($count = 0; $count <6;$count++)
{
    echo '

                <div class="col-lg-4 col-md-6 col-sm-12 masonry">
                    <div class="package-one">
                        <div class="img-wapper">
                            <a href="object.php?id='.$id[$count].'">'.$pic[$count].'</a>
                        </div>
                        <div class="package-content">
                            <h3>'.$name[$count].'</h3>
                            <p> <span>$'.$adult_price[$count].'</span></p>
                            <ul class="ct-action">
                                <li>';
                                for($k = 0; $k <$popular[$count];$k++)
                                {
                                    echo '<i class="fa fa-star"></i>';
                                }
                                    
                            echo'   </li>
                            </ul>
                        </div>
                    </div>
                </div>




    ';
}
?>