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
	$(this.input).addClass('w-p_a-c-i_trans');

	// this.append = function(val){

	// 	if(self.input.value === '') return;
		
	// 	var n = document.createElement('div');
	// 		n.className = 'w-p_c-block';
	// 		n.innerHTML = val;

	// 		if(el.children[1])
	// 			el.insertBefore(n, el.children[1]);
	// 		else
	// 			el.appendChild(n);
			
	// 		self.input.value = '';
	// 		$(self.input).trigger('autosize.resize');
	// }

	this.input.onclick = function(e){
		var self = this;
		e.stopPropagation();
		var btn = this.parentNode.getElementsByClassName('submit-comment')[0];

		$(btn).fadeIn();

		document.onclick = function(){
				$(btn).fadeOut();
		}
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
					$(txts[i])
					.autosize()
					.addClass('w-p_a-c-i_trans')
					.click(function(e){
						var self = this;
						e.stopPropagation();
						var btn = this.parentNode.getElementsByClassName('submit-comment')[0];
						$(btn).fadeIn();

						document.onclick = function(){
							self.value = '';
							$(self).trigger('autosize.resize');
							$(btn).fadeOut();
						}
					})
				}
			}
		});
		wall.postsToLoad+=5;
}

function load_more_comments(el){
	el.parentNode.getElementsByClassName('load-more-comments-block')[0].style.display = 'block';
	el.style.display = 'none';
}

if (!String.prototype.trim) {
  String.prototype.trim = function () {
    return this.replace(/^\s+|\s+$/g, '');
  };
}


function delete_post(h, id, el){
	var e = event || window.event;

	e.stopPropagation();

	var post = el.parentNode.parentNode;
	var con = post.getElementsByClassName('w-p_remove-container')[0];

	var yes = con.getElementsByClassName('w-p_rm-yes')[0];
	var no = con.getElementsByClassName('w-p_rm-no')[0];

	con.fadeIn();

	document.onclick = function(){
		con.fadeOut();

		this.onclick = null;
	}

	yes.onclick = function(){
		var e = event || window.event;
		e.stopPropagation();
		con.fadeOut();
		
		ajax('post', 'delete-post', {hash:h, id:id}, function(r){
			// console.log(r);
			post.parentNode.removeChild(post);
		});

		this.onclick = null;
	}

	no.onclick = function(){
		var e = event || window.event;
		e.stopPropagation();
		con.fadeOut();

		this.onclick = null;
	}
}

function delete_comment(h, id, el){
	var toDel = el.parentNode.parentNode;

	ajax('post', 'delete-comment', {hash:h, id:id}, function(r){
		toDel.parentNode.removeChild(toDel);
	});
}

// function edit_post(h, id, el){
// 	var head = el.parentNode.parentNode.getElementsByClassName('w-p_header')[0];
// 	var content = el.parentNode.parentNode.getElementsByClassName('w-p_content')[0];
// 	$(head).hide();
// 	$(content).hide();


// 	// ==========================================
// 		var	inn = content.innerHTML;
// 		var main = document.createElement('div');
// 		main.classList.add('w-p_edit-post');

// 		var eHead = document.createElement('textarea');
// 		eHead.classList.add('w-p_e-p_header');
// 		eHead.value = head.innerHTML.trim().replace(/\s{2,}/g, '');

// 		var eContent = document.createElement('textarea');
// 		eContent.classList.add('w-p_e-p_content');
// 			inn = inn.trim();
// 			inn = inn.replace(/<br\s*\/?>/mg,"\n");
// 		eContent.value = inn;

// 		main.appendChild(eHead);
// 		main.appendChild(eContent);
// 	// ==========================================

// 	head.parentNode.insertBefore(main, head);

// }