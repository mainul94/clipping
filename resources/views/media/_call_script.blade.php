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
			this.$selector = $(this.args.selector || '.init-media');
			this.setup();
		}
		setup () {
			this.$selector.html(null);
			this.$wrapper = $('<div>').addClass('mi-media-wrapper').appendTo(this.$selector);
			this.wrapper_context_menu();
			this.init_folder_section();
			this.init_file_wrapper();
			this.call_data_from_root()
		}
		init_folder_section () {
			this.$folderTitle = $('<div>').addClass('section-title').appendTo(this.$wrapper).html('Folder');
			this.$folderWrapper = $('<div>').addClass('mi-folder-wrapper').appendTo(this.$wrapper);
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
						new MiFolder(me.$folderWrapper,me.args,me.$folderTitle);
					});
				}else {
					me.$folderTitle.hide();
				}
				if (data.files.length) {
					$.each(data.files, function (idx, file) {
						me.args.file = file;
						new MiFile(me.$fileWrapper,me.args,me.$fileTitle);
					});
				}else {
					me.$fileTitle.hide();
				}
				console.log(data)
			}).fail(function () {
				console.log('Faild')
			}).always(function () {
				console.log('FIrst Complete')
			});

			$jqXHR.always(function () {
				console.log('Cansel')
			})
		}
		static basename (value){
			return new String(value).substring(value.lastIndexOf('/') + 1);
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
					.html('<div class="folder-icon">'+
							'<i class="fa fa-folder"></i>'+
							'</div>'+
							'<div class="folder-text">'+
							'<span>'+MiMedia.basename(this.args.directory)+'</span>'+
						'</div>'
					)
					.attr('data-root',this.args.directory);

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
					.html('<div class="thumbnail-image">\
							<img src="ftp://ftp1user:123456@localhost/'+this.args.file+'" alt="">\
					</div>\
					<div class="text">\
					<div class="folder-icon">\
					<i class="fa fa-picture-o" aria-hidden="true"></i>\
					</div>\
					<div class="folder-text">\
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
