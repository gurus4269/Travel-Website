<?php echo'



<div class="modal fade bd-example-modal-lg" id="ggood"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
        <form class="form-horizontal" role="form" id="form5" name="formadd" action="" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLongTitle">商品頁面</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body" align="center">
                        <div class="form-group">
                            <table width="750" height="300">
                                <tr>  
                                    <td colspan="2" rowspan="5" width = "250">'.$pic.'</td>
                                    <td colspan="2"><h3>&emsp;&emsp;
                                            '.$name.'
                                        </h3></td>
                                </tr>
                                <tr> 
                                    <td colspan="2"><h6 >&emsp;時間&ensp;:&ensp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<select name="month" size="1" >
                        ';
                            if(isset($_POST['month']))
                            {
                                for($i =1 ; $i < 13; $i++){
                                    if($i==intval($_POST['month']))
                                    {
                                        echo '<option value="'.$_POST['month'].'" selected>'.$i.'</option>';
                                    } 
                                    else
                                    {
                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                    }
                                    
                                }
                            }
                            else
                            {
                                for($i =1 ; $i < 13; $i++){
                                    if($i==intval(date('n')))
                                    {
                                        echo '<option value="'.$i.'" selected>'.$i.'</option>';
                                    } 
                                    else
                                    {
                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                    }
                                    
                                }
                            }
                        echo'
                        <option value="">&emsp;&emsp;</option>
                    </select>&emsp;月&emsp;
                    <select name="day" size="1">';
                        
                            if(isset($_POST['day']))
                            {
                                for($i =1 ; $i < 32; $i++){
                                    if($i==intval($_POST['day']))
                                    {
                                        echo '<option value="'.$_POST['day'].'" selected>'.$i.'</option>';
                                    } 
                                    else
                                    {
                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                    }
                                    
                                }
                            }
                            else
                            {
                                for($i =1 ; $i < 32; $i++){
                                    if($i==intval(date('d')))
                                    {
                                        echo '<option value="'.$i.'" selected>'.$i.'</option>';
                                    } 
                                    else
                                    {
                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                    }
                                    
                                }
                            }
                        echo '
                        <option value="">&emsp;&emsp;</option>
                    </select>&emsp;日&emsp;</h6></td>
                                </tr>
                                <tr>  
                                    <td><h6>
                                        &emsp;全票&ensp;:&ensp;
                                        '.$adult_price.' 円&ensp;&emsp;&emsp;
                                        <button type="button" class="btn-sm btn-success adultminus" name="adultminus">-</button>&emsp; 
                                        <input type="text" class="adult" name="adult" size="1" value = " '.$adults.' " readonly="readonly"> 張&emsp;
                                        <button type="button" class="btn-sm btn-success adultplus" name="adultplus">+</button>
                                    </h6></td>
                                </tr>
                                <tr>
                                    <td><h6>
                                        &emsp;孩童票&ensp;:&ensp;
                                        '.$kid_price.' 円&ensp;&emsp;<button type="button" class="btn-sm btn-success kidminus" name="kidminus">-</button>
                                        &emsp; <input type="text" class="kid" name="kid" size="1" value =" '.$kids.'"  readonly="readonly"> 張
                                        &emsp;<button type="button" class="btn-sm btn-success kidplus" name="kidplus">+</button>
                                    </h6></td>
                                </tr>
                                <tr>  
                                    <td colspan="2"><h6>&emsp;total&emsp;:&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;'.($adult_price*$adults+$kid_price*$kids).'円</h6></td>
                                </tr>

                            </table>
                        </div>
                </div>
                <div class="modal-footer" >
                    <button type="submit" class="btn-tour" >加入購物車</button>
                </div>
            </div>
        </form>
        </div>
    </div>
    
';
?>