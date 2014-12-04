if(document.getElementById('logOut')){
	document.getElementById('logOut').onclick = function(){
		document.getElementById('logOutForm').submit();
	}
}

// ***** LIKES

function like(h, id, e){

	var img = e.getElementsByTagName('img')[0];
	var cnt = parseInt(e.getElementsByClassName('cnt_likes')[0].innerHTML);
		if(isNaN(cnt)) return;

	if(img.src.indexOf('not_liked')!==-1){
		img.src = 'img/liked.png';
		img.style.display = 'block';
		e.getElementsByClassName('cnt_likes')[0].innerHTML = cnt + 1;

		ajax('get', 'like-post', {hash:h, id:id}, function(r){
			console.log(r);
		})
	} else {
		img.src = 'img/not_liked.png';
		e.getElementsByClassName('cnt_likes')[0].innerHTML = cnt - 1;

		ajax('get', 'dislike-post', {hash:h, id:id}, function(r){
			console.log(r);
		})
	}
	
}

// ***** LIKES