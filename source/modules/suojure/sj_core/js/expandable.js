

function ExpandableToggle (el) {
	if (el.className.indexOf(' show') < 0) {
		if (el.className.indexOf(' hide') < 0) 
			el.className += ' show';
		else 
			el.className = el.className.replace(' hide', ' show');
	} else {
		el.className = el.className.replace(' show', ' hide');
	}
}