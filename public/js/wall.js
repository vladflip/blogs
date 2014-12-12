// -------------------------------------------
//	add - post
// -------------------------------------------

(function(){
	var cap = document.getElementsByClassName('a-p_cap')[0];
	var form = document.getElementById('a_pForm');
	var head = form.getElementsByClassName('add-post-header')[0];
	var content = form.getElementsByClassName('add-post-content')[0];

	var hf = false,
		cf = false;

	cap.onclick = function(){
		this.style.display = 'none';
		form.style.display = 'block';
		head.focus();
	}

	head.onfocus = function(){
		hf = true;
	}
	head.onblur = function(){
		hf = false;
		if(!cf){
			form.style.display = 'none';
			cap.style.display = 'block';
		}
	}

	content.onfocus = function(){
		cf = true;
	}
	content.onblur = function(){
		cf = false
	}
})()