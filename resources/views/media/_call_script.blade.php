<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/19/16
 * Time: 6:00 PM
 */?>
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
			this.$selector.html(null);
			this.$wrapper = $('<div>').addClass('mi-media-wrapper').appendTo(this.$selector);
			this.wrapper_context_menu();
			this.init_breadcrumb(data);
			this.init_folder_section();
			this.init_file_wrapper();
			this.call_data_from_root(data)
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
			$.contextMenu({
				selector:'.mi-media-wrapper:eq('+this.$wrapper.index()+')',
				items: {
					new_folder: {
						name: "New Folder",
						icon:"fa-folder",
						callback: function(key, opt){
							alert("Clicked on " + key);
						}
					},
					upload: {
						name: "Upload",
						icon:"fa-cloud-upload",
						callback: function(key, opt){
							alert("Clicked on " + key);
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
			if ($wrapper.hasClass('selected')) {

			}else {

			}
		}
		delete_file_dir (args, callback) {
			$.ajax(

			);

		}

	}


	class MiFolder {
		constructor($wrapper,args, $title) {
			if (typeof $wrapper === 'undefined') {
				console.error('Parent Folder not declared')
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
//			Create New directory and then make.
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
</script>
