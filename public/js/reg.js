function loadAnim(path){
	var self = this;
	var el = document.querySelector(path + ' .load-icons');
	var id;

	this.pics = {'load' : el.getElementsByClassName('load')[0], 
				'fail' : el.getElementsByClassName('fail')[0], 
				'success' : el.getElementsByClassName('success')[0]};

	this.active = 'load';

	this.displ = function(dis){
		// if(self.active === dis && dis !== 'load') return;
		self.pics[self.active].style.display = 'none';

		self.pics[dis].style.display = 'block';
		self.active = dis;
	}

	this.load = function(){
		clearInterval(id);

		self.displ('load');

		id = setTimeout(function(){
			self.fail();
		}, 1500);
	}

	this.fail = function(){
		self.displ('fail');
	}

	this.success = function(){
		clearInterval(id);
		self.displ('success');
	}
}




// ************************************************reg

function checkInput(f,s){
	return f.value === s.value;
}

function panel(form,btn){
	var self = this;
	this.form = form.form;
	this.btn = document.getElementById(btn);
	
	this.popUp = new popUp();

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

	if(form === 'sign-up-form'){

		this.email = document.getElementsByClassName('email-input')[0];
		this.pass1 = document.getElementsByClassName('pass1-input')[0];
		this.pass2 = document.getElementsByClassName('pass2-input')[0];

		this.email_anim = new loadAnim('.email');
		this.pass1_anim = new loadAnim('.pass1');
		this.pass2_anim = new loadAnim('.pass2');

		this.email.onkeyup = function(){
			ajax('post', 'ajax-check-email', this.value, function(msg){
				// console.log(JSON.parse(msg));

				var res = JSON.parse(msg);
				if(res.type === 'fail'){
					self.email_anim.load();
				} else if(res.type === 'good'){
					self.email_anim.success();
					self.check = true;
				}
			});
		}

		this.pass1.onkeyup = function(){
			if(self.pass2.value === this.value){
				self.pass2_anim.success();
			} else {
				self.pass2_anim.fail();
			} 
		}

		this.pass2.onkeyup = function(){ /* _____TO DO load func while not matching passwords, then force fail or success*/
			if(self.pass1.value === this.value){
				self.pass2_anim.success();
			} else {
				self.pass2_anim.fail();
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

