HTMLElement.prototype.fadeIn = function(){
	var self = this;
	this.style.display = 'block';
		setTimeout(function(){
			self.style.opacity = 1;
		},50);
}

HTMLElement.prototype.fadeOut = function(){
	var self = this;
	this.style.opacity = 0;
		setTimeout(function(){
			self.style.display = 'none';
		},300);
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
			var data = 'data=' + JSON.stringify(data);
			x.open(method, url, true);

			x.onreadystatechange = function(){
				if(x.readyState === 4){
					callback(x.responseText);
				}
			}

			x.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

			x.send(data);
		}
}

// **************************************************AJAX