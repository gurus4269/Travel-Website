JQ = $;
        JQ(document).ready(function(JQ) {
            //for select
            JQ.validator.addMethod("notEqualsto", function(value, element, arg) {
                return arg != value;
            }, "您尚未選擇!");

        JQ("#input_form").validate({
            submitHandler: function(form) {
                alert("success!");
                form.submit();
            
            },
            
            rules: {
                new_good_name:{
                    required: true,
                },

                introduction: {
                    required: true,
                },
                picture: {
                    required: true,
                },
                adult: {
                    required: true,
                    number: true
                },
                half: {
                    required: true,
                    number: true
                },
                where: {
                    required: true,
                }
                //checkbox若使用相同名稱
                //"hobby[]": {
                   //required: true,
                    //minlength: 2,
                   // maxlength: 3
                //},
               
            },
            messages: {
                new_good_name:{
                    required: "商品名必填",
                },
                introduction: {
                    required: "必填",
                },
                picture: {
                    required: "必填",
                },
                adult: {
                    required: "必填",
                    number: "必須是數字"
                },
                half: {
                    required: "必填",
                    number: "必須是數字"
                },
                where: {
                    required: "必填",
                }
                
            }
        });

        //==============================================================
        
        });