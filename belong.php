<?php 
$j = 0;
while(isset($be_pic[$j]))
{
    if($j %2 == 0)
    {
        echo'
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        '.$be_pic[$j].'
                    </div>
                    <div class="col-lg-6">
                        <div class="about-content">
                            <h2>'.$be_name[$j].'</h2>
                            <p>'.$be_information[$j].'</p>
                        </div>
                    </div>
                </div>
            </div>
            ';
    }
    else
    {
        echo'
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="about-content">
                            <h2>'.$be_name[$j].'</h2>
                            <p>'.$be_information[$j].'</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        '.$be_pic[$j].'
                    </div>
                </div>
            </div>
            ';
    }
    $j ++;
}

?>