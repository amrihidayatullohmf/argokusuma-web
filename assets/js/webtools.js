function deleteListener(datatable,isajax) {
	$(".deletetrigger").off();
	$(".deletetrigger").click(function(){
		var ctx = $(this);
		swal({
			title: "Are you sure ?",
			text: "You will not be able to recover this row!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",	
			confirmButtonText: "Yes, delete it!",
			cancelButtonText: "Cancel",
			closeOnConfirm: false,
			closeOnCancel: true
		},
		function(isConfirm){
			if (isConfirm) {
				var tbl = ctx.data('table');
				var typ = ctx.data('type');
				var prm = ctx.data('param');
				var ids  = ctx.data('ids');

				$.ajax({
					type : 'post',
					data : {table:tbl,param:prm,iddata:ids},
					url  : baseurl+'dashboard/delete/'+typ,
					dataType : 'json',
					success : function(d) {
						console.log(d);
						if(d.code == 200) {
							swal("Deleted!", "Selected row has been deleted, refresh to view change", "success");
							
							if(isajax) {
								var info = (datatable.page != undefined) ? datatable.page.info() : null;
								datatable.ajax.reload(null,true);
								datatable.page(info.page).draw(false);
							} else {
								setTimeout(function(){
									location.reload();
								},2000);
							}
						} else {
							swal("Failed!", "Selected row fail to be deleted, try again later !", "error");
						}	
					},
					error : function(e) {
						console.log(e);
						swal("Error!", "Unknown error occured, try again later !", "error");
					}
				});
				return false;
			}
		});	

		return false;
	});	
}

function deleteListenerSpecial() {
	$(".deletetrigger-special").off();
	$(".deletetrigger-special").click(function(){
		var ctx = $(this);
		swal({
			title: "Are you sure ?",
			text: "You will not be able to recover this row!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",	
			confirmButtonText: "Yes, delete it!",
			cancelButtonText: "Cancel",
			closeOnConfirm: false,
			closeOnCancel: true
		},
		function(isConfirm){
			if (isConfirm) {
				var tbl = ctx.data('table');
				var typ = ctx.data('type');
				var prm = ctx.data('param');
				var ids  = ctx.data('ids');

				$.ajax({
					type : 'post',
					data : {table:tbl,param:prm,iddata:ids},
					url  : baseurl+'dashboard/delete/'+typ,
					dataType : 'json',
					success : function(d) {
						console.log(d);
						if(d.code == 200) {
							swal("Deleted!", "Data has been deleted, refresh to view change", "success");
							
							setTimeout(function(){
								location.reload();
							},2000);
							
						} else {
							swal("Failed!", "Selected row fail to be deleted, try again later !", "error");
						}	
					},
					error : function(e) {
						console.log(e);
						swal("Error!", "Unknown error occured, try again later !", "error");
					}
				});
				return false;
			}
		});	

		return false;
	});	
}

function confirmPopup() {
	$(".confirm-action").off('click');
	$(".confirm-action").click(function(){
		var href = $(this).prop('href');
		swal({
			title: "Are you sure ?",
			text: "You wont be able to undo this action!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",	
			confirmButtonText: "Yes, I Confirm!",
			cancelButtonText: "Cancel",
			closeOnConfirm: true,
			closeOnCancel: true
		},
		function(isConfirm){
			if (isConfirm) {
				location.href = href;
			}
		});

		return false;
	});
}

function confirmPopupAjax() {
	$(".confirm-ajax").off('click');
	$(".confirm-ajax").click(function(){
		var _self = $(this),
			tmp = _self.html(),
			href = $(this).data('action');

		swal({
			title: "Are you sure ?",
			text: "You wont be able to undo this action!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",	
			confirmButtonText: "Yes, I Confirm!",
			cancelButtonText: "Cancel",
			closeOnConfirm: true,
			closeOnCancel: true
		},
		function(isConfirm){
			if (isConfirm) {
				_self.html('<i class="fa fa-spinner fa-spin"></i>');
				$.ajax({
					type : 'post',
					url : href,
					dataType : 'json',
					success : function(d) {
						_log(d)
						_self.html(tmp);
						if(d.code == 200) {
							swal('Yeah',d.msg,'success');
							if(typeof d.directurl !== 'undefined') {
								setTimeout(function(){
									location.href = d.directurl;
								},3000);
							} else {
								setTimeout(function(){
									location.reload();
								},3000);
							}
						} else {
							swal('Ops',d.msg,'error');
						}
					},
					error : function(e) {
						_log(e);
						swal('Ops','Unknown error occured !','error');
						_self.html(tmp);
					}
				});
			}
		});

		return false;
	});
}

function _log(data) {
	console.log(data);
}

$(document).ready(function(){
	confirmPopupAjax();
	deleteListenerSpecial();

	$( ".datepicker" ).datepicker({ 
							dateFormat: 'yy-mm-dd',
							minDate: 0 
						});
	$(".timepicker").timepicker({
							timeFormat: 'HH:mm:ss'
						});

	$( ".datetimepicker" ).datepicker({ 
							dateFormat: 'yy-mm-dd 00:00:00',
							minDate: 0 
						});
	$( ".datetimepickerall" ).datepicker({ 
							dateFormat: 'yy-mm-dd 00:00:00'
						});

	$(".ajax-form-normal").submit(function(){
		var _self = $(this),
			_sbt = _self.find('.submit-btn'),
			tmp = _sbt.html();

		_sbt.html('<i class="fa fa-spinner fa-spin"></i>');

		$.ajax({
			type : 'post',
			url : $(this).attr('action'),
			data : $(this).serialize(),
			dataType : 'json',
			success : function(d) {
				_log(d)
				_sbt.html(tmp);
				if(d.code == 200) {
					swal('Yeah',d.msg,'success');
					if(typeof d.directurl !== 'undefined') {
						setTimeout(function(){
							location.href = d.directurl;
						},3000);
					} else {
						setTimeout(function(){
							location.reload();
						},3000);
					}
				} else {
					swal('Ops',d.msg,'error');
				}
			},
			error : function(e) {
				_log(e);
				swal('Ops','Unknown error occured !','error');
				_sbt.html(tmp);
			}
		});

		return false;
	});

	function readURL(input,image) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                image.attr('src', e.target.result);
                image.addClass('on');
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    function removeMultiImageBox() {
    	$(".box-image").find('.remove').off('click');
    	$(".box-image").find('.remove').click(function(){
    		var parent = $(this).parent();
    		var relid = $(parent.data('relid'));

    		relid.remove();
    		parent.remove();
    	});
    }

	function initLoader() {
		$(".box-upload").find('.upload-button').off('click');
		$(".box-upload").find('.upload-button').click(function(e){
			var _self = $(this).parent();
			var _img = _self.find('img');

			if($(this).hasClass('multi-uploader')) {
				//get variables 
				var name = $(this).data('name');
				var container = $($(this).data('container'));
				var width = $(this).data('width');
				var height = $(this).data('height');
				var counter = container.find('input[type=file]').length;
				var idobj = name+"-"+(counter+1);

				//create file input 
				container.find('.filepicker-container').append('<input type="file" name="'+name+'[]" id="'+idobj+'">');

				//trigger click
				$("#"+idobj).trigger('click');
				$("#"+idobj).change(function(){
					//create image box object
					var box = '<div class="box-image" style="width: '+width+';height: '+height+';" data-relid="#'+idobj+'"">'
	                		 +'<img id="'+idobj+'img'+'">'
	                		 +'<button class="remove" type="button"><i class="fa fa-trash"></i></button></div>';
					container.prepend(box)
					removeMultiImageBox();
					readURL(this,$("#"+idobj+'img'));
				});
			} else {
				_self.find('input.image-picker').trigger('click');
				_self.find('input.image-picker').change(function(){
					readURL(this,_img);
				});
			}
		});
	}

	initLoader();
	removeMultiImageBox();

	$(".submit-btn-file").click(function(){
		var _btn = $(this);
		var _rel = $(this).data('rel');
		var _temp = _btn.html();

		if($('.tinymce').length > 0) {
    		tinyMCE.triggerSave();
    	}
		
		$(_rel).ajaxForm({
			beforeSubmit: function(formData,jqForm,options) {
				_btn.html('<i class="fa fa-spinner fa-spin"></i>');
		    },
		    success: function(d,s) {
		        _log(d);
		        d = JSON.parse(d);
		        _btn.html(_temp);
						
				if(d.code == 200) {
					swal ( 'Yeay' ,  d.msg ,  'success' );
				} else {
					swal ( 'Ops' ,  d.msg ,  'error' );
				}

				if(d.code == 200) {
					if(typeof d.directurl !== 'undefined') {
						location.href = d.directurl;
					} else {
						if(typeof d.noreload === 'undefined') {
							setTimeout(function(){
								location.reload();
							},3000);
						}
					}
				}            
		    },
		    error: function(e) {
		        _log(e);
		        _btn.html(_temp);  				
		    }		          
		}).submit();

		return false;
	});

	$(".max-limit").find('input').on('keyup mousedown',function(){
		var p = $(this).parent();
		var max = p.find('.counter-left').data('max');
		var val = $(this).val();

		var counter = parseInt(max);
		counter -= val.length;
		if(counter > -1) {
			p.find('.counter-left').html(counter);
		}
		if(counter < 1) {
			var text = val.substr(0,max)
			$(this).val(text);
		}
		
	});

	function notify() {
		$(".notif-listener").each(function(){
			$.ajax({
				type : 'post',
				url: $(this).data('url'),
				data : {
					elid: $(this).attr('id')
				},
				dataType : 'json',
				success : function(d) {
					_log(d);
					$("#"+d.elid).html(d.count);
					if(d.count > 0) {
						$("#"+d.elid).addClass('on');
					} else {
						$("#"+d.elid).removeClass('on');
					}
				},
				error : function(e) {
					_log(e);
					$("#"+d.elid).html('0');
					$("#"+d.elid).removeClass('on');
				} 
			});
		});

		setTimeout(function(){
			notify();
		},3000);
	}

	notify();

	$(".action-story-listener").click(function(){
		var ctx = $(this);
		swal({
			title: "Are you sure ?",
			text: "Dont worry, You will be able to undo this action later",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",	
			confirmButtonText: "Yes, I Confirm!",
			cancelButtonText: "Cancel",
			closeOnConfirm: false,
			closeOnCancel: true
		},
		function(isConfirm){
			if (isConfirm) {
				var _action = ctx.data('action');
				var _id = ctx.data('id');

				$.ajax({
					type : 'post',
					url  : baseurl+'submission/update_action/'+_id+'/'+_action,
					dataType : 'json',
					success : function(d) {
						console.log(d);
						if(d.code == 200) {
							swal("Success!", "Your action has been successfully executed, page will be reloaded", "success");
							
							setTimeout(function(){
								location.reload();
							},2000);
							
						} else {
							swal("Failed!", "Fail to executed your action, try again later !", "error");
						}	
					},
					error : function(e) {
						console.log(e);
						swal("Error!", "Unknown error occured, try again later !", "error");
					}
				});
				return false;
			}
		});	

		return false;
	});	

	$("#show-widget-library").click(function(){
		$("#widget-options").slideDown(200);
		$("#hide-widget-library").show();
		$(this).hide();
	});
	$("#hide-widget-library").click(function(){
		$("#widget-options").slideUp(200);
		$("#show-widget-library").show();
		$(this).hide();
	});

	$(".panel-options").click(function(){
		var overlay = $(this).find('.overlay');
		overlay.html('<i class="fa fa-spinner fa-spin"></i> Adding');
		overlay.addClass('on');
		$.ajax({
			type : 'post',
			url : baseurl+'pages/add_widget',
			data : {
				pageid: $(this).data('id'),
				widget: $(this).data('widget')
			},
			dataType : 'json',
			success : function(d) {
				_log(d);
				overlay.html('+ Add This Widget');
				setTimeout(function(){
					overlay.removeClass('on');
				},1000);
				if(d.code == 200) {
					swal('Yeay',d.msg,'success');
					setTimeout(function(){
						location.reload();
					},3000);
				} else {
					swal('Ops',d.msg,'error');
				}
			},
			error : function(e) {
				_log(e);
				overlay.html('+ Add This Widget');
				swal('Ops','Unknown error occured','error');
				setTimeout(function(){
					overlay.removeClass('on');
				},1000);
			}
		});

		return false;
	});

	$(".prior-action").click(function(){
		var _self = $(this),
			_sbt = _self.html();

		_self.html('<i class="fa fa-spinner fa-spin"></i>');
		
		$.ajax({
			type : 'post',
			url : baseurl+'pages/move_position',
			data : {
				id: _self.data('id'),
				direction: _self.data('move')
			},
			dataType : 'json',
			success : function(d) {
				_log(d);
				_self.html(_sbt);

				if(d.code == 200) {
					location.reload();
				} else {
					swal('Ops','Fail to move selected widget','error');
				}
			},
			error : function(e) {
				_log(e);
				_self.html(_sbt);
				swal('Ops','Unknown error occured','error');
			}
		})

		return false;
	});

	$(".custom-options").find('.opt').click(function(){
		var p = $(this).parent();
		p.find(".opt").removeClass('active');

		$(this).addClass('active');
		$(".custom-option-content").find('.opt-item').hide();
		$($(this).data('trigger')).show();

		p.find('input.default').val($(this).data('value'));

		return false;
	});

	$(".color-container").find('.color-item').click(function(){
		var p = $(this).parent();
		var i = p.find('input.color-value');

		p.find('.color-item').removeClass('active');
		$(this).addClass('active');

		i.val($(this).data('value'));
	});

	$(".else-color").blur(function(){
		var p = $(this).parent().parent();
		var p2 = p.parent();
		var i = p2.find('input.color-value');

		if($(this).val() == '') {
			return false;
		}

		i.val($(this).val());

		p2.find('.color-item').removeClass('active');
		p.addClass('active');
		p.find('.pallete').css({'background-color':$(this).val()});
	});

	$(".lists-listener").each(function(){
		$(this).html('<option>Loading Option...</option>');

		var _id = $(this).prop('id'),
			_type = $(this).data('set'),
			_value = $(this).data('value');;

		$.ajax({
			type : 'post',
			url : baseurl+'pages/get_lists',
			data : {
				element_id : _id,
				type : _type,
				data_exist : _value
			},
			dataType : 'json',
			success : function(d) {
				_log(d);

				var html = '';
				for(var i = 0; i < d.lists.length; i++) {
					var checked = (d.lists[i].selected == true) ? 'selected' : '';
					html += '<option value="'+d.lists[i].key+'" '+checked+'>'+d.lists[i].value+'</option>';
				}

				var obj = $("#"+d.element_id);
				obj.html(html);


			},
			error : function(e) {
				_log(e);
			}
		});
	});

	$(".change-option-listener").change(function(){
		if($(this).val() != '' || $(this).val() != 'all') {
			var _rel = $($(this).data('relation')),
				_additional_id = $(this).val(), 
				_id = _rel.prop('id'),
				_type = _rel.data('set'),
				_value = _rel.data('value');

		$.ajax({
			type : 'post',
			url : baseurl+'pages/get_lists',
			data : {
				element_id : _id,
				type : _type,
				parent_id : _additional_id,
				data_exist : _value
			},
			dataType : 'json',
			success : function(d) {
				_log(d);

				var html = '';
				for(var i = 0; i < d.lists.length; i++) {
					var checked = (d.lists[i].selected == true) ? 'selected' : '';
					html += '<option value="'+d.lists[i].key+'" '+checked+'>'+d.lists[i].value+'</option>';
				}

				var obj = $("#"+d.element_id);
				obj.html(html);


			},
			error : function(e) {
				_log(e);
			}
		});
		}
	});

		$(".show-reply").click(function(){
		var p = $(this).parent().parent();
		p.find('.reply-area').show();
		p.find('.button-area').hide();
		p.find('.reply-area').find('textarea').focus();
		return false;
	});
	$(".hide-reply").click(function(){
		var p = $(this).parent().parent().parent().parent();
		p.find('.reply-area').hide();
		p.find('.button-area').show();
		p.find('.reply-area').find('textarea').html('');
		return false;
	});

	$(".trigger-comment-delete").click(function(){
		var _id = $(this).data('id');
		var _self = $(this);
		var _temp = _self.html();
		var _target = $(this).data('target');

		swal({
			title: "Are you sure ?",
			text: "You will remove this comment from display",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",	
			confirmButtonText: "Yes, I Understand!",
			cancelButtonText: "Cancel",
			closeOnConfirm: false,
			closeOnCancel: true
		},
		function(isConfirm){
			if (isConfirm) {
				$.ajax({
					type : 'post',
					url : baseurl+_target+'/delete/'+_id,
					dataType : 'json',
					success : function(d) {
						console.log(d);
						if(d.code == 200) {
							swal ( 'Yeay' ,  'Comment has been removed, page will be reloaded' ,  'success' );
						} else {
							swal ( 'Ops' ,  'Fail to remove comment, try again' ,  'error' );
						}

						if(d.code == 200) {
							setTimeout(function(){
								location.reload();
							},3000);
							
						}
					},
					error : function(e) {
						console.log(e);
					}
				});
			}
		});

		return false;
	});



	$('.ajax-form').submit(function(e){
    	var _self = $(this);
    	var _sbt = _self.find('.submit-btn');
    	var tmp = _sbt.html();

    	if($('.tinymce').length > 0) {
    		tinyMCE.triggerSave();
    	}
    	
    	_sbt.html('<i class="fa fa-spinner fa-spin"></i>');
    	var valid_form = true;

    	_self.find('.required').each(function(){
    		var valid = true;
    		$(this).removeClass('error');

    		$(this).find('input').each(function(){
    			if($(this).val() == '') {
    				valid = false;
    			}
    		});
    		$(this).find('input[type=checkbox]').each(function(){
    			if($(this).prop('checked') == false) {
    				valid = false;
    			}
    		});
    		$(this).find('input[type=radio]').each(function(){
    			if($(this).prop('checked') == false) {
    				valid = false;
    			}
    		});
    		$(this).find('textarea').each(function(){
    			if($(this).val() == '') {
    				valid = false;
    			}
    		});

    		$(this).find('select').each(function(){
    			if($(this).val() == '') {
    				valid = false;
    			}
    		});

    		if(!valid) {
    			$(this).addClass('error');
    			valid_form = false;
    		}
    	});

    	console.log($(this).attr('action'));

    	if(!valid_form) {
    		$("html,body").animate({scrollTop:0},500);
    		_sbt.html(tmp);
    		swal('Ops','Complete form correctly','error');
    		return false;
    	}

    	$.ajax({
    		type : 'POST',
    		url : $(this).attr('action'),
    		data : $(this).serialize(),
    		dataType : 'json',
    		success : function(d) {
    			console.log(d);

    			_sbt.html(tmp);
    			$("html,body").animate({scrollTop:0},500);

    			if(d.code == 500) {
    				swal('Ops',d.msg,'error');
    			} else {
    				swal('Yeay',d.msg,'success');

    				setTimeout(function(){
	    				location.reload();
	    			},3000);
    			}

    			
    		},
    		error : function(e) {
    			console.log(e);
    			_sbt.html(tmp);
	    		swal('Ops','Unknown error occured','error');
    		}
    	});

    	return false;
    });

    $("#add-segment").click(function(){
    	var counter = $("#extend-content").find('.item').length;
    	var temp = $("#template-segment").html();
    	
    	counter += 1;
    	temp = temp.replace(/NUM/g, counter);

		$("#extend-content").append(temp);   
		
		initLoader();
		removeMultiImageBox(); 	

    });

    tinymce.init({
	      selector: 'textarea.tinymce',
	      relative_urls: false,
	      theme: 'modern',
	      menubar: false,
	      height: "800",
	      plugins: [
	      			' textcolor',
	      			'autolink lists link charmap print preview anchor code'
	      		   ],
	      toolbar: 'undo redo | bold italic underline blockquote | forecolor backcolor | formatselect | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent |  link | code',
	      image_advtab: true ,       
	      filemanager_title:'Responsive Filemanager' ,
		  content_style: "blockquote {background: #f8f8f8;width: 92%;border-left:solid 3px #f0f0f0qaa;padding: 10px 3%;text-align: left;margin:10px 0;}"
	});

	$(".tinymce-content").click(function(){
		tinyMCE.triggerSave();
	});
});