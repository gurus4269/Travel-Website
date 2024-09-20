<?php echo'
    <div class="modal fade bd-example" id="loggin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="form-horizontal" role="form" id="form2" name="formlogin" action="success_or_not.php" method="POST">    
            <div class="modal-content">
                <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLongTitle">登入</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body" align="center">
                    
                        <div class="form-group">
                            <label class="col-sm-4 control-label">帳號</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-inline" id="account2" name="account2" placeholder="限4-15個字">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">密碼</label>
                            <div class="col-sm-12">
                                <input type="password" class="form-inline" id="pwd3" name="pwd3" placeholder="限6-18個字">
                            </div>
                        </div>
                    
                </div>
                <div class="modal-footer" >
                <button type="button" class="btn-tour">忘記密碼</button>
                <button type="submit" class="btn-tour" id="loginbtn" name = "login">登入</button>
                </div>
        
            </div>
        </form>
    </div>
  </div>

'
?>