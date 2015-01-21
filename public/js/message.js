(function(){

	var received = true,
		sent = false;

	var tog = function(){
		if(received) {
			received = false;
			sent = true;
		} else {
			received = true;
			sent = false;
		}
	}

	var rTable = document.getElementsByClassName('m-b_received-table')[0];
	var sTable = document.getElementsByClassName('m-b_sent-table')[0];

	var rPane = document.getElementsByClassName('m-b_p-in')[0];
	var sPane = document.getElementsByClassName('m-b_p-out')[0];

	var cc = 'm-b_p-choisen';
	var rc = 'm-b_p-disabled';

	rPane.onclick = function(){
		if(received) return;
		else {
			
			sTable.style.display = 'none';
			rTable.style.display = 'table';

			sPane.classList.remove(cc);
			sPane.classList.add(rc);

			rPane.classList.remove(rc);
			rPane.classList.add(cc);

			tog();
		}
	}

	sPane.onclick = function(){
		if(sent) return;
		else {
			
			rTable.style.display = 'none';
			sTable.style.display = 'table';

			rPane.classList.remove(cc);
			rPane.classList.add(rc);

			sPane.classList.remove(rc);
			sPane.classList.add(cc);

			tog();
		}
	}


	var form = document.getElementById('writeMsg');
	var hidden = form.getElementsByClassName('hidden')[0];

	var replies = document.getElementsByClassName('ms_reply');

	for(var i = 0 ; i < replies.length; i++){
		replies[i].onclick = function(){
			hidden.value = this.dataset.id;

			(function(){
				var panel = new popUp();

				form.onmousedown = function(e){
					e.stopPropagation();
				}

				panel.open();
				panel.pop.appendChild(form);
				form.style.display = 'block';
			})();
		}
	}

})();
