var jQuery_1_8_2 = jQuery_1_8_2 || $.noConflict();
(function ($, undefined) {
	$(function () {
		var $frmCreateTopic = $("#frmCreateTopic"),
			$frmUpdateTopic = $("#frmUpdateTopic"),
			validate = ($.fn.validate !== undefined),
			datagrid = ($.fn.datagrid !== undefined);
		
		if ($frmCreateTopic.length > 0 && validate) {
			$frmCreateTopic.validate({
				errorPlacement: function (error, element) {
					error.insertAfter(element.parent());
				},
				onkeyup: false,
				errorClass: "err",
				wrapper: "em"
			});
		}
		if ($frmUpdateTopic.length > 0 && validate) {
			$frmUpdateTopic.validate({
				errorPlacement: function (error, element) {
					if(element.attr('name') == 'page_url')
					{
						error.insertAfter(element.parent().parent());
					}else{
						error.insertAfter(element.parent());
					}
				},
				onkeyup: false,
				errorClass: "err",
				wrapper: "em"
			});
		}
		if ($frmCreateTopic.length > 0 || $frmUpdateTopic.length > 0) 
		{
			$.validator.addMethod("refid", function(value, element) {
		        return this.optional(element) || /^[a-z0-9]+$/i.test(value);
		    });
			$.validator.addMethod("pageurl", function(val, elem) {
			    if (val.length == 0) { return true; }
			    
			    return /^http:\/\/|(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/i.test(val);
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
				if (pjGrid.roleId === 2) {
					return false;
				}
				return true;
			}
			function formatPageUrl(str, obj){
				if(str == '')
				{
					return '';
				}else{
					return '<a href="'+str+'" target="_blank">'+str+'</a>';
				}
			}
			function formComments(str, obj){
				if(str == '0')
				{
					return 0;
				}else{
					return '<a href="index.php?controller=pjAdminComments&action=pjActionIndex&topic_id='+obj.id+'">'+str+'</a>';
				}
			}
			var $grid = $("#grid").datagrid({
				buttons: [{type: "edit", url: "index.php?controller=pjAdminTopics&action=pjActionUpdate&id={:id}"},
				          {type: "delete", url: "index.php?controller=pjAdminTopics&action=pjActionDeleteTopic&id={:id}", beforeShow: onBeforeShow},
						  {type: "menu", url: "#", text: myLabel.more, items:[
    				              {text: myLabel.preview, url: "preview.php?topic_id={:id}", ajax: false, render: true, target: "_blank"},
    				              {text: myLabel.install, url: "index.php?controller=pjAdminOptions&action=pjActionInstall&id={:id}", ajax: false, render: true},
    				              {text: myLabel.exportcomments, url: "index.php?controller=pjAdminComments&action=pjActionFeed&topic_id={:id}", ajax: false, render:true}
    				      ]}],
				columns: [{text: myLabel.id, type: "text", sortable: true, editable: false, width: 110},
				          {text: myLabel.page, type: "text", sortable: false, editable: false, width: 260, renderer: formatPageUrl},
				          {text: myLabel.comments, type: "text", sortable: false, editable: false, width: 80, renderer: formComments},
				          {text: myLabel.status, type: "select", sortable: true, editable: true, width: 110, options: [
				                                                                                     {label: myLabel.active, value: "T"}, 
				                                                                                     {label: myLabel.inactive, value: "F"}
				                                                                                     ], applyClass: "pj-status"}],
				dataUrl: "index.php?controller=pjAdminTopics&action=pjActionGetTopic",
				dataType: "json",
				fields: ['topic', 'page_url', 'cnt_comments', 'status'],
				paginator: {
					actions: [
					   {text: myLabel.delete_selected, url: "index.php?controller=pjAdminTopics&action=pjActionDeleteTopicBulk", render: false, confirmation: myLabel.delete_confirmation},
					   {text: myLabel.revert_status, url: "index.php?controller=pjAdminTopics&action=pjActionStatusTopic", render: true},
					   {text: myLabel.exported, url: "index.php?controller=pjAdminTopics&action=pjActionExportTopic", ajax: false}
					],
					gotoPage: true,
					paginate: true,
					total: true,
					rowCount: true
				},
				saveUrl: "index.php?controller=pjAdminTopics&action=pjActionSaveTopic&id={:id}",
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
			$grid.datagrid("load", "index.php?controller=pjAdminTopics&action=pjActionGetTopic", "topic", "ASC", content.page, content.rowCount);
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
			$grid.datagrid("load", "index.php?controller=pjAdminTopics&action=pjActionGetTopic", "topic", "ASC", content.page, content.rowCount);
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
			$.post("index.php?controller=pjAdminTopics&action=pjActionSetActive", {
				id: $(this).closest("tr").data("object")['id']
			}).done(function (data) {
				$grid.datagrid("load", "index.php?controller=pjAdminTopics&action=pjActionGetTopic");
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
			$grid.datagrid("load", "index.php?controller=pjAdminTopics&action=pjActionGetTopic", "id", "ASC", content.page, content.rowCount);
			return false;
		});
	});
})(jQuery_1_8_2);