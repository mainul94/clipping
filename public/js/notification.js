/**
 * Created by root on 11/27/16.
 */
class Notification {
	constructor(args) {
		this.args =args || {};
		this.$wrapper = $(typeof this.args.parent !=="undefined" ?this.args.parent:'#notification');
		this.make();
	}
	make() {
		this.$wrapper.html(null);
		this.$notifyLink = $('<a href="javascript:;" class="dropdown-toggle info-number"' +
			' data-toggle="dropdown" aria-expanded="false"> <i class="fa fa-envelope-o"></i>' +
			'<span class="badge bg-green">0</span>' +
			'</a>').appendTo(this.$wrapper);
		this.$count_html = this.$notifyLink.find('span.badge');
		this.make_list_wrapper();
	}
	make_list_wrapper(){
		var me = this;
		this.$listWrapper = $('<ul class="dropdown-menu list-unstyled msg_list" role="menu">').appendTo(this.$wrapper);
		this.$mark_all_read_all = $('<a>Mark as all Read</a>').appendTo(this.$listWrapper).on('click',function () {
			me.ajax_nofication_update({
				all: true
			}, function (r) {
				me.set_count_value(0);
				me.$listWrapper.find('li.unread').removeClass('unread')
			});
		});
		this.get_notifications();
	}
	get_notifications(){
		var me = this;
		this.call_notifications(function (r) {
			for (var i in r) {
				$.extend(r[i],r[i].data);
				delete r[i].data
				me.add_notification(r[i])
			}
		});
	}
	add_notification(data){
		var me = this;
		// Add Item
		this.$itemWrapper = $('<li>').prependTo(this.$listWrapper).attr('data-id',data.id);
		if (!data.read_at) {
			this.$itemWrapper.addClass('unread');
			// Update counter
			this.update_count();
		}
		this.$item = $('<a>').appendTo(this.$itemWrapper).addClass('item');
		this.$item.attr('href',data.action || '#');
		if (data.avatar) {
			this.$item.append('<span class="user-profile"><img src="'+data.avatar+'" alt="Avatar" /></span>')
		}
		this.$item.append('<span>'+(data.title  || "")+'</span>'+
			'<p>'+(data.message || "") + (data.image?'<span class="image"><img class=" pull-right" src="'+data.image+'" alt="Image" /></span>':'')+
			'</p>');
		this.$item.attr('title', 'Go to Details');

		this.$item.on('click', function () {
			var e = $(this).siblings('a.mark-as-read');
			me.set_as_mark(e);
		});

		this.$markAsRead = $('<a>').addClass('mark-as-read').appendTo(this.$itemWrapper);
		if (!data.read_at) {
			this.$markAsRead.html('<i class="fa fa-circle" aria-hidden="true"></i>').attr('title','Mark as Read')
		}else {
			this.$markAsRead.html('<i class="fa fa-circle-o" aria-hidden="true"></i>').attr('title','Mark as Unread')
		}
		this.$markAsRead.on('click', function () {
			me.set_as_mark(this);
			return false
		});
	}
	update_count(plus){
		var value = parseInt(this.$count_html.html()) || 0;
		if (typeof plus !== "undefined") {
			value += plus
		}else
		{
			value++
		}
		this.set_count_value(value)
	}
	set_count_value(value){
		if (value > 0) {
			this.$count_html.removeClass('bg-green').addClass('bg-red')
		}else
		{
			this.$count_html.addClass('bg-green').removeClass('bg-red')
		}
		this.$count_html.html(value)
	}
	set_as_mark(e) {
		var $itemWrapper = $(e).closest('li');
		if ($itemWrapper.hasClass('unread')) {
			$itemWrapper.removeClass('unread');
			$(e).attr('title','Mark as Unread').children('i.fa').removeClass('fa-circle').addClass('fa-circle-o');
			this.update_count(-1);
			this.ajax_nofication_update({
				id:$itemWrapper.attr('data-id')
			})
		}else {
			$itemWrapper.addClass('unread');
			$(e).attr('title','Mark as Read').children('i.fa').removeClass('fa-circle-o').addClass('fa-circle');
			this.update_count();
			this.ajax_nofication_update({
				id:$itemWrapper.attr('data-id'),
				mark_as:'Unread'
			})
		}
	}
	ajax_nofication_update(data,callback) {
		$.ajax({
			url: '/notification',
			method:'POST',
			data:data,
			success:function (r) {
				console.log(r);
				if (callback) {
					callback(r)
				}
			}
		});
	}
	call_notifications(callback) {
		$.ajax({
			url: '/notification',
			method:'GET',
			success:function (r) {
				callback(r);
			}
		});
	}

}
Window.Notify = new Notification();
//# sourceMappingURL=notification.js.map
