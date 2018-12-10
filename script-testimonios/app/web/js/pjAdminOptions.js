var jQuery_1_8_2 = jQuery_1_8_2 || $.noConflict();
(function ($, undefined) {
	$(function () {
		var tabs = ($.fn.tabs !== undefined),
			spinner = ($.fn.spinner !== undefined),
			tipsy = ($.fn.tipsy !== undefined),
			$tabs = $("#tabs");
		
		if ($tabs.length > 0 && tabs) {
			$tabs.tabs();
		}
		if (spinner) {
			$(".field-int").spinner({
				min: 0
			});
		}
		if (tipsy) {
			$(".option-tip").tipsy({
				offset: 1,
				opacity: 1,
				html: true,
				gravity: "nw",
				className: "tipsy-listing"
			});
		}
		
		$("#content").on("focusin", ".textarea_install", function (e) {
			$(this).select();
		}).on("change", "select[name='value-enum-o_send_email']", function (e) {
			switch ($("option:selected", this).val()) {
			case 'mail|smtp::mail':
				$(".boxSmtp").hide();
				break;
			case 'mail|smtp::smtp':
				$(".boxSmtp").show();
				break;
			}
		}).on("change", "select[name='value-enum-o_allow_file_uploading']", function (e) {
			switch ($("option:selected", this).val()) {
			case 'Yes|No::No':
				$(".boxFileExt").hide();
				break;
			case 'Yes|No::Yes':
				$(".boxFileExt").show();
				break;
			}
		}).on("click", ".pj-button-get-code", function (e) {
			reDrawCode.call(null, 1);
		}).on("click", ".pj-button-preview", function (e) {
			if($('#topic_id').length > 0)
			{
				var topic_id = $('#topic_id').val(),
					theme = $('#theme').val();
				
				if(topic_id != '')
				{
					$('#topic_id').removeClass('pjPcRedBorder');
					window.open("preview.php?topic_id=" + topic_id + "&theme=" + theme);
				}else{
					$('#topic_id').addClass('pjPcRedBorder');
				}
			}
		}).on("change", "#topic_id", function (e) {
			reDrawCode.call(null, 0);
		}).on("change", "#theme", function (e) {
			reDrawCode.call(null, 1);
		});
		
		function reDrawCode(open)
		{
			if($('#topic_id').length > 0)
			{
				var topic_id = $('#topic_id').val(),
					theme = $('#theme').val();
				if(topic_id != '')
				{
					$('#step1').val('<?php\nob_start();\n$PJ_TOPIC = '+topic_id+'; $PJ_THEME = \''+theme+'\'; \n?>');
					if(open == 1)
					{
						$('#step_container').show();
					}
					$('#topic_id').removeClass('pjPcRedBorder');
				}else{
					$('#step_container').hide();
					$('#topic_id').addClass('pjPcRedBorder');
				}
			}
		}
	});
})(jQuery_1_8_2);