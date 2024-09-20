<?php echo 
    '<div class="modal fade bd-example-modal-lg" id="ssubmit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="form-horizontal" role="form" id = "sentToBack" name="formsubmit" action="register.php" method = "POST">   
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title" id="exampleModalLongTitle">註冊</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" align="center">
                
                    <div class="form-group">
                        <div class="col-sm-4 control-label">用戶名</div>
                        <div class="col-sm-12">
                            <input type="text" class="form-inline" id="uuser" name="uuser" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">帳號</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-inline" id="account" name="account" placeholder="限4-15個字">
                            <span id="show_msg" style="color:red"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">密碼</label>
                        <div class="col-sm-12">
                            <input type="password" class="form-inline" id="pwd" name="pwd" placeholder="限6-18個字">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">密碼確認</label>
                        <div class="col-sm-12">
                            <input type="password" class="form-inline" id="pwd2" name="pwd2" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">E-mail</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-inline" id="email" name="email" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">偏好</label>
                        <div class="col-sm-12">
                            <input type="checkbox" class="checkbox-inline hobby_group" name="hobby_1">繁華都市
                            <input type="checkbox" class="checkbox-inline hobby_group" name="hobby_2">悠閒山林
                            <input type="checkbox" class="checkbox-inline hobby_group" name="hobby_3">湖海風光
                            <input type="checkbox" class="checkbox-inline hobby_group" name="hobby_4">遊樂園
                            <input type="checkbox" class="checkbox-inline hobby_group" name="hobby_5">歷史文物
                            <input type="checkbox" class="checkbox-inline hobby_group" name="hobby_6">現代科技
                            <input type="checkbox" class="checkbox-inline hobby_group" name="hobby_7">自然風光
                            <input type="checkbox" class="checkbox-inline hobby_group" name="hobby_8">溫泉
                            <input type="checkbox" class="checkbox-inline hobby_group" name="hobby_9">個季花卉
                            <input type="checkbox" class="checkbox-inline hobby_group" name="hobby_10">血拚爆買
                            <label for="hobby_10" class="error">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">身分</label>
                        <div class="col-sm-8 col-sm-offset-4">
                            <div class="rasio">
                                <label>
                                    <input type="radio" id="agree" name="agree" value="1">當一個買家就好
                                    <input type="radio" id="agree" name="agree" value="2">同時成為賣家
                                </label>
                                <label class="error" for="agree"></label>
                            </div>
                        </div>
                    </div>
                
            </div>
            <div class="modal-footer">
              <button type="button" class="btn-tour" data-dismiss="modal">離開</button>
              <button type="submit" class="btn-tour">前往註冊</button>
            </div>
            </form>
          </div>
        </div>
      </div>





'
?>