JQ = $;
JQ(function () 
        {//有問題
            JQ(".adultplus").click(function () 
            {
                //得到當前兄弟文字框的值
                var n = JQ(this).siblings(".adult").val();
                n++;
                JQ(this).siblings(".adult").val(n);
            })
            JQ(".adultminus").click(function(){
                //得到當前兄弟文字框的值
                var n=JQ(this).siblings(".adult").val();
                //當文字框的值減到1時就不再執行n--及後面的程式碼
                if(n==1){
                    return false;
                }
                n--;
                JQ(this).siblings(".adult").val(n);
            })

            JQ(".kidplus").click(function () 
            {
                //得到當前兄弟文字框的值
                var n = JQ(this).siblings(".kid").val();
                n++;
                JQ(this).siblings(".kid").val(n);
            })
            JQ(".kidminus").click(function(){
                //得到當前兄弟文字框的值
                var n=JQ(this).siblings(".kid").val();
                //當文字框的值減到1時就不再執行n--及後面的程式碼
                if(n==1){
                    return false;
                }
                n--;
                JQ(this).siblings(".kid").val(n);
            })


        })
        JQ(document).ready(function(JQ) {
            //for select
            JQ.validator.addMethod("notEqualsto", function(value, element, arg) {
                return arg != value;
            }, "您尚未選擇!");

        JQ("#sentToBack").validate({
            submitHandler: function(form) {
                alert("success!");
                form.submit();
                JQ.ajax({
                    async: false,
                    url: "check_account_jquery_ajax.php",
                    data: JQ('#sentToBack').serialize(),
                    type: "POST",
                    dataType: 'text',
                    success: function(msg) {
                        JQ("#show_msg").html(msg);//顯示訊息
                        //document.getElementById('show_msg').innerHTML= msg ;
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status);
                        alert(thrownError);
                    }
                });
            
            },
            
            rules: {
                uuser:{
                    required: true,
                },

                account: {
                    required: true,
                    minlength: 4,
                    maxlength: 10
                },
                pwd: {
                    required: true,
                    minlength: 6,
                    maxlength: 12
                },
                pwd2: {
                    required: true,
                    equalTo: "#pwd"
                },
                email: {
                    required: true,
                    email: true
                },
                //checkbox若使用相同名稱
                //"hobby[]": {
                   //required: true,
                    //minlength: 2,
                   // maxlength: 3
                //},
                hobby_1: {
                    require_from_group: [2, ".hobby_group"]
                },
                hobby_2: {
                    require_from_group: [2, ".hobby_group"]
                },
                hobby_3: {
                    require_from_group: [2, ".hobby_group"]
                },
                hobby_4: {
                    require_from_group: [2, ".hobby_group"]
                },
                hobby_5: {
                    require_from_group: [2, ".hobby_group"]
                },
                hobby_6: {
                    require_from_group: [2, ".hobby_group"]
                },
                hobby_7: {
                    require_from_group: [2, ".hobby_group"]
                },
                hobby_8: {
                    require_from_group: [2, ".hobby_group"]
                },
                hobby_9: {
                    require_from_group: [2, ".hobby_group"]
                },
                hobby_10: {
                    require_from_group: [2, ".hobby_group"]
                },
            },
            messages: {
                uuser:{
                    required: "用戶名為必填欄位",
                },
                account: {
                    required: "帳號為必填欄位",
                    minlength: "帳號最少要4個字",
                    maxlength: "帳號最長10個字"
                },
                pwd2: {
                    equalTo: "兩次密碼不相符"
                },
                hobby_1: {
                    require_from_group: ""
                },
                hobby_2: {
                    require_from_group: ""
                },
                hobby_3: {
                    require_from_group: ""
                },
                hobby_4: {
                    require_from_group: ""
                },
                hobby_5: {
                    require_from_group: ""
                },
                hobby_6: {
                    require_from_group: ""
                },
                hobby_7: {
                    require_from_group: ""
                },
                hobby_8: {
                    require_from_group: ""
                },
                hobby_9: {
                    require_from_group: ""
                },
                hobby_10: {
                    require_from_group: "請至少選擇2項興趣"
                }
            }
        });

        //==============================================================
        JQ("#form2").validate({
            submitHandler: function(form) {
                alert("success!");
                form.submit();
            },
            rules: {
                account2: {
                    required: true,
                    minlength: 4,
                    maxlength: 10
                },
                pwd3: {
                    required: true,
                    minlength: 6,
                    maxlength: 12
                }
            },
            messages:{
                account2: {
                    required: "帳號為必填欄位",
                    minlength: "帳號最少要4個字",
                    maxlength: "帳號最長10個字"
                }
            }
        });
        });
    $(function() { //網頁完成後才會載入
      $('#account').keyup(function() {
          JQ.ajax({
              url: "check_account_jquery_ajax.php",
              data: $('#sentToBack').serialize(),
              type: "POST",
              dataType: 'text',
              success: function(msg) {
                  $("#show_msg").html(msg);//顯示訊息
                  //document.getElementById('show_msg').innerHTML= msg ;
              },
              error: function(xhr, ajaxOptions, thrownError) {
                  alert(xhr.status);
                  alert(thrownError);
              }
          });
      });
  });
