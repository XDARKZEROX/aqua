var jQuery_1_8_2 = jQuery_1_8_2 || $.noConflict();
(function ($, undefined) {
	$(function () {
		var $frmCreateMember = $("#frmCreateMember"),
			$frmUpdateMember = $("#frmUpdateMember"),
			validate = ($.fn.validate !== undefined),
			datagrid = ($.fn.datagrid !== undefined);
		
		if ($frmCreateMember.length > 0 && validate) {
			$frmCreateMember.validate({
				rules: {
					"email": {
						required: true,
						email: true,
						remote: "index.php?controller=pjAdminMembers&action=pjActionCheckEmail"
					}
				},
				messages: {
					"email": {
						remote: "Email address is already in use"
					}
				},
				errorPlacement: function (error, element) {
					error.insertAfter(element.parent());
				},
				onkeyup: false,
				errorClass: "err",
				wrapper: "em"
			});
		}
		if ($frmUpdateMember.length > 0 && validate) {
			$frmUpdateMember.validate({
				rules: {
					"email": {
						required: true,
						email: true,
						remote: "index.php?controller=pjAdminMembers&action=pjActionCheckEmail&id=" + $frmUpdateMember.find("input[name='id']").val()
					}
				},
				messages: {
					"email": {
						remote: myLabel.email_taken
					}
				},
				errorPlacement: function (error, element) {
					error.insertAfter(element.parent());
				},
				onkeyup: false,
				errorClass: "err",
				wrapper: "em"
			});
			
			$("#dialogDeleteAvatar").dialog({
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
							url: "index.php?controller=pjAdminMembers&action=pjActionDeleteAvatar&id=" + id,
							success: function (res) {
								if(res.code == 200)
								{
									$('#avatar_container').remove();
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
			
			$('.icon-remove').on('click', function(e){
				var id = $(this).attr('rev');
				$('#record_id').val(id);
				$("#dialogDeleteAvatar").dialog('open');
			});
		}
		
		if ($("#grid").length > 0 && datagrid) {
			function formatDefault (str, obj) {
				if (obj.role_id == 3) {
					return '<a href="#" class="pj-status-icon pj-status-' + (str == 'F' ? '0' : '1') + '" style="cursor: ' +  (str == 'F' ? 'pointer' : 'default') + '"></a>';
				} else {
					return '<a href="#" class="pj-status-icon pj-status-1" style="cursor: default"></a>';
				}
			}
			function onBeforeShow (obj) {
				if (parseInt(obj.id, 10) === pjGrid.currentMemberId) {
					return false;
				}
				return true;
			}
			function formatComments(str, obj){
				if(str == '0')
				{
					return 0;
				}else{
					return '<a href="index.php?controller=pjAdminComments&action=pjActionIndex&member_id='+obj.id+'">'+str+'</a>';
				}
			}
			var $grid = $("#grid").datagrid({
				buttons: [{type: "edit", url: "index.php?controller=pjAdminMembers&action=pjActionUpdate&id={:id}"},
				          {type: "delete", url: "index.php?controller=pjAdminMembers&action=pjActionDeleteMember&id={:id}", beforeShow: onBeforeShow}
				          ],
				columns: [{text: myLabel.name, type: "text", sortable: true, editable: false, width: 140},
				          {text: myLabel.email, type: "text", sortable: true, editable: true, width: 160},
				          {text: myLabel.comments, type: "text", sortable: false, editable: false, width: 80, align: 'center', renderer: formatComments},
				          {text: myLabel.membersince, type: "date", sortable: true, editable: false, width: 110},
				          {text: myLabel.status, type: "select", sortable: true, editable: true, width: 100, options: [
				                                                                                     {label: myLabel.active, value: "T"}, 
				                                                                                     {label: myLabel.inactive, value: "F"}
				                                                                                     ], applyClass: "pj-status"}],
				dataUrl: "index.php?controller=pjAdminMembers&action=pjActionGetMember",
				dataType: "json",
				fields: ['name', 'email', 'cnt_comments', 'first_comment', 'status'],
				paginator: {
					actions: [
					   {text: myLabel.delete_selected, url: "index.php?controller=pjAdminMembers&action=pjActionDeleteMemberBulk", render: true, confirmation: myLabel.delete_confirmation},
					   {text: myLabel.revert_status, url: "index.php?controller=pjAdminMembers&action=pjActionStatusMember", render: true},
					   {text: myLabel.exported, url: "index.php?controller=pjAdminMembers&action=pjActionExportMember", ajax: false}
					],
					gotoPage: true,
					paginate: true,
					total: true,
					rowCount: true
				},
				saveUrl: "index.php?controller=pjAdminMembers&action=pjActionSaveMember&id={:id}",
				select: {
					field: "id",
					name: "record[]"
				}
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
			$grid.datagrid("load", "index.php?controller=pjAdminMembers&action=pjActionGetMember", "name", "ASC", content.page, content.rowCount);
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
			$grid.datagrid("load", "index.php?controller=pjAdminMembers&action=pjActionGetMember", "name", "ASC", content.page, content.rowCount);
			return false;
		}).on("click", ".pj-status-1", function (e) {
			if (e && e.preventDefault) {
				e.preventDefault();
			}
			return false;
		}).on("click", ".pj-status-0", function (e) {
			if (e && e.preventDefault) {
				e.preventDefault();
			}
			$.post("index.php?controller=pjAdminMembers&action=pjActionSetActive", {
				id: $(this).closest("tr").data("object")['id']
			}).done(function (data) {
				$grid.datagrid("load", "index.php?controller=pjAdminMembers&action=pjActionGetMember");
			});
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
			$grid.datagrid("load", "index.php?controller=pjAdminMembers&action=pjActionGetMember", "id", "ASC", content.page, content.rowCount);
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
		}).on("click", ".pj-form-field-icon-date", function (e) {
			var $dp = $(this).parent().siblings("input[type='text']");
			if ($dp.hasClass("hasDatepicker")) {
				$dp.datepicker("show");
			} else {
				$dp.trigger("focusin").datepicker("show");
			}
		});
	});
})(jQuery_1_8_2);