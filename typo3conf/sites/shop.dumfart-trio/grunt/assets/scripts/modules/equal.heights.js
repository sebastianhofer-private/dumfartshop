function equalHeights(container, item, offsetBottom) {
	var maxHeight = 0;

	$(container).find(item).height('auto');
	$(container).find(item).each(function(){
		var $this = $(this);

		if($this.height() > maxHeight){
			maxHeight = $this.height();
		}
	});

	if(offsetBottom > 0) {
		maxHeight = maxHeight - offsetBottom;
	}
	$(container).find(item).height(maxHeight);

	//console.log(item + ' - Höhe: ' + test);

	return false;
}