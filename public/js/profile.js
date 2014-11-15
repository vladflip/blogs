function el(id){
	this.el = document.getElementById(id);
	this.data = '';
}

var edit_me = new (function(){
	
	this.f = {};

	/**
	 * login
	 */
	this.f.pLogin = new el('pLogin');

	/**
	 * fullname
	 */
	this.f.pFullName = new el('pFullName');

	/**
	 * age
	 */
	this.f.pAge = new el('pAge');

	/**
	 * birthday
	 */
	this.f.pBDay = new el('pBDay');

	/**
	 * town
	 */
	this.f.pTown = new el('pTown');
})();

var changer = new (function(){
	var self = this;

	/**
	 * [edit description]
	 * @return {void} [edits fields]
	 */
	this.edit = function(){
		var el = this;
		var timer;
		el.innerHTML = '';

		var input = document.createElement('input');
		el.appendChild(input);
		input.focus();

		input.onclick = function(e){
			e.stopPropagation();
		}
		input.onkeyup = function(){
			clearInterval(timer);

			edit_me.f[el.id].data = this.value;

			timer = setTimeout(function(){
				console.log('fuck');
			}, 1000);
		}

		
	}
	/**
	 * [release description]
	 * @return {result of sending} releases editing effect
	 */
	this.release = function(el){
		if(el){

		} else {
			for(e in edit_me.f){
				edit_me.f[e].onclick = changer.edit;
			}
		}
	}
})();


// ************************* mediator

for(e in edit_me.f){
	edit_me.f[e].el.onclick = changer.edit;
}

var fileread = document.getElementById('pFileRead');
var imgPar = document.getElementById('imgPar');
var jcrop = document.getElementById('jCrop');
var imgin = document.getElementById('imgIn');
var openAva = document.getElementById('openAva');

function panel(el,btn){
	var self = this;
	this.el = el;
	this.btn = document.getElementById(btn);
	
	this.popUp = new popUp(function(){
		jcrop.innerHTML = '';
		imgPar.style.display = 'block';
		imgPar.innerHTML = 'Загрузить фото!';
		cropimage = null;
		openAva.value = '';
	});

	this.init = function(){
		var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
		self.popUp.pop.style.marginTop = scrollTop + 'px';
		self.popUp.pop.appendChild(self.el);
		self.popUp.open();

		self.el.style.display = 'block';
	}

	window.onscroll = function(){
		var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
		self.popUp.pop.style.marginTop = scrollTop + 'px';
	}
	this.btn.onclick = this.init;
}

new panel(fileread, 'pAvatar');

jcrop.onclick = function(e){
	e.stopPropagation();
}
imgPar.onclick = function(e){
	e.stopPropagation();
	console.log(openAva.value);
	openAva.click();

	openAva.onchange = function(){
		imgPar.innerHTML = 'Загрузка...';
		var dataf = new FormData(imgin);
		var cropimage = new Image();	


		
		ajax('post', 'edit', dataf, function(r){
			imgPar.style.display = 'none';
			cropimage.src = r;
			cropimage.id = 'cropava';
			jcrop.appendChild(cropimage);

			jQuery(function($) {
		        $('#cropava').Jcrop();
		    });
		},true);
	}
}
