function getAll(dataTable){
	/* 2015 (c) JALP Jayakody
	*  Returns all data in data table's input text fields
	*  by a 2D array.
	*/
	var c=new Array();
	$(dataTable.fnGetData())
	.each(
		function(i){
			var r=new Array();
			$(dataTable.fnGetData()[i])
			.each(
				function(j){
					r.push($($("input",dataTable.fnGetData()[i][j])[0]).attr("value"));
				}
			)
			c.push(r);
		}
	)
	return c;
}
