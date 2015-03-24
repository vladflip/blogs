var admin = (function(){

	var deletePost = function(id, el){
		var res = confirm('Точно удалить этот пост и все его коменты\\лайки?', 'asdf');

		if(res){
			ajax('post', 'http://localhost/blogs/public/admin-delete-post', {id:id}, function(r){
				if(r == 'ok'){
					$(el).parent().parent().remove();
				}
			});
		}
	}

	var banUser = function(id, el){
		var ban = false;
		if($(el).parent().parent().hasClass('banned'))
			ban = true;

		if(ban)
			var res = confirm('Убрать этого человека из бана?');
		else
			var res = confirm('Отправить этого юзера в бан?');

		if(res){
			ajax('post', 'http://localhost/blogs/public/admin-ban-user', {id:id}, function(r){
				if(r == 'ok'){
					if(ban){
						$(el).parent().parent().removeClass('light');
						$(el).html('Бан');
					} else {
						$(el).parent().parent().addClass('light');
						$(el).html('Разбан');
					}
				}
			});
		}
	}

	var attach = function(id, el){
		alert(id);
	}

	return {
		deletePost : deletePost,
		banUser : banUser,
		attach : attach
	}
})();