<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/19/16
 * Time: 6:00 PM
 */?>

<script src="{!! asset('js/dropzone.js') !!}"></script>
<script>
	class MiMedia {
		constructor (args){
			this.args = args || {};
			if (this.args.data.root.charAt(0)=='/') {
				this.args.data.root = this.args.data.root.substring(1);
			}
			this.root = this.args.data.root;
			this.$selector = $(this.args.selector || '.init-media');
			this.setup();
		}
		setup (data) {
			var root = this.args.data.root;
			if (typeof data !== 'undefined') {
				root = data.root;
			}
			this.$selector.html(null);
			this.$wrapper = $('<div>').addClass('mi-media-wrapper').appendTo(this.$selector);
			this.$wrapper.attr({
				'data-root': root
			});
			this.notification_message();
			this.init_dropzone();
			this.wrapper_context_menu();
			this.init_breadcrumb(data);
			this.init_folder_section();
			this.init_file_wrapper();
			this.call_data_from_root(data);
			this.make_create_folder();
			this.make_rename_folder();
		}
		notification_message() {
			var me = this;
			this.$notification = {};
			this.$notification.$wrappwer = $('<ul class="notification-wrapper">').appendTo(document.body).hide();
			this.$notification.$header = $('<li class="header">')
					.appendTo(this.$notification.$wrappwer);
			this.$notification.$header.helptext = $('<span>').appendTo(this.$notification.$header);
			this.$notification.$header.$closeBtn = $('<a href="javascript:void(0)"  class="pull-right">' +
					'<i class="fa fa-close" aria-hidden="true"></i></a>').appendTo(this.$notification.$header)
					.on('click', function () {
						me.$notification.$wrappwer.hide();
					});
			this.$notification.$header.$minOrReBtn = $('<a href="javascript:void(0)" class="pull-right">' +
					'<i class="fa fa-chevron-down" aria-hidden="true"></i></a>').appendTo(this.$notification.$header)
					.on('click', function () {
						var $parent = $(this).closest('li.header');
						$parent.toggleClass('minimize');
						if ($parent.hasClass('minimize')) {
							$(this).find('i.fa').removeClass('fa-chevron-down').addClass('fa-chevron-up')
						}else {
							$(this).find('i.fa').addClass('fa-chevron-down').removeClass('fa-chevron-up')
						}
					});
			this.$notification.$body = $('<li><ul class="notification-body"><li>').appendTo(this.$notification.$wrappwer);
			this.$notification.previewTemplate = '<li class="dz-preview dz-file-preview">' +
					'<img data-dz-thumbnail /><span data-dz-name></span>' +
					'<span data-dz-size></span>' +
					'<span class="dz-success-mark"><i class="fa fa-check" aria-hidden="true"></i></span>' +
					'<span class="dz-error-mark"><i class="fa fa-close" aria-hidden="true"></i></span>' +
					'<div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div></li>';

		}
		init_dropzone($wrapper) {
			var me = this;
			if (typeof $wrapper === 'undefined') {
				$wrapper = this.$wrapper;
			}
			$wrapper.$overWrapper = $('<div class="drags">').prependTo(me.$wrapper).hide();
			$wrapper.dropzone({
				url: me.args.image_upload_url,
				previewTemplate:me.$notification.previewTemplate,
				previewsContainer: '.notification-body',
				uploadMultiple:true,
				paramName: "images",
				headers: {
					'X-CSRF-TOKEN': "{{ csrf_token() }}"
				},
				drop:function () {
					$wrapper.$overWrapper.hide();
				},
				dragenter:function () {
					$wrapper.$overWrapper.show();
				},
				sendingmultiple:function (file) {
					console.log(file)
				},
				sending:function (file, xhr, formData) {
					me.$notification.$wrappwer.show();
					me.$notification.$header.helptext.html('Uploading...');
					formData.append("root", $wrapper.attr('data-root'));
				},
				success:function (file) {
					$(file.previewElement).addClass('alert-success')
							.find('.dz-error-mark').hide();
				},
				error:function (file) {
					$(file.previewElement).addClass('alert-danger')
							.find('.dz-success-mark').hide();
				},
				complete:function (file) {
					$(file.previewElement).find('.dz-upload').css("background", 'transparent');
				},
				queuecomplete:function () {
					console.log('Uncommend below line if you want to see files');
					me.$notification.$header.helptext.html('Uploaded');
//					me.open_folder(me.$wrapper)
				},
				uploadprogress: function(file, progress, bytesSent) {
					$(file.previewElement).find('.dz-upload').html(progress.toFixed(2)+' %').css("width", progress.toFixed(2)+'%');
				}
			});

		}
		make_create_folder() {
			var me = this;
			this.$createFolder = new PopModel({
				modal_options:{
					show:false
				}
			});
			this.$createFolder.add_field({
				fieldname:'new_folder',
				fieldtype:'text',
				label:'Folder Name'
			});
			this.$createFolder.set_value('new_folder','New Folder');
			this.$createFolder.set_primary_button('Create', function (btn, obj) {
				me.post_new_folder();
//				me.$createFolder.hide();
			})
		}
		make_rename_folder(){
			var me = this;
			this.$renameFolder = new PopModel({
				modal_options:{
					show:false
				}
			});
			this.$renameFolder.add_field({
				fieldname:'rename_folder',
				fieldtype:'text',
				label:'New Name'
			});
			this.$renameFolder.set_primary_button('Rename', function () {
				me.ajax_for_folder({
					'folder_name':MiMedia.basename(me.$renameFolder.dir_root),
					'new_name':me.$renameFolder.get_value('rename_folder'),
					'root':me.$renameFolder.dir_root.substring(0, me.$renameFolder.dir_root.lastIndexOf("/")),
					'type':'Rename'
				})
			})
		}
		post_new_folder() {
			this.ajax_for_folder({
				'folder_name':this.$createFolder.get_value('new_folder'),
				'root':this.$wrapper.attr('data-root'),
				'type':'New'
			})
		}
		delete_folder(root) {
			if (typeof root === 'undefined') {
				return
			}
			var me = this;
			swal({
				title: 'Are you sure?',
				text: "You won't be able to revert this!",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
			}).then(function() {
				me.ajax_for_folder({
					'root':root,
					'type':'delete'
				});
				var $audio = $('#sound-delete')[0];
				if ($audio.paused) {
					$audio.play();
				}else{
					$audio.currentTime = 0
				}
				swal(
						'Deleted!',
						'Your file has been deleted.',
						'success'
				);
			});
		}
		rename_directory($wrapper) {
			if (!$wrapper.attr('data-root')) {
				return
			}
			this.$renameFolder.dir_root = $wrapper.attr('data-root');
			this.$renameFolder.set_value('rename_folder', MiMedia.basename(this.$renameFolder.dir_root));
			this.$renameFolder.$dir = $wrapper;
		}
		ajax_for_folder(data, type) {
			var me = this;
			if (typeof type === 'undefined') {
				type = 'POST'
			}
			$.ajax({
				url:this.args.directory_url,
				type:type,
				data:data,
				success:function (r) {
					if (r.type == 'new') {
						me.initialize_directory(r.directory);
						me.$createFolder.hide();
					} else if (r.type == 'delete') {
						me.$folderWrapper.find('[data-root="'+r.directory+'"]').remove();
					} else if (r.type == 'rename') {
						me.$renameFolder.$dir.find('.folder-text span').html(data.new_name);
						me.$renameFolder.$dir.attr('data-root',r.to_dir);
						me.$renameFolder.hide();
					}
				}
			});
		}
		initialize_directory(directory) {
			var me = this;
			me.args.directory = directory;
			var $folder = new MiFolder(me.$folderWrapper,me.args,me.$folderTitle);
			$folder.$directoryWrapper.on('dblclick', function () {
				me.open_folder($(this));
			});
			$folder.$directoryWrapper.click(function (e) {
				if(!e.ctrlKey)
				{
					me.$wrapper.find('.selected').removeClass('selected');
				}
				$(this).toggleClass('selected');
			});
			me.directory_context_menu($folder.$directoryWrapper)
		}
		init_folder_section () {
			this.$folderTitle = $('<div>').addClass('section-title').appendTo(this.$wrapper).html('Folder');
			this.$folderWrapper = $('<div>').addClass('mi-folder-wrapper').appendTo(this.$wrapper)/*.selectable({
				filter: "div.mi-folder-sub-wrapper",
				disabled: true
			})*/;
		}
		init_file_wrapper () {
			this.$fileTitle = $('<div>').addClass('section-title').appendTo(this.$wrapper).html('File');
			this.$fileWrapper = $('<div>').addClass('mi-file-wrapper').appendTo(this.$wrapper);
		}
		call_data_from_root(data) {
			var me = this;
			var $jqXHR = $.ajax({
				url:this.args.index_url,
				data:data || this.args.data,
				dataType:'json'
			}).done(function (data) {
				if (data.directories.length) {
					$.each(data.directories, function (idx, directory) {
						me.initialize_directory(directory)
					});
				}else {
					me.$folderTitle.hide();
				}
				if (data.files.length) {
					$.each(data.files, function (idx, file) {
						me.args.file = file;
						var $file = new MiFile(me.$fileWrapper,me.args,me.$fileTitle);
						$file.$fileWrapper.on('dblclick', function () {
							alert("Please setup preview")
						});
						$file.$fileWrapper.click(function (e) {
							if(!e.ctrlKey)
							{
								me.$wrapper.find('.selected').removeClass('selected');
							}
							$(this).toggleClass('selected');
						})
					});
				}else {
					me.$fileTitle.hide();
				}
			}).fail(function () {
//				console.log('Faild')
			}).always(function () {
//				console.log('FIrst Complete')
			});

			$jqXHR.always(function () {
//				console.log('Cansel')
			})
		}
		static basename (value){
			return new String(value).substring(value.lastIndexOf('/') + 1);
		}
		init_breadcrumb(data) {
			var root;
			if (typeof data !== 'undefined') {
				root = data.root
			}else
			{
				root = this.args.data.root;
			}
			this.$bradecome = $('<ol class="breadcrumb">').appendTo(this.$wrapper);
			this.set_breadcrumb(root);
		}
		set_breadcrumb (root) {
			root = root || this.args.data.root;
			var me = this;
			root = root.replace(this.root,'').split('/');
			var tmp_root = this.args.data.root;
			this.$bradecome_item = $('<li data-root="'+tmp_root+'"></li>').html('<a href="javascript:void(0)">Root</a>');
			this.$bradecome_item.on('click', function () {
				me.open_folder($(this));
			});
			this.$bradecome.html(this.$bradecome_item);
			$.each(root, function (key, val) {
				if (val === "" || val === 'undefined') {
					return
				}
				tmp_root +='/'+val;
				if (key <root.length-1) {
					me.$bradecome_item =$('<li data-root="'+tmp_root+'"></li>').html('<a href="javascript:void(0)">'+val+'</a>');
				}else {
					me.$bradecome_item = $('<li class="active">'+val+'</li>')
				}
				me.$bradecome.append(me.$bradecome_item);
				me.$bradecome_item.on('click', function () {
					me.open_folder($(this));
				});

			});
		}
		open_folder ($wrapper){
			var me = this;
			if ($wrapper === 'undefined' || !($wrapper.attr('data-root'))) {
				return
			}
			me.$selector.html(null);
			me.setup({
				root:$wrapper.attr('data-root')
			});
		}
		wrapper_context_menu() {
			var me = this;
			$.contextMenu({
				selector:'.mi-media-wrapper:eq('+this.$wrapper.index()+')',
				items: {
					new_folder: {
						name: "New Folder",
						icon:"fa-folder",
						callback: function(key, opt){
							me.$createFolder.show();
							me.$createFolder.set_title('New Folder')
						}
					},
					upload: {
						name: "Upload",
						icon:"fa-cloud-upload",
						callback: function(key, opt){
							me.$wrapper.trigger('click');
						}
					}
				}
			});
		}
		directory_context_menu($wrapper) {
			var me = this;
			$.contextMenu({
				selector:'.mi-folder-sub-wrapper:eq('+$wrapper.index()+')',
				items: {
					open_direct: {
						name: "Open Folder",
						icon:"fa-folder-open",
						callback: function(key, opt){
							me.open_folder($(this));
						}
					},
					rename_direct: {
						name: "Rename Folder",
						icon:"fa-edit",
						callback: function(key, opt){
							me.$renameFolder.show();
							me.rename_directory($wrapper);
						}
					},
					delete_direct: {
						name: "Delete Folder",
						icon:"fa-trash",
						callback: function(key, opt){
							me.delete_directory($wrapper);
						}
					}
				}
			});
		}

		delete_directory($wrapper) {
			var me = this;
			if ($wrapper.hasClass('selected')) {
				$wrapper.siblings('.selected').each(function (idx, el) {
					me.delete_folder($(el).attr('data-root'))
				})
			}else {
				me.delete_folder($wrapper.attr('data-root'))
			}
		}

	}

	class FileUpload {
		constructor($miMedia) {
			if (typeof $miMedia !== 'object') {
				console.log('You must send a object that crated from MiMedia Class')
				return
			}
			this.parent = $miMedia
		}



	}


	class MiFolder {
		constructor($wrapper,args, $title, $object) {
			if (typeof $wrapper === 'undefined') {
				console.error('Parent Folder not declared')
			}
			this.$object = null;
			if (typeof $object !== 'undefined') {
				this.$object = $object;
			}
			this.args = args || {};
			this.$wrapper = $wrapper;
			if (this.args.is_new) {
				this.create_new_directory()
			}else if (this.args.directory) {
				this.make_directory()
			}
			if ($title.is(':hidden')) {
				$title.show()
			}
		}
		make_directory() {
			this.$directoryWrapper = $('<div>').addClass('mi-folder-sub-wrapper').appendTo(this.$wrapper)
					.attr('data-root',this.args.directory);
			var $html = '<div class="folder-icon">'+
					'<i class="fa fa-folder"></i>'+
					'</div>'+
					'<div class="folder-text">'+
					'<span>'+MiMedia.basename(this.args.directory)+'</span>'+
					'</div>';
			this.$directoryWrapper.html($html);

		}
		create_new_directory() {
			this.$modelWrapper = $()
		}
	}

	class MiFile {
		constructor($wrapper,args, $title) {
			if (typeof $wrapper === 'undefined') {
				console.error('Parent Folder not declared')
			}
			this.args = args || {};
			this.$wrapper = $wrapper;
			if (this.args.is_new) {
				this.create_new_file()
			}else if (this.args.file) {
				this.make_directory()
			}
			if ($title.is(':hidden')) {
				$title.show()
			}
		}
		make_directory() {
			this.$fileWrapper = $('<div>').addClass('mi-file-sub-wrapper').appendTo(this.$wrapper)
					// ToDo Need Ftp information from daynamically and also check error if ftp not set
					.html('<div class="thumbnail-image">\
							<img src="ftp://{{ auth()->user()->ftp->username }}:{{ auth()->user()->ftp->password."@".auth()->user()->ftp->host}}/'+this.args.file+'" alt="">\
					</div>\
					<div class="text">\
					<div class="folder-icon">\
					<i class="fa fa-picture-o" aria-hidden="true"></i>\
					</div>\
					<div class="folder-text">\
					\
					<span>'+MiMedia.basename(this.args.file)+'</span>\
					</div>\
					</div>')
					.attr('data-root',this.args.file);

		}
		create_new_file() {
//			Create New directory and then make.
		}
	}

	class PopModel {
		constructor (args) {
			this.args = args ||{};
			this.make();
		}

		make () {
			this.$wrapper = $('<div class="modal fade">');
			this.$wrapperContainer = $('<div class="modal-content">');
			this.$wrapper.html($('<div class="modal-dialog">').html(this.$wrapperContainer));
			this.set_up_header();
			this.setup_body();
			this.setup_footer();
			var modalOptions = null;
			if (typeof this.args.modal_options !== 'undefined') {
				modalOptions =  this.args.modal_options
			}
			this.$wrapper.modal(modalOptions);
		}
		set_up_header() {
			var me = this;
			this.$headerWrapper = $('<div class="modal-header">').appendTo(this.$wrapperContainer);
			this.$titleWrapper = $('<h4 class="modal-title"></h4>').appendTo(this.$headerWrapper);
			$('<button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>')
					.prependTo(this.$headerWrapper).on('click', function () {
					me.hide();
			});
		}
		set_primary_button(label, callback) {
			var me = this;
			if (typeof label === 'undefined') {
				label ="Saves"
			}
			this.$primary_btn = $('<button type="button" class="btn btn-primary">').html(label).on('click', function () {
				if (typeof callback === 'function') {
					callback(this,me)
				}
			}).appendTo(this.$footer);
		}

		set_title(title) {
			this.$titleWrapper.html(title);
		}
		setup_body() {
			this.$body = $('<div class="modal-body">').appendTo(this.$wrapperContainer)
		}
		setup_footer() {
			var me = this;
			this.$footer = $('<div class="modal-footer">').appendTo(this.$wrapperContainer);
			$('<button type="button" class="btn btn-default">Close</button>').prependTo(me.$footer).on('click', function () {
				me.hide();
			});
		}
		show() {
			this.$wrapper.modal('show')
		}
		hide() {
			this.$wrapper.modal('hide')
		}
		add_field(args) {
			if (typeof args !== "object") {
				console.log('args must be object');
				return
			}
			if (typeof args.fieldname === 'undefined') {
				console.warn('field name is mandatory to create field');
				return
			}
			var fieldname = args.fieldname;
			this[fieldname] = {};
			this[fieldname].df = args;
			this[fieldname].$wrapper = $('<div class="form-group">').appendTo(this.$body);
			this[fieldname].$label = $('<label>').appendTo(this[fieldname].$wrapper)
							.html(args.label).attr({"for": fieldname});
			if (['email', 'number', 'text', 'hidden', 'password', 'file', 'image'].indexOf(args.fieldtype) != -1) {
				this[fieldname].$input = $('<input>');
			}
			else if (args.fieldtype == 'select') {
				this[fieldname].$input = $('<select>');
			}else if(args.fieldtype == 'textarea') {
				this[fieldname].$input = $('<textarea>');
			}
			this[fieldname].$input.appendTo(this[fieldname].$wrapper);
			this[fieldname].$input.addClass('form-control').attr({
				'id':fieldname,
				'name': fieldname,
				'plaseholder': args.label
			});
			if (typeof args.input_data !== 'undefined' && typeof args.input_data === 'object') {
				this[fieldname].$input.attr(args.input_data)
			}
		}
		set_label (fieldname, label) {
			if (typeof fieldname === 'undefined') {
				console.warn('field name is mandatory to set Label in field');
				return
			}
			this[fieldname].$label.html(label)
		}
		set_value (fieldname, value) {
			if (typeof fieldname === 'undefined') {
				console.warn('field name is mandatory to set Value in field');
				return
			}
			this[fieldname].$input.val(value)
		}
		get_value (fieldname) {
			return this[fieldname].$input.val();
		}
	}
</script>
