JQ = $;
        JQ(document).ready(function(JQ) {
            //for select
            JQ.validator.addMethod("notEqualsto", function(value, element, arg) {
                return arg != value;
            }, "您尚未選擇!");

        JQ("#update_form").validate({
            submitHandler: function(form) {
                alert("success!");
                form.submit();
            
            },
            
            rules: {
                na:{
                    required: true,
                },

                id: {
                    required: true,
                },
                
                ad: {
                    required: true,
                    number: true
                },
                ki: {
                    required: true,
                    number: true
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
                na: {
                    required: "必填",
                },
                id: {
                    required: "必填",
                },
                ad: {
                    required: "必填",
                    number: "必須是數字"
                },
                ki: {
                    required: "必填",
                    number: "必須是數字"
                }
                
            }
        });

        //==============================================================
        
        });