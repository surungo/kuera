
function txposnum(pos){		
	switch (pos) {
 	case 1:
		return "st";
	case 2:
		return "nd";
	case 3:
		return "rd";
	default:
		return "th";
	}
	return "th";
}

function viewtimer(){
	var n = 0;
	var l = document.getElementById("segundos");
	window.setInterval(function(){
	  l.innerHTML = n;
	  n++;
	},1000);
}

