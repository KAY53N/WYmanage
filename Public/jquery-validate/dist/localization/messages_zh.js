(function( factory ) {
	if ( typeof define === "function" && define.amd ) {
		define( ["jquery", "../jquery.validate"], factory );
	} else {
		factory( jQuery );
	}
}(function( $ ) {

/*
 * Translated default messages for the jQuery validation plugin.
 * Locale: ZH (Chinese, 中文 (Zhōngwén), 汉语, 漢語)
 */
$.extend($.validator.messages, {
	required: "必须填写",
	remote: "请修正此栏位",
	email: "请输入有效的电子邮件",
	url: "请输入有效的网址",
	date: "请输入有效的日期",
	dateISO: "请输入有效的日期 (YYYY-MM-DD)",
	number: "请输入正确的数字",
	digits: "只可输入数字",
	creditcard: "请输入有效的信用卡号码",
	equalTo: "你的输入不相同",
	extension: "请输入有效的后缀",
	maxlength: $.validator.format("最多 {0} 个字"),
	minlength: $.validator.format("最少 {0} 个字"),
	rangelength: $.validator.format("请输入长度为 {0} 至 {1} 之間的字串"),
	range: $.validator.format("请输入 {0} 至 {1} 之间的数值"),
	max: $.validator.format("请输入不大于 {0} 的数值"),
	min: $.validator.format("请输入不小于 {0} 的数值")
});

}));

var regMessage = {
		username: {
			required: '请输入用户名'
		},
		upwd: {
			required: '请输入密码'
		},
		repwd: {
			required: '请输入确认密码'
		},
		avatars: {
			required: '请上传头像'
		},
		street: {
			required: '请输入详细地址'
		},
        code: {
            required: '请输入验证码'
        },
        attend_province: {
            required: '请选择就读学校省份'
        },
        attend_school: {
            required: '请选择就读学校'
        },
        title: {
            required: '请填写标题'
        },
        content: {
            required: '请填写内容'
        },
        name: {
            required: '请输入姓名'
        },
        phone: {
            required: '请输入手机号'
        },
        email: {
            required: '请输入Email'
        }

	}

	jQuery.validator.addMethod("isMobile", function(value, element) {
		  var length = value.length;
		  var mobile = /^1\d{10}$/;
		  return this.optional(element) || (length == 11 && mobile.test(value));
	}, '请正确填写您的手机号码');


	jQuery.validator.addMethod("checkUsernameLength", function(value, element) {
		  var length = value.length;
		  var reg = /\w{6,12}/;
		  return this.optional(element) || reg.test(value);
	}, '请输入6-12位数字或字母组成的字符');
