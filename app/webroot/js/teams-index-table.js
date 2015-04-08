var TeamsIndexTable = function () {

	var initTeamsIndexTable = function () {

		var table = $('#teams_table');

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
				{ "orderable": false, "targets": 0 }
			],
			"pageLength": 50, // set the initial value
			"bProcessing": true,
				"bServerSide": true,
				"sAjaxSource": LocalVar.ajaxSource, //set in view
				"aoColumns": [
					{
						mData:"Team.id",
						mRender: function ( data, type, full ) {
							return '<a class="btn btn-sm blue" href="'+LocalVar.teamEditUrl+"/"+data+'" ><i class="fa fa-pencil"></i> '+LocalVar.teamEditText+'</a> <a class="btn btn-sm green" href="'+LocalVar.teamViewPlayersUrl+"/index/"+data+'" ><i class="fa fa-group"></i> '+LocalVar.teamViewPlayersText+'</a> <button class="btn btn-sm red" onclick="confirmAlert(\''+LocalVar.teamDeleteUrl+"/"+data+'\');" ><i class="fa fa-times"></i> '+LocalVar.teamDeleteText+'</button> ';
						},
						orderable: false
					},
					{mData:"Team.name"},
					{mData:"Team.tournament_id",
						mRender: function(data, type, full){
							var torneo = [];
							torneo[1] = '<img style="width:50px;height:50px" title="Masculino" src="/img/torneomasculino.png">';
							torneo[2] = '<img style="width:50px;height:50px" title="Femenino Amateur" src="/img/torneofemeninoamateur.png">';
							torneo[3] = '<img style="width:50px;height:50px" title="Femenino Pro" src="/img/torneofemeninopro.png">';
							return torneo[data];
						}
					},
					{mData:"Team.captain"},
					{mData:"Team.captain2"},
					{mData:"Team.captain_email"},
					{mData:"Team.captain2_email"},
					{mData:"Team.captain_phone"},
					{mData:"Team.captain2_phone"},
					{mData:"Team.captain_facebook"},
					{mData:"Team.captain2_facebook"},
					// {mData:"Team.id"},
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

			initTeamsIndexTable();
		}

	};

}();