JQ = $;
        JQ(document).ready(function(JQ) {
            //for select
            JQ.validator.addMethod("notEqualsto", function(value, element, arg) {
                return arg != value;
            }, "您尚未選擇!");

        JQ("#update_mem_form").validate({
            submitHandler: function(form) {
                alert("success!");
                form.submit();
            
            },
            
            rules: {
                us_na:{
                    required: true,
                },

                us_pwd: {
                    required: true,
                    minlength: 6,
                    maxlength: 12
                },
                us_email:{
                    required: true,
                    email: true
                }
                //checkbox若使用相同名稱
                //"hobby[]": {
                   //required: true,
                    //minlength: 2,
                   // maxlength: 3
                //},
               
            },
            messages: {
                us_na: {
                    required: "必填",
                },
                us_pwd: {
                    required: "必填",
                    minlength: "字數小於6",
                    maxlength: "字數大於12"
                },
                ad: {
                    required: "必填",
                    number: "必須是數字"
                },
                us_email: {
                    required: "必填",
                    email: "必須符合email格式"
                }
                
            }
        });

        //==============================================================
        
        });