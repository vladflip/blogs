// -------------------------------------------
//	wall module
// -------------------------------------------

$('.a-p-content').autosize();

function comment(el){
	var self = this;
	this.add = el.getElementsByClassName('w-p_add-comment')[0];
	this.input = el.getElementsByClassName('w-p_a-c-input')[0];
	this.submit = el.getElementsByClassName('submit-comment')[0];

	$(this.input).autosize();

	this.append = function(val){

		if(self.input.value === '') return;
		
		var n = document.createElement('div');
			n.className = 'w-p_c-block';
			n.innerHTML = val;

			if(el.children[1])
				el.insertBefore(n, el.children[1]);
			else
				el.appendChild(n);
			
			self.input.value = '';
			$(self.input).trigger('autosize.resize');
	}

}

function readmore_post(el){
	el.style.display = 'none';
	el.parentNode.getElementsByClassName('s2')[0].style.display = '';
}

function post(el){
	var self = this;
	var cmtToLoad;
	this.content = el.getElementsByClassName('w-p_content')[0];

	if(el.getElementsByClassName('load-more-comments')[0]){
		this.load_more_comments = el.getElementsByClassName('load-more-comments')[0];

		function load_more_comments(){
			this.parentNode.getElementsByClassName('load-more-comments-block')[0].style.display = 'block';
			this.style.display = 'none';
		}

		this.load_more_comments.onclick = load_more_comments;
	}
		
}

var wall = (function(){
	var main = document.getElementsByClassName('w_posts')[0];
	var c = document.getElementsByClassName('w-p_comments-block');
	var comments = [];


	var postsToLoad = 5;

	var loadMore = document.getElementsByClassName('loadmore_post')[0];
	if(loadMore)
	var userId = loadMore.getElementsByTagName('input')[0].value;

	for(i=0;i<c.length;i++){
		comments.push(new comment(c[i]));
	}

	var p = document.getElementsByClassName('w-post');
	var posts = [];
	for(i=0;i<p.length;i++){
		posts.push(new post(p[i]));
	}


	
	function add(h, id, el){
		var input = el.parentNode.getElementsByTagName('textarea')[0];
		var target = input.value
		if(target === '') return;

		var cmt = el.parentNode.parentNode.parentNode;
		
		var n = document.createElement('div');
			n.className = 'w-p_c-block';
			
		ajax('post', 'create-wall-comment', {id: id, hash : h, val: target}, function(r){

			if(r!=='non'){
				n.innerHTML = r;
				if(cmt.children[1])
					cmt.insertBefore(n, cmt.children[1]);
				else
					cmt.appendChild(n);


				input.value = '';
				$(input).trigger('autosize.resize');
			}
			
		});
	}

	function load_more_posts(){
		ajax('post', 'load-more-posts', {cnt:postsToLoad,id:userId}, function(r){
			if(r.indexOf('no posts')!==-1){	
				loadMore.classList.add('no-posts');
				loadMore.onclick = null;
			} else {
				var span = document.createElement('span');
				span.innerHTML = r;
				main.appendChild(span);
				var txts = span.getElementsByTagName('textarea');
				for(var i=0; i<txts.length; i++){
					$(txts[i]).autosize();
				}
			}
		});
		postsToLoad+=5;
	}

	if(loadMore)
	loadMore.onclick = load_more_posts;

	return {
		add:add,
		comments: comments,
		postsToLoad : postsToLoad,
		main : main
	};
})();


function like_comment(h, id, e){

	var img = e.getElementsByTagName('img')[0];
	var cnt = parseInt(e.getElementsByClassName('cnt_likes')[0].innerHTML);
		if(isNaN(cnt)) return;

	if(img.src.indexOf('not_liked')!==-1){
		img.src = 'img/liked.png';
		img.style.display = '';
		e.getElementsByClassName('cnt_likes')[0].innerHTML = cnt + 1;

		ajax('get', 'like-comment', {hash:h, id:id}, function(r){
			console.log(r);
		});
	} else {
		img.src = 'img/not_liked.png';
		e.getElementsByClassName('cnt_likes')[0].innerHTML = cnt - 1;

		ajax('get', 'dislike-comment', {hash:h, id:id}, function(r){
			console.log(r);
		});
	}
	
}


function like_post(h, id, e){

	var img = e.getElementsByTagName('img')[0];
	var cnt = parseInt(e.getElementsByClassName('cnt_likes')[0].innerHTML);
		if(isNaN(cnt)) return;

	if(img.src.indexOf('not_liked')!==-1){
		img.src = 'img/liked.png';
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
function load_more_main(el){
	var loadMore = el;
	var main = document.getElementsByClassName('w-posts-main')[0];
	ajax('post', 'load-more-posts-main', {cnt:wall.postsToLoad}, function(r){
			if(r.indexOf('no posts')!==-1){	
				loadMore.classList.add('no-posts');
				loadMore.onclick = null;
			} else {
				var span = document.createElement('span');
				span.innerHTML = r;
				main.appendChild(span);
				var txts = span.getElementsByTagName('textarea');
				for(var i=0; i<txts.length; i++){
					$(txts[i]).autosize();
				}
			}
		});
		wall.postsToLoad+=5;
}