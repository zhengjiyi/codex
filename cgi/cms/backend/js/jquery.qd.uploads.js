(function($) {
	// 插件的定义    
	$.fn.uploads = function(opts) {
		//debug(this);

		// build main options before element iteration
		if (opts.preview) {
			preview($(this), opts);
		} else {
			attach($(this), opts);
		}
	};
	// 私有函数：debugging
	function debug($obj) {
		if (window.console && window.console.log)
			window.console.log('uploads count: ' + $obj.size());
	};
	function preview($obj, opts) {
		var show = $obj.parent().prev();
		var pick = $obj.parent();
		$obj.live('change', function(){
			var src = show.find(".temp").attr("src");
			var view = $('<div class="img-view"></div>');
			$.ajaxFileUpload({
				url: base_url+opts.ctrl+'/upload/'+opts.field,
				secureuri: false,
				fileElementId: $obj.attr('name'),
				dataType: 'json',
				success: function (data, status) {
					if (data.status == 'success') {
						if ( typeof(opts.multi) == 'undefined' ) {
							if (typeof(src) != 'undefined' && src.length > 0) {
								removeSrc(opts.ctrl, src);
							}
							show.empty().append(view);
							$("#"+opts.field).val(data.filename);
							$("#"+opts.field).next("label").remove();
							view.html('<span><img class="temp" for="'+opts.field+'" src="'+data.filename+'"></span><div id="move-'+opts.field+'" class="img-move"></div>');
						} else {
							var file_input = $('<input/>');
							$(file_input).attr('type', 'hidden');
							$(file_input).attr('name', opts.name);
							$(file_input).attr('value', data.filename);
							$(file_input).attr('id', opts.field+'_'+($('input[name="'+opts.name+'"]').length+1));
							$(pick).after(file_input);
							$("#"+opts.field).next("label").remove();
							view.html('<span><img class="temp" for="'+opts.field+'" src="'+data.filename+'"></span><div id="move-'+opts.field+'-'+$('input[name="'+opts.name+'"]').length+'" class="img-move"></div>');
							show.append(view);
							$obj.val('');
						}

					} else {
						alert(data.error);
					}
				},
				error: function (data, status, e) {
					alert(e);
				}
			});
		});

		if ( typeof(opts.multi) == 'undefined' ) {
			show.on("click", "#move-" + opts.field, function () {
				var img = $(this).prev().children("img");
				$("#" + img.attr("for")).val("");
				if (img.hasClass("temp")) {
					removeSrc(opts.ctrl, img.attr("src"));
				}
				$(this).parent().remove();
			});
		} else {
			show.on("click", ".img-move", function () {
				var id = $(this).attr('id');
				var tmp = id.split('-');
				var index = tmp.pop();
				var view = show.find('.img-view:eq('+(index-1)+')');
				var img = $(view).find('img');
				if (img.hasClass("temp")) {
					removeSrc(opts.ctrl, img.attr("src"));
				}
				$(view).remove();
				$('#'+opts.field+'_'+index).remove();
				// 更新所有move-imgid
				$('div[id^="move-'+opts.field+'"]').each(function(i){
					$(this).attr('id', 'move-'+opts.field+'-'+(i+1));
				});
                // 更新所有pick
                $('input[id^="'+opts.field+'"]').each(function(i){
                    $(this).attr('id', opts.field+'_'+(i+1));
                });
			});
		}
	};
	function attach($obj, opts) {
		$obj.change(function(){
			$.ajaxFileUpload({
				url: base_url+opts.ctrl+'/upload/'+opts.field,
				secureuri: false,
				fileElementId: $obj.attr('name'),
				dataType: 'json',
				success: function (data, status) {
					if (data.status == 'success') {
						$("#"+opts.field).val(data.filename);
						$("#"+opts.field).next("label").remove();
						if (typeof(src) != 'undefined' && src.length > 0) {
							removeSrc(opts.ctrl, src);
						}
					} else {
						alert(data.error);
					}
				},
				error: function (data, status, e) {
					alert(e);
				}
			});
		});
	};
	function removeSrc(ctrl, src) {
		$.get(base_url+ctrl+'/remove',{filename: src},function(data){
			if (data.status == 'fail') {
				alert(data.error);
			}
		});
	};
	// 闭包结束
})(jQuery);