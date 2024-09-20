<?php  echo'

<div class="modal fade bd-example-modal-lg" id="ssche_true_yes"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <form class="form-horizontal" role="form" id="form2" name="formschedule" action="#">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLongTitle">行程表</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body" align="center">
                        <form class="form-horizontal" role="form" id="form1">
                            <div class="form-group">
                                <table width="750" >
                                    <thead>
                                        <tr>
                                            <th>日期</th>
                                            <th>名稱</th>
                                            <th>數量</th>
                                            <th>退票</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <tr>
                                            <td><hr></td>
                                            <td><hr></td>
                                            <td><hr></td>
                                            <td><hr></td>
                                        </tr>'
                                        .$schedule3  .                                 
                                    '</tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </form>
        </div>
    </div>


'


?>