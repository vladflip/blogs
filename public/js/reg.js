
// ************************************************reg

function checkInput(f,s){
	return f.value === s.value;
}

function panel(form,btn){
	var self = this;
	this.form = form.form;
	this.btn = document.getElementById(btn);
	
	var undo = (function(form){
		return function undo(){
			if(document.getElementsByClassName('sign-up-form')[0])
				document.getElementsByClassName('sign-up-form')[0].reset();
			if(document.getElementsByClassName('login-form')[0])
				document.getElementsByClassName('login-form')[0].reset();
			var a = document.getElementsByClassName('load-icons');
			for(i=0;i<a.length;i++){
				var imgs = a[i].getElementsByTagName('img');
				for(j=0;j<imgs.length;j++){
					imgs[j].style.display = 'none';
				}
			}
		}
	})(self.form);
	this.popUp = new popUp(undo);

	this.init = function(){
		var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
		self.popUp.pop.style.marginTop = scrollTop + 'px';
		self.popUp.pop.appendChild(self.form);
		self.popUp.open();

		self.form.style.display = 'block';
	}

	window.onscroll = function(){
		var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
		self.popUp.pop.style.marginTop = scrollTop + 'px';
	}
	this.btn.onclick = this.init;
}

function form(form){

	var self = this;
	this.form = document.getElementsByClassName(form)[0];
	this.check = false;

	this.submit = this.form.getElementsByClassName('submit')[0];

	var timer;

	if(form === 'sign-up-form'){

		this.email = document.getElementsByClassName('email-input')[0];
		this.pass1 = document.getElementsByClassName('pass1-input')[0];
		this.pass2 = document.getElementsByClassName('pass2-input')[0];

		this.email_anim = new loadAnim('.email');
		this.pass1_anim = new loadAnim('.pass1');
		this.pass2_anim = new loadAnim('.pass2');

		this.email.onkeyup = function(){
					self.email_anim.load();
			ajax('post', 'ajax-check-email', this.value, function(msg){
				// console.log(JSON.parse(msg));

				var res = JSON.parse(msg);
				if(res.type === 'fail'){
					self.email_anim.fail();
				} else if(res.type === 'good'){
					self.email_anim.success();
					self.check = true;
				}
			});
		}

		this.pass1.onkeyup = function(){
			clearInterval(timer);
			if(self.pass2.value === '') return;
			if(self.pass2.value === this.value){
				self.pass2_anim.success();
			} else {
				timer = setTimeout(function(){
					self.pass2_anim.fail();
				}, 800);
			} 
		}

		this.pass2.onkeyup = function(){ /* _____TO DO load func while not matching passwords, then force fail or success*/
			clearInterval(timer);
			if(this.value === '') return;
			if(self.pass1.value === this.value){
				self.pass2_anim.success();
			} else {
				timer = setTimeout(function(){
					self.pass2_anim.fail();
				}, 800);
			}              
		}

		this.submit.onclick = function(e){
			e.preventDefault();

			if(checkInput(self.pass1, self.pass2) && self.check === true){
				self.form.submit();
			} else {

			}
		}
	}




	this.form.onmousedown = function(e){
		e.stopPropagation();
	}
}

// ************************************************REG

