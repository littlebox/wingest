var UsersIndexTable = function () {

	var initUsersIndexTable = function () {

		var table = $('#users_table');

		// begin first table
		LocalVar.dataTable = table.dataTable({
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
			"pageLength": 50, // set the initial value
			"bProcessing": true,
				"bServerSide": true,
				"sAjaxSource": LocalVar.ajaxSource, //set in view
				"aoColumns": [
					{mData:"User.full_name"},
					{mData:"User.email"},
					{mData:"User.created"},
					{
						mData:"User.id",
						mRender: function ( data, type, full ) {
							return '<button class="btn btn-sm red" onclick="confirmAlert(\''+LocalVar.userDeleterUrl+"/"+data+'\');" ><i class="fa fa-times"></i> '+LocalVar.userDeleteText+'</button> <a class="btn btn-sm blue" href="'+LocalVar.userEditUrl+"/"+data+'" ><i class="fa fa-pencil"></i> '+LocalVar.userEditText+'</a> <a class="btn btn-sm green" href="'+LocalVar.userViewrUrl+"/"+data+'" ><i class="fa fa-file"></i> '+LocalVar.userViewText+'</a>';
						},
						orderable: false
					}
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

			initUsersIndexTable();
		}

	};

}();