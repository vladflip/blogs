HTMLElement.prototype.fadeIn = function(sec){
	var self = this;
	this.style.display = 'block';
		setTimeout(function(){
			self.style.opacity = 1;
		}, sec ? sec : 50);
}

HTMLElement.prototype.fadeOut = function(sec){
	var self = this;
	this.style.opacity = 0;
		setTimeout(function(){
			self.style.display = 'none';
		}, sec ? sec : 200);
}

function popUp(call){
	var self = this;
	var mup = false;
	
	this.pop = document.getElementById('popUp');

	this.open = function(){
		self.pop.fadeIn();
		document.getElementsByClassName('container')[0].fadeOut();
	}

	this.close = function(){
		document.getElementsByClassName('container')[0].fadeIn();
		self.pop.fadeOut();
		self.pop.innerHTML = '';
	}

	this.pop.onmousedown = function(){
		if(!mup){
			if(call) call();
			self.close();
		}
	}
}

function loadAnim(path){
	var self = this;
	this.el = document.querySelector(path + ' .load-icons');
	var el = this.el;
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
		self.displ('load');
	}

	this.fail = function(){
		self.displ('fail');
	}

	this.success = function(){
		self.displ('success');
	}
}


// **************************************************ajax

function ajax(method, url, data, callback, headers){

	function getXmlHttp(){
		var xmlhttp;
		try {
			xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (E) {
				xmlhttp = false;
			}
		}
		if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
			xmlhttp = new XMLHttpRequest();
		}
			return xmlhttp;
	}

	
	var x = getXmlHttp();

	// _________open
		
		if(method.toUpperCase() === 'GET'){
			var data = JSON.stringify(data);

			x.open(method, url+'?data='+encodeURIComponent(data), true);

			x.onreadystatechange = function(){
				if(x.readyState === 4){
					callback(x.responseText);
				}
			}

			x.send(null);

		} else if(method.toUpperCase() === 'POST') {
			if(!headers)
			var data = 'data=' + JSON.stringify(data);

			x.open(method, url, true);

			x.onreadystatechange = function(){
				if(x.readyState === 4){
					if(x.status === 200){
						if(callback)
							callback(x.responseText);
					}
				}
			}
			if(!headers)
				x.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

			x.send(data);
		} else if(method.toUpperCase() === 'PUT') {
			if(!headers)
			var data = 'data=' + JSON.stringify(data);

			x.open(method, url, true);

			x.onreadystatechange = function(){
				if(x.readyState === 4){
					if(x.status === 200){
						if(callback)
							callback(x.responseText);
					}
				}
			}
			if(!headers)
				x.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

			x.send(data);
		}
}

// **************************************************AJAX

if(document.getElementById('logOut')){
	document.getElementById('logOut').onclick = function(){
		document.getElementById('logOutForm').submit();
	}
}