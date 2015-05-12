var TopScorersIndexTable = function () {

	var initTopScorersIndexTable = function () {

		var table = $('#topScorers_table');

		// begin first table
		LocalVar.dataTable = table.dataTable({
			"bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
			"pagingType": "bootstrap_full_number",
			"language": {
				"url": '/plugins/datatables/i18n/'+LocalVar.langFile+'.json'
			},
			"lengthMenu": [
				[10, 25, 50, 100, -1],
				[10, 25, 50, 100, "All"] // change per page values here
			],
			"pageLength": 50, // set the initial value
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": LocalVar.ajaxSource, //set in view
			"aoColumns": [
				{mData:"Player.name"},
				{mData:"Team.name"},
				{mData:"Player.total_goals"},
				{mData:"Player.matches_played"},
				{mData:"Player.id", bSortable: false}
			],
			"fnCreatedRow": function(nRow, aData, iDataIndex){ //callback function after create a row for add action buttons en column 3
				htmlContent = '';
				htmlContent += '<a class="btn btn-sm green" href="'+LocalVar.topScorerViewrUrl+"/"+aData.Player.id+'" ><i class="fa fa-file"></i> '+LocalVar.topScorerViewText+'</a> ';
				//Set to column 5
				$('td:eq(4)', nRow).html(htmlContent);
			}
		});

		//Sort the table afer load [TODO do it after first load! it bring data twice]
		//table.fnSort([[2, 'des']]); //THe number is the column number to sort

		var tableWrapper = jQuery('#topScorers_table_old_wrapper');

		tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown
	}

	return {

		//main function to initiate the module
		init: function () {
			if (!jQuery().dataTable) {
				return;
			}

			initTopScorersIndexTable();
		}

	};

}();