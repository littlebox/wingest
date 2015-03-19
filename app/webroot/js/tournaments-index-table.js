var TournamentsIndexTable = function () {

	var initTournamentsIndexTable = function () {

		var table = $('#tournaments_table');

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
				{mData:"Tournament.name"},
				{mData:"Tournament.players_per_team"},
				{mData:"Tournament.id", bSortable: false}
			],
			"fnCreatedRow": function(nRow, aData, iDataIndex){ //callback function after create a row for add action buttons en column 3
				$('td:eq(2)', nRow).html('<button class="btn btn-sm red" onclick="confirmAlert(\''+LocalVar.tournamentDeleterUrl+"/"+aData.Tournament.id+'\');" ><i class="fa fa-times"></i> '+LocalVar.tournamentDeleteText+'</button> <a class="btn btn-sm blue" href="'+LocalVar.tournamentEditUrl+"/"+aData.Tournament.id+'" ><i class="fa fa-pencil"></i> '+LocalVar.tournamentEditText+'</a> <a class="btn btn-sm green" href="'+LocalVar.tournamentViewrUrl+"/"+aData.Tournament.id+'" ><i class="fa fa-file"></i> '+LocalVar.tournamentViewText+'</a>');
			}
		});

		//Sort the table afer load [TODO do it after first load! it bring data twice]
		//table.fnSort([[2, 'des']]); //THe number is the column number to sort

		var tableWrapper = jQuery('#tournaments_table_old_wrapper');

		tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown
	}

	return {

		//main function to initiate the module
		init: function () {
			if (!jQuery().dataTable) {
				return;
			}

			initTournamentsIndexTable();
		}

	};

}();