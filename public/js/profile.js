function check_for_allow(){
	ajax('get', 'check-for-allow-posting', null, function(r){
		if(r.indexOf('not ready') !== -1){

		} else {
			var wall = document.getElementById('pWall');
			wall.innerHTML = '';
			var div = document.createElement('div');
			div.innerHTML = r;
			wall.appendChild(div);

			var script = document.createElement('script');
			script.src = 'js/add_post.js';

			document.body.appendChild(script);

		}
	})
}

function el(id){
	var self = this;
	var timer;

	this.load = new loadAnim('#' + id, true);
	this.load.el.style.top = '-10px';


	this.el = document.getElementById(id);
	this.label = this.el.parentNode.getElementsByClassName('p_label')[0];
	this.data = '';
	this.input = this.el.getElementsByTagName('input')[0];

	this.load.pen.onclick = function(){
		self.input.select();
	}

    Plugins.AutosizeInput.getDefaultOptions().space = 5;
	$(this.input).autosizeInput();

	this.ph = self.input.placeholder;

	function fails(){
		self.label.style.color = 'red';
	}

	this.edit = function(){
		clearInterval(timer);
		var el = self.input;

		var obj = {};
		self.data = el.value;

		self.load.load();
		obj[id] = el.value;
		timer = setTimeout(function(){
			ajax('post', 'edit-profile', obj, function(r){
				if(r!=='non'){
					self.load.success();
					check_for_allow();
				}
				else
					self.load.fail();
			});
		}, 600);
	}

	self.input.onkeyup = self.edit;

	self.input.onfocus = function(){
		this.placeholder = '';
	}
	self.input.onblur = function(){
		this.placeholder = self.ph;
	}
}

var edit_me = new (function(){
	
	this.f = {};

	this.f.pName = new el('pName');

	this.f.pAge = new el('pAge');

	// this.f.pBDay = new el('pBDay');

	this.f.pTown = new el('pTown');

	// this.pRate = new el('pRate');

	// this.pAbout = new el('pAbout');
})();

// ************************* mediator

// ************************** login

(function(){
	var el = document.getElementById('pLogin');
	var pen = el.getElementsByClassName('edit-pen')[0];


	var load = new loadAnim('#pLoginPopUp');
	var lpop = document.getElementById('pLoginPopUp');
	var input = lpop.getElementsByTagName('input')[1];
	var form = document.getElementById('editLoginForm');
	var submit = document.getElementById('sbmtLogin');

	var timer;

	pen.onclick = function(){
		var pop = new popUp(function(){
			input.value = '';
			load.reset();
		});

		pop.pop.appendChild(lpop);
		lpop.style.display = 'block';
		pop.open();
		input.focus();
	}

	lpop.onmousedown = function(e){
		e.stopPropagation();
	}

	var edit = function(){
		clearInterval(timer);
		submit.onclick = function(){
			return false;
		}
		var el = input;
		if(el.value === ''){
			load.reset();
			return;
		}

		var obj = {};

		load.load();
		obj['login'] = el.value;
		timer = setTimeout(function(){
			ajax('post', 'edit-login', obj, function(r){
				if(r==='non'){
					load.fail();
					submit.classList.remove('enabled');
					submit.classList.add('disabled');
				}
				else{
					submit.onclick = function(){
						form.submit();	
					}
					submit.classList.remove('disabled');
					submit.classList.add('enabled');
					load.success();
				}
			});
		}, 600);
	}

	input.onkeyup = edit;
})();

// ************************** LOGIN
// 
// **************************about

(function(){
	var el = document.getElementById('pAbout');
	var txt = el.getElementsByTagName('textarea')[0];
	$(txt).autosize();

	var cap = document.getElementsByClassName('p_about-cap')[0];
	var timer;
	var load = new loadAnim('#pAbout');

	var blur = false;

	cap.onclick = function(){
		this.style.display = 'none';
		txt.style.display = 'block';

		txt.value = txt.value.replace(/<br>/g, '\r\n');
		$(txt).trigger('autosize.resize');
		txt.focus();
	}

	txt.onblur = function(){
		cap.style.display = 'block';
		txt.style.display = 'none';

		// cap.innerHTML = txt.value;
		// txt.value = txt.value.replace(/\s{2,}/g, ' ');
		// txt.value = txt.value.replace(/<br>/, '\r\n');
		load.reset();
	}

	var edit = function(){
		clearInterval(timer);

		var obj = {};
		load.load();
		obj['pAbout'] = txt.value;
		timer = setTimeout(function(){
			ajax('post', 'edit-profile', obj, function(r){
				if(r!=='non'){
					load.success();
					setTimeout(function(){
						load.reset();
					}, 1000);
					check_for_allow();
				}
				else 
					load.fail();

				cap.innerHTML = r;
			});
		}, 600);
	}

	txt.onkeyup = edit;
})();

// **************************ABOUT



// ************************* avatar

var fileread = document.getElementById('pFileRead');
var imgPar = document.getElementById('imgPar');
var jcrop = document.getElementById('jCrop');
var imgin = document.getElementById('imgIn');
var openAva = document.getElementById('openAva');
var delete_ava_checker = false;
var avabtns = document.getElementById('pAvaBtns');
var sbmtava = document.getElementById('pSubmitAva');
var undoava = document.getElementById('pUndoAva');
var avacoords = {
	x : null,
	y : null,
	w : null,
	h : null
};
var avaEl = document.getElementById('avaEl');
var loadGif = new Image();
loadGif.src = 'img/load.gif';
loadGif.style.width = '150px';
loadGif.style.height = '150px';
loadGif.style.display = 'block';

function undo(){
		jcrop.innerHTML = '';
		imgPar.style.display = 'block';
		imgPar.innerHTML = 'Загрузить фото!';
		cropimage = null;
		openAva.value = '';
		imgPrev.src = '';
		if(delete_ava_checker){
			ajax('post', 'delete-ava', 'f');
			delete_ava_checker = false;
		}
		avabtns.fadeOut();
}

function panel(el,btn){
	var self = this;
	this.el = el;
	this.btn = document.getElementById(btn);
	
	this.popUp = new popUp(undo);

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

var paneProfile = new panel(fileread, 'pAvatar');


var previewDiv = document.createElement('div');
var imgPrev = new Image();

jcrop.onmousedown = function(e){
	e.stopPropagation();
}
imgPar.onmousedown = function(e){
	e.stopPropagation();
}
imgPar.onclick = function(e){
	e.stopPropagation();
	openAva.click();
	var imgH, imgW;

	openAva.onchange = function(){
		imgPar.innerHTML = 'Загрузка...';
		var dataf = new FormData(imgin);
		var cropimage = new Image();
		previewDiv.id = 'previewDiv';
		imgPrev.id = 'previewThumb';
		imgPrev.style.display = 'none';
		previewDiv.appendChild(imgPrev);
		jcrop.appendChild(previewDiv);


		function showPreview(c){
			var rx = 150 / c.w;
			var ry = 150 / c.h;

			// console.log(c.x + ' asdf ' + c.y + ' f ' + c.w + ' f ' + c.h);


			avacoords.x = c.x;
			avacoords.y = c.y;
			avacoords.w = c.w;
			avacoords.h = c.h;


			$('#previewThumb').css({
				display : 'block',
				width: Math.round(rx * imgW) + 'px',
				height: Math.round(ry * imgH) + 'px',
				marginLeft: '-' + Math.round(rx * c.x) + 'px',
				marginTop: '-' + Math.round(ry * c.y) + 'px'
			});
		}
		ajax('post', 'edit-ava', dataf, function(r){
			if(r !== 'non'){
				var res = JSON.parse(r);
				imgH = res.h;
				imgW = res.w;
				pAvaBtns.fadeIn();
				cropimage.src = res.path;
				cropimage.id = 'cropava';
			
				cropimage.onload = function(){
					imgPrev.src = res.path;
					imgPar.style.display = 'none';
					
					jcrop.appendChild(cropimage);
					// console.log(r);
					jQuery(function($) {
						$('#cropava').Jcrop({
							aspectRatio: 1,
							onChange: showPreview,
							onSelect: showPreview,
							setSelect: [imgW*0.25, imgH*0.07, imgW*0.75, imgH*0.75],
							minSize: [150,150]
						});
					});
					delete_ava_checker = true;

				}
			} else {
				console.log('fuck');
			}
		},true);
	}
}

sbmtava.onmousedown = function(e){
	var parav = document.getElementById('pAvatar');

	e.stopPropagation();
	ajax('post', 'submit-ava', avacoords, function(r){
		if(r !== 'non'){
			undo();

			paneProfile.popUp.close();
			avaEl.style.display = 'none';
			avaEl.style.opacity = 0;
			parav.appendChild(loadGif);

			setTimeout(function(){
				avaEl.src = r;
				avaEl.onload = function(){
					parav.removeChild(loadGif);
					avaEl.fadeIn();

					check_for_allow();
				}
			} , 400)
		}
	});
}
undoava.onmousedown = function(e){
	e.stopPropagation();
	undo();
}