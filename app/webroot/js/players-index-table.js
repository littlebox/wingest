var PlayersIndexTable = function () {

	var initPlayersIndexTable = function () {

		var table = $('#players_table');

		// begin first table
		LocalVar.dataTable = table.dataTable({
			// "ordering": false,
			"bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
			"pagingType": "bootstrap_full_number",
			"language": {
				"paginate": {
					"previous":"Prev",
					"next": "Next",
					"last": "Last",
					"first": "First"
				}
			},
			"lengthMenu": [
				[10, 25, 50, 100, -1],
				[10, 25, 50, 100, "All"] // change per page values here
			],
			"columnDefs": [
				{"targets": 0 }
			],
			"pageLength": 50, // set the initial value
			"bProcessing": true,
				"bServerSide": true,
				"sAjaxSource": LocalVar.ajaxSource, //set in view
				"aoColumns": [
					{
						mData:"Player.id",
						mRender: function ( data, type, full ) {
							r = '<a class="btn btn-sm blue" href="'+LocalVar.playerEditUrl+"/"+data+'" ><i class="fa fa-pencil"></i> '+LocalVar.playerEditText+'</a>';
							r += '<button class="btn btn-sm red" onclick="confirmAlert(\''+LocalVar.playerDeleteUrl+"/"+data+'\');" ><i class="fa fa-times"></i> '+LocalVar.playerDeleteText+'</button>';
							return r;
						},
						orderable: false
					},
					{mData:"Player.name", orderable: true,},
					{mData:"Player.last_name"},
					{mData:"Team.name"},
					{mData:"Player.dni"},
					{mData:"Player.phone"},
					{mData:"Player.position"},
					{mData:"Player.birthday"},
					{mData:"Player.email"},
					{mData:"Player.nickname"},
					{mData:"Player.facebook"},

				],
		});

		var tableWrapper = jQuery('#users_table_old_wrapper');

		tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown
	}

	return {

		//main function to initiate the module
		init: function () {
			if (!jQuery().dataTable) {
				return;
			}

			initPlayersIndexTable();
		}

	};

}();