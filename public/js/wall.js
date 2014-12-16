

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
	this.content = el.getElementsByClassName('w-p_content')[0];

	if(self.content.clientHeight > 200){
		// self.content.style.height = '200px';
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
		var target;
		for(a in comments){
			if(comments[a].submit === el){
				target = comments[a];
			}
		}

		ajax('post', 'create-wall-comment', {id: id, hash : h, val: target.input.value}, function(r){

			if(r!=='non'){
				target.append(r);
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
			}
		});
		postsToLoad+=5;
	}

	if(loadMore)
	loadMore.onclick = load_more_posts;

	return {
		add:add,
		comments: comments
	};
})();


function like(h, id, e){

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