// -------------------------------------------
//	add - post
// -------------------------------------------

(function(){
	var cap = document.getElementsByClassName('a-p_cap')[0];
	var form = document.getElementById('a_pForm');
	var head = form.getElementsByClassName('a-p-header')[0];
	var content = form.getElementsByClassName('a-p-content')[0];
	var submit = document.getElementById('submitNewPost');

	// ==================================
		// $('#freewall').click(function(e){e.stopPropagation()});

		// var wall = new freewall('#freewall');
		// wall.reset({
		// 	selector: '.wall-img',
		// 	animate: true,
		// 	cellW: 100,
		// 	cellH: 100,
		// 	onResize: function(){
		// 		// wall.refresh(600, 400);
		// 	}
		// });
		// wall.fitZone(600, 400);
		var photo = $('#addPhoto');

		photo.fileReaderJS({
			dragClass : 'photo-dragged',
			on: {
				load: function(e, file) {
					// wall.prepend('<div class="wall-img"><img src="' + e.target.result + '"></div>');
					console.log(file);
				}
			}
		});
	// ==================================


	var hf = false,
		cf = false;


	cap.onclick = function(e){
		e.stopPropagation();
		this.style.display = 'none';
		form.style.display = 'block';
		head.focus();

		document.onclick = function(){
			form.style.display = 'none';
			cap.style.display = 'block';
			// form.reset();
			document.onclick = null;
		}
	}

	head.onclick = function(e){
		e.stopPropagation();
	}
	content.onclick = function(e){
		e.stopPropagation();
	}
	submit.onclick = function(e){
		e.stopPropagation();
	}
	head.onfocus = function(){
		hf = true;
	}
	// head.onblur = function(){
	// 	hf = false;
	// 	if(!cf){
	// 		form.style.display = 'none';
	// 		cap.style.display = 'block';
	// 	}
	// }

	content.onfocus = function(){
		cf = true;
	}
	content.onblur = function(){
		cf = false
	}

	photo.click(function(e){
		e.stopPropagation();
	});

})();