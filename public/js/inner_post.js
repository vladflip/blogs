$('#add-com-input').autosize();

var submitComment = document.getElementById('submitComment');
var textCmt = document.getElementById('add-com-input');

function submit_comment(h, id){

	if(textCmt.value === '') return;
	console.log('FUCTION CALLED');
	ajax('post', 'add-comment', {id: id, hash : h, val: textCmt.value}, function(r){
		console.log(r);
	});
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

		ajax('get', 'like-comment', {hash:h, id:id}, function(r){
			
		});
	} else {
		img.src = 'img/not_liked.png';
		e.getElementsByClassName('cnt_likes')[0].innerHTML = cnt - 1;

		ajax('get', 'dislike-comment', {hash:h, id:id}, function(r){
			
		});
	}
	
}

// ***** LIKES

var Wall = new function(){

	this.comments = [];

}