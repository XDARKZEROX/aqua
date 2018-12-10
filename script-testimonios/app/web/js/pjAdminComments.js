var jQuery_1_8_2 = jQuery_1_8_2 || $.noConflict();
(function ($, undefined) {
	$(function () {
		var $frmCreateComment = $("#frmCreateComment"),
			$frmUpdateComment = $("#frmUpdateComment"),
			$frmXMLFeed = $('#frmXMLFeed'),
			chosen = ($.fn.chosen !== undefined),
			validate = ($.fn.validate !== undefined),
			datagrid = ($.fn.datagrid !== undefined);
		function memberType(type){
			if(type == 'F')
			{
				$('#new_container').css('display', 'block');
				$('#name').addClass('required');
				$('#email').addClass('required email');
				$('#existing_container').css('display', 'none');
				$('#member_id').removeClass('required');
				$('#member_id').val('');$('#member_id').trigger("liszt:updated");
			}else if(type == 'T'){
				$('#existing_container').css('display', 'block');
				$('#member_id').addClass('required');
				$('#new_container').css('display', 'none');
				$('#name').removeClass('required');
				$('#name').val('');
				$('#email').removeClass('required email');
				$('#email').val('');
			}else{
				$('#new_container').css('display', 'none');
				$('#name').removeClass('required');
				$('#name').val('');
				$('#email').removeClass('required email');
				$('#email').val('');
				$('#existing_container').css('display', 'none');
				$('#member_id').removeClass('required');
				$('#member_id').val('');$('#member_id').trigger("liszt:updated");
			}
		}
		function starHover(star)
		{
			for(var i = 1; i <= 5; i++)
			{
				if(i <= star)
				{	
					$('#star_' + i).addClass('star-hover');
				}else{
					$('#star_' + i).removeClass('star-hover');
				}
			}
		}
		$('span.star').hover(
			function () {
				var star = $(this).attr("lang");
				starHover.apply(null, [star]);
			}, 
			function () {
				var star = $("#rating_value").val();
				starHover.apply(null, [star]);
			}
		);
		$('span.star').on('click', function(e){
			e.preventDefault();
			var star = $(this).attr("lang");
			$("#rating_value").val(star);
		});
		
		if ($frmCreateComment.length > 0 && validate) {
			$frmCreateComment.validate({
				errorPlacement: function (error, element) {
					error.insertAfter(element.parent());
				},
				onkeyup: false,
				errorClass: "err",
				wrapper: "em",
				ignore: ''
			});
			
			$frmCreateComment.on('submit', function(e) {
				if($('#is_existing').val() == 'T')
				{
					if(!$('#member_id').valid()) {
				        e.preventDefault();
				    }
				}
				if(!$('#topic_id').valid()) {
			        e.preventDefault();
			    }
			}); 
			$('#is_existing').on("change", function(e){
				memberType($(this).val());
			});
			if (chosen) {
				$("#member_id").chosen();
			}
			if (chosen) {
				$("#topic_id").chosen();
			}
			
			$('#pjPcEditTopic').hide();
			$('#pjPcPreviewTopic').hide();
			$('#pjPcEditMember').hide();
		}
		if ($frmUpdateComment.length > 0 && validate) {
			$frmUpdateComment.validate({
				errorPlacement: function (error, element) {
					error.insertAfter(element.parent());
				},
				onkeyup: false,
				errorClass: "err",
				wrapper: "em",
				ignore: ''
			});
			
			$frmUpdateComment.on('submit', function(e) {
				if($('#is_existing').val() == 'T')
				{
					if(!$('#member_id').valid()) {
				        e.preventDefault();
				    }
				}
				if(!$('#topic_id').valid()) {
			        e.preventDefault();
			    }
			}); 
			$('#is_existing').on("change", function(e){
				memberType($(this).val());
			});

			if (chosen) {
				$("#member_id").chosen();
			}
			if (chosen) {
				$("#topic_id").chosen();
			}
			
			$('.comment-status').on('click', function(e){
				e.preventDefault();
				var status = $(this).attr('data-value');
				var $this = $(this);
				$( ".comment-status" ).each(function() {
					$(this).removeClass( "status-focus" );
				});
				$('#status').val(status);
				$this.addClass("status-focus");
			});
			var rating_value = $('#rating_value').val();
			starHover(rating_value);
			
			$("#dialogDeleteFile").dialog({
				autoOpen: false,
				resizable: false,
				draggable: false,
				modal: true,
				height: 160,
				close: function(){
					$('#record_id').val('');
				},
				buttons: {
					'Delete': function() {
						var id = $('#record_id').val();
						$dialog = $(this);
						$.ajax({
							type: "GET",
							dataType: "json",
							url: "index.php?controller=pjAdminComments&action=pjActionDeleteFile&id=" + id,
							success: function (res) {
								if(res.code == 200)
								{
									$('#file_container_' + id).remove();
									$dialog.dialog('close');
								}
							}
						});
						$(this).dialog('close');			
					},
					'Cancel': function() {
						$(this).dialog('close');
					}
				}
			});
			
			$('.icon-remove-file').on('click', function(e){
				var id = $(this).attr('rev');
				$('#record_id').val(id);
				$("#dialogDeleteFile").dialog('open');
			});
			
			$("#dialogDeleteComment").dialog({
				autoOpen: false,
				resizable: false,
				draggable: false,
				modal: true,
				height: 160,
				width: 320,
				buttons: {
					'Delete': function() {
						var id = $('#comment_id').val();
						$dialog = $(this);
						$.ajax({
							type: "GET",
							dataType: "json",
							url: "index.php?controller=pjAdminComments&action=pjActionDeleteComment&id=" + id,
							success: function (res) {
								if(res.code == 200)
								{
									$dialog.dialog('close');
									window.location.href = 'index.php?controller=pjAdminComments';
								}
							}
						});
						$(this).dialog('close');			
					},
					'Cancel': function() {
						$(this).dialog('close');
					}
				}
			});
			
			$('.icon-remove-file').on('click', function(e){
				var id = $(this).attr('rev');
				$('#record_id').val(id);
				$("#dialogDeleteFile").dialog('open');
			});
			$('.pj-delete-comment').on('click', function(e){
				$("#dialogDeleteComment").dialog('open');
			});
		}
		
		if ($("#grid").length > 0 && datagrid) {
			var member_id = '';
			var topic_id = '';
			if(pjGrid.member_id !== undefined)
			{
				member_id = '&member_id='+pjGrid.member_id;
			}
			if(pjGrid.topic_id !== undefined)
			{
				topic_id = '&topic_id='+pjGrid.topic_id;
			}
			
			function formatDefault (str, obj) {
				if (obj.role_id == 3) {
					return '<a href="#" class="pj-status-icon pj-status-' + (str == 'F' ? '0' : '1') + '" style="cursor: ' +  (str == 'F' ? 'pointer' : 'default') + '"></a>';
				} else {
					return '<a href="#" class="pj-status-icon pj-status-1" style="cursor: default"></a>';
				}
			}
			function formatRole (str) {
				return ['<span class="label-status user-role-', str, '">', str, '</span>'].join("");
			}
			
			function onBeforeShow (obj) {
				if (parseInt(obj.id, 10) === pjGrid.currentCommentId) {
					return false;
				}
				return true;
			}
			function showMember(str, obj){
				if(obj.member_status == 'T')
				{
					return '<a href="index.php?controller=pjAdminMembers&action=pjActionUpdate&id=' + obj.member_id + '">' + str + '</a>';
				}else{
					return '<a href="index.php?controller=pjAdminMembers&action=pjActionUpdate&id=' + obj.member_id + '">' + str + '</a><br/><span class="red">' + myLabel.inactive + '</span>';
				}
			}
			function showTopic(str, obj){
				return '<a href="index.php?controller=pjAdminTopics&action=pjActionUpdate&id=' + obj.topic_id + '">' + str + '</a>';
			}
			var $grid = $("#grid").datagrid({
				buttons: [{type: "edit", url: "index.php?controller=pjAdminComments&action=pjActionUpdate&id={:id}"},
				          {type: "delete", url: "index.php?controller=pjAdminComments&action=pjActionDeleteComment&id={:id}", beforeShow: onBeforeShow}
				          ],
				columns: [{text: myLabel.comment, type: "text", sortable: false, editable: false, width: 260},
				          {text: myLabel.topic, type: "text", sortable: true, editable: false, renderer: showTopic, width: 105},
				          {text: myLabel.member, type: "text", sortable: true, editable: false, renderer: showMember, width: 110},
				          {text: myLabel.status, type: "select", sortable: true, editable: true, width: 120, options: [
				                                                                                     {label: myLabel.approved, value: "T"}, 
				                                                                                     {label: myLabel.reported, value: "R"}, 
				                                                                                     {label: myLabel.notapproved, value: "F"}
				                                                                                     ], applyClass: "pj-comment-status"}],
				dataUrl: "index.php?controller=pjAdminComments&action=pjActionGetComment" + member_id + topic_id,
				dataType: "json",
				fields: ['comment', 'topic', 'member', 'status'],
				paginator: {
					actions: [
					   {text: myLabel.delete_selected, url: "index.php?controller=pjAdminComments&action=pjActionDeleteCommentBulk", render: true, confirmation: myLabel.delete_confirmation},
					   {text: myLabel.exported, url: "index.php?controller=pjAdminComments&action=pjActionExportComment", ajax: false}
					],
					gotoPage: true,
					paginate: true,
					total: true,
					rowCount: true
				},
				saveUrl: "index.php?controller=pjAdminComments&action=pjActionSaveComment&id={:id}",
				select: {
					field: "id",
					name: "record[]"
				}
			});
		}
		
		if ($frmXMLFeed.length > 0 && validate) {
			$frmXMLFeed.validate({
				errorPlacement: function (error, element) {
					error.insertAfter(element.parent());
				},
				onkeyup: false,
				errorClass: "err",
				wrapper: "em",
				ignore: ".ignore"
			});
		}
		
		$(document).on("click", ".btn-all", function (e) {
			if (e && e.preventDefault) {
				e.preventDefault();
			}
			$(this).addClass("pj-button-active").siblings(".pj-button").removeClass("pj-button-active");
			var content = $grid.datagrid("option", "content"),
				cache = $grid.datagrid("option", "cache");
			$.extend(cache, {
				status: "",
				q: ""
			});
			$grid.datagrid("option", "cache", cache);
			$grid.datagrid("load", "index.php?controller=pjAdminComments&action=pjActionGetComment" + member_id + topic_id, "id", "ASC", content.page, content.rowCount);
			return false;
		}).on("click", ".btn-filter", function (e) {
			if (e && e.preventDefault) {
				e.preventDefault();
			}
			var $this = $(this),
				content = $grid.datagrid("option", "content"),
				cache = $grid.datagrid("option", "cache"),
				obj = {};
			$this.addClass("pj-button-active").siblings(".pj-button").removeClass("pj-button-active");
			obj.status = "";
			obj[$this.data("column")] = $this.data("value");
			$.extend(cache, obj);
			$grid.datagrid("option", "cache", cache);
			$grid.datagrid("load", "index.php?controller=pjAdminComments&action=pjActionGetComment" + member_id + topic_id, "id", "ASC", content.page, content.rowCount);
			return false;
		}).on("click", ".pj-status-1", function (e) {
			if (e && e.preventDefault) {
				e.preventDefault();
			}
			return false;
		}).on("submit", ".frm-filter", function (e) {
			if (e && e.preventDefault) {
				e.preventDefault();
			}
			var $this = $(this),
				content = $grid.datagrid("option", "content"),
				cache = $grid.datagrid("option", "cache");
			$.extend(cache, {
				q: $this.find("input[name='q']").val()
			});
			$grid.datagrid("option", "cache", cache);
			$grid.datagrid("load", "index.php?controller=pjAdminComments&action=pjActionGetComment" + member_id + topic_id, "id", "ASC", content.page, content.rowCount);
			return false;
		}).on("focusin", ".datepick", function (e) {
			var $this = $(this);
			$this.datepicker({
				firstDay: $this.attr("rel"),
				dateFormat: $this.attr("rev"),
				onClose: function (selectedDate) {
					var name = $this.attr("name");
					if (name == "date_from[]") {
						$this.closest("tr").find(".datepick[name='date_to[]']").datepicker("option", "minDate", selectedDate);
					} else if (name == "date_to[]") {
						$this.closest("tr").find(".datepick[name='date_from[]']").datepicker("option", "maxDate", selectedDate);
					}
				}
			});
		}).on("change", "#member_id", function (e) {
			if (e && e.preventDefault) {
				e.preventDefault();
			}
			var id = $(this).val();
			if(id == '')
			{
				$('#pjPcEditMember').hide();
			}else{
				var href = $('#pjPcEditMember').attr('data-href');
				href = href.replace(/\{ID\}/g, id);
				$('#pjPcEditMember').attr('href', href);
				$('#pjPcEditMember').show();
			}
			
			return false;
		}).on("change", "#topic_id", function (e) {
			if (e && e.preventDefault) {
				e.preventDefault();
			}
			var id = $(this).val(),
				page_url = $('option:selected', this).attr('data-url');
			if(id == '')
			{
				$('#pjPcEditTopic').hide();
				$('#pjPcPreviewTopic').hide();
			}else{
				var href = $('#pjPcEditTopic').attr('data-href');
				href = href.replace(/\{ID\}/g, id);
				$('#pjPcEditTopic').attr('href', href);
				$('#pjPcEditTopic').show();
				
				$('#pjPcPreviewTopic').attr('href', page_url);
				$('#pjPcPreviewTopic').show();
			}
			
			return false;
		});
	});
})(jQuery_1_8_2);