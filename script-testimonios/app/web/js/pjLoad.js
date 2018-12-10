var PC = PC || {};
var flag_vote = 0;
PC.Utils = {
	getExt: function(filename){
		var dot_pos = filename.lastIndexOf(".");
		if(dot_pos == -1){
			return "";
		}
		return filename.substr(dot_pos+1).toLowerCase();
	},
	validateExt: function(file_name){
		var ext = this.getExt(file_name),
			allowed_ext = PC.allowed_ext.split("|");
		if(allowed_ext.indexOf(ext) == -1){
			return false;
		}
		return true;
	},
	checkBannedWords: function(comment)
	{
		var banned_word_str = PC.banned_words;
		if(banned_word_str != ""){
	    	banned_word_str = banned_word_str.replace(/\s+/g, '');
	    	banned_word_str = banned_word_str.replace(new RegExp(",","g"),"|");
	    	return !new RegExp(banned_word_str).test(comment);
    	}else{
    		return true;
    	}
	},
	bindStarHover: function(star)
	{
		for(var i = 1; i <= 5; i++)
		{
			var atag = document.getElementById('star_' + i),
				spans = JABB.Utils.getElementsByClass("glyphicon", atag, "SPAN"),
				span = null;
			if(spans.length > 0)
			{
				span = spans[0];
			}
			if(span != null)
			{
				if(i <= star)
				{	
					JABB.Utils.removeClass(span, 'glyphicon-star-empty');
					JABB.Utils.addClass(span, 'glyphicon-star');
				}else{
					JABB.Utils.removeClass(span, 'glyphicon-star');
					JABB.Utils.addClass(span, 'glyphicon-star-empty');
				}
			}
		}
	},
	bindRating: function()
	{
		if(document.getElementById("rating_value") != undefined)
		{
			var rating_value = document.getElementById("rating_value").value;
			PC.Utils.bindStarHover(rating_value);
			
			var stars = JABB.Utils.getElementsByClass("pc-star", null, "A");
			for (var i = 0; i < stars.length; i++) {
				stars[i].onmouseover = function (e) {
					var star = this.getAttribute("lang");
					PC.Utils.bindStarHover(star);
				};
				stars[i].onmouseout = function (e) {
					var star = document.getElementById("rating_value").value;
					PC.Utils.bindStarHover(star);
				};
				stars[i].onclick = function(e){
					if (e && e.preventDefault) {
						e.preventDefault();
					}
					var star = this.getAttribute("lang");
					document.getElementById("rating_value").value = star;
				}
			}
		}
	},
		
	postComment: function(event, form_name, container_id, btn)
	{
		var post_data = [],
			re = /([0-9a-zA-Z\.\-\_]+)@([0-9a-zA-Z\.\-\_]+)\.([0-9a-zA-Z\.\-\_]+)/,
			msg = '',
			name = document.forms[form_name].name,
			email = document.forms[form_name].email,
			comment = document.forms[form_name].comment_text,
			verification = document.forms[form_name].verification,
			file = document.forms[form_name].file,
			install_folder = document.getElementById('pc_install_folder').value;
		
		var err_container = document.getElementById(container_id);
		btn.disabled = true;
		if (name && name.value == '') {
			msg += '<li>' + PC.Msg.name + '</li>';
		}
		if (email) {
			if (email.value == '') {
				msg += '<li>' + PC.Msg.email + '</li>';
			}
			if (email.value != '' && email.value.match(re) == null) {
				msg += '<li>' + PC.Msg.email_inv + '</li>';
			}
		}
		if (comment && comment.value == '') {
			msg += '<li>' + PC.Msg.comment + '</li>';
		}else{
			if(this.checkBannedWords(comment.value) == false){
				msg += '<li>' + PC.Msg.banned_words + '</li>';
			}
		}
		if(file && file.value != ''){
			if(this.validateExt(file.value) == false){
				msg += '<li>' + PC.Msg.file_ext + '</li>';
			}
		}
		if (verification && verification.value == '') {
			msg += '<li>' + PC.Msg.verification + '</li>';
		}
		
		if (msg != '') {
			msg = '<ul>' + msg + '</ul>';
			err_container.innerHTML = msg;
			err_container.style.display = "block";
			btn.disabled = false;
		}else{
			if(verification)
			{
				var verification_inc = PC.Msg.verification_inc;
				JABB.Ajax.sendRequest(install_folder + 'index.php?controller=pjFront&action=pjActionCheckCaptcha&verification=' + verification.value, function (resp) {
					var code = resp.responseText;
					if(code == 100){
						document.forms[form_name].submit();
					}else{
						msg = '<ul><li>' + verification_inc + '</li></ul>';
						err_container.innerHTML = msg;
						err_container.style.display = "block";
						btn.disabled = false;
					}
				});
			}else{
				document.forms[form_name].submit();
			}
		}
	},
	bindVote: function()
	{
		var vote_icons = JABB.Utils.getElementsByClass("pc-vote", null, "A");
		for (var i = 0; i < vote_icons.length; i++) {
			vote_icons[i].onclick = function(e){
				if(flag_vote == 0)
				{
					flag_vote = 1;
					var install_folder = document.getElementById('pc_install_folder').value;
					var comment_id = this.getAttribute("rev");
					var value = this.getAttribute("rel");
					
					JABB.Ajax.getJSON(install_folder + "index.php?controller=pjLoad&action=pjActionVote&id=" + comment_id + "&value=" + value, function (resp){
						document.getElementById("pc_vote_up_" + comment_id).innerHTML = '+' + resp.likes;
						document.getElementById("pc_vote_down_" + comment_id).innerHTML = '-' + resp.dislikes;
						flag_vote = 0;
					});
				}
			}
		}
	},
	bindReport: function()
	{
		var report_icons = JABB.Utils.getElementsByClass("pc-report", null, "A");
		for (var i = 0; i < report_icons.length; i++) {
			report_icons[i].onclick = function(e){
				var comment_id = this.getAttribute("rev");
				var install_folder = document.getElementById('pc_install_folder').value;
				JABB.Ajax.sendRequest(install_folder + 'index.php?controller=pjLoad&action=pjActionReportDialog&id='+comment_id, function (req) {
					TINY.box.show(req.responseText,0,260,130,1);
				});
			}
		}
	},
	submitReport: function(comment_id){
		var install_folder = document.getElementById('pc_install_folder').value;
		JABB.Ajax.sendRequest(install_folder + "index.php?controller=pjLoad&action=pjActionSubmitReport&id="+comment_id, function (req) {
			TINY.box.hide();
		});
	},
	submitLogin: function(event, form_name, container_id)
	{
		var post_data = [],
			re = /([0-9a-zA-Z\.\-\_]+)@([0-9a-zA-Z\.\-\_]+)\.([0-9a-zA-Z\.\-\_]+)/,
			msg = '',
			email = document.forms[form_name].email,
			password = document.forms[form_name].password,
			install_folder = document.getElementById('pc_install_folder').value;
		
		var err_container = document.getElementById(container_id);
		
		if (email) {
			if (email.value == '') {
				msg += '<li>' + PC.Msg.email + '</li>';
			}
			if (email.value != '' && email.value.match(re) == null) {
				msg += '<li>' + PC.Msg.email_inv + '</li>';
			}
		}
		if (password && password.value == '') {
			msg += '<li>' + PC.Msg.password + '</li>';
		}
		if (msg != '') {
			msg = '<ul>' + msg + '</ul>';
			err_container.innerHTML = msg;
			err_container.style.display = "block";
		}else{
			document.forms[form_name].submit();
		}
	},
	submitForgot: function(event, form_name, container_id)
	{
		var post_data = [],
			re = /([0-9a-zA-Z\.\-\_]+)@([0-9a-zA-Z\.\-\_]+)\.([0-9a-zA-Z\.\-\_]+)/,
			msg = '',
			email = document.forms[form_name].email;
		
		var err_container = document.getElementById(container_id);
		
		if (email) {
			if (email.value == '') {
				msg += '<li>' + PC.Msg.email + '</li>';
			}
			if (email.value != '' && email.value.match(re) == null) {
				msg += '<li>' + PC.Msg.email_inv + '</li>';
			}
		}
		if (msg != '') {
			msg = '<ul>' + msg + '</ul>';
			err_container.innerHTML = msg;
			err_container.style.display = "block";
		}else{
			document.forms[form_name].submit();
		}
	},
	submitResend: function(event, form_name, container_id)
	{
		var post_data = [],
			re = /([0-9a-zA-Z\.\-\_]+)@([0-9a-zA-Z\.\-\_]+)\.([0-9a-zA-Z\.\-\_]+)/,
			msg = '',
			email = document.forms[form_name].email;
		
		var err_container = document.getElementById(container_id);
		
		if (email) {
			if (email.value == '') {
				msg += '<li>' + PC.Msg.email + '</li>';
			}
			if (email.value != '' && email.value.match(re) == null) {
				msg += '<li>' + PC.Msg.email_inv + '</li>';
			}
		}
		if (msg != '') {
			msg = '<ul>' + msg + '</ul>';
			err_container.innerHTML = msg;
			err_container.style.display = "block";
		}else{
			document.forms[form_name].submit();
		}
	},
	submitRegister: function(event, form_name, container_id)
	{
		var post_data = [],
			re = /([0-9a-zA-Z\.\-\_]+)@([0-9a-zA-Z\.\-\_]+)\.([0-9a-zA-Z\.\-\_]+)/,
			msg = '',
			name = document.forms[form_name].name,
			email = document.forms[form_name].email,
			password = document.forms[form_name].password,
			verification = document.forms[form_name].verification,
			install_folder = document.getElementById('pc_install_folder').value;
		
		var err_container = document.getElementById(container_id);
		
		if (name && name.value == '') {
			msg += '<li>' + PC.Msg.name + '</li>';
		}
		if (email) {
			if (email.value == '') {
				msg += '<li>' + PC.Msg.email + '</li>';
			}
			if (email.value != '' && email.value.match(re) == null) {
				msg += '<li>' + PC.Msg.email_inv + '</li>';
			}
		}
		if (password && password.value == '') {
			msg += '<li>' + PC.Msg.password + '</li>';
		}
		if (verification && verification.value == '') {
			msg += '<li>' + PC.Msg.verification + '</li>';
		}
		
		if (msg != '') {
			msg = '<ul>' + msg + '</ul>';
			err_container.innerHTML = msg;
			err_container.style.display = "block";
		}else{
			var email_ext = PC.Msg.email_ext;
			var verification_inc = PC.Msg.verification_inc;
			var post_data = JABB.Utils.serialize(document.forms[form_name]);
			
			JABB.Ajax.postJSON(install_folder + 'index.php?controller=pjLoad&action=pjActionCheckForm', function (data) {
				if(data.captcha == '1' && data.email == '1'){
					document.forms[form_name].submit();
				}else{
					if(data.email == '0'){
						msg += '<li>' + email_ext + '</li>';
					}
					if(data.captcha == '0'){
						msg += '<li>' + verification_inc + '</li>';
					}
					msg = '<ul>' + msg + '</ul>';
					err_container.innerHTML = msg;
					err_container.style.display = "block";
				}
			}, post_data);
		}
	},
	updateProfile: function(event, form_name, container_id)
	{
		var post_data = [],
			re = /([0-9a-zA-Z\.\-\_]+)@([0-9a-zA-Z\.\-\_]+)\.([0-9a-zA-Z\.\-\_]+)/,
			msg = '',
			name = document.forms[form_name].name,
			email = document.forms[form_name].email;
		
		var err_container = document.getElementById(container_id);
		
		if (name && name.value == '') {
			msg += '<li>' + PC.Msg.name + '</li>';
		}
		if (email) {
			if (email.value == '') {
				msg += '<li>' + PC.Msg.email + '</li>';
			}
			if (email.value != '' && email.value.match(re) == null) {
				msg += '<li>' + PC.Msg.email_inv + '</li>';
			}
		}
		
		if (msg != '') {
			msg = '<ul>' + msg + '</ul>';
			err_container.innerHTML = msg;
			err_container.style.display = "block";
		}else{
			document.forms[form_name].submit();
		}
	},
	removeAvatar: function(event, member_id, container_id)
	{
		var install_folder = document.getElementById('pc_install_folder').value;
		var avatar_container = document.getElementById(container_id);
		JABB.Ajax.sendRequest(install_folder + 'index.php?controller=pjLoad&action=pjActionRemoveAvatar&id=' + member_id, function (resp) {
			avatar_container.innerHTML = '';
			avatar_container.style.display = "none";
		});
	}
};

var PC = PC || {};
PC.Utils.bindRating();
PC.Utils.bindReport();
PC.Utils.bindVote();