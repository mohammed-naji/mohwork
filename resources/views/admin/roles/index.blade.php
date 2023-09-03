@extends('admin.app')


@section('content')

<div class="col-12">
    <h1>All Roles</h1>
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Basic
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">

            @if (session('msg'))
                <div class="alert alert-{{ session('type') }}">
                {{ session('msg') }}</div>
            @endif

            <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                <a class="btn btn-primary btn-sm p-1" href="{{ route('admin.roles.edit', $role->id) }}">
                                    <i class="fas fa-edit" style="position: relative;
                                    left: 3px;"></i>
                                </a>
                                <form class="d-inline" action="{{ route('admin.roles.destroy', $role->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button onclick="return confirm('Are you sure?!')" class="btn btn-danger btn-sm p-1">
                                    <i class="fas fa-trash" style="position: relative;
                                    left: 3px;"></i>
                                </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>

            <!--end: Datatable -->
        </div>
    </div>
</div>

@endsection

@section('js')

<script>
    "use strict";
var KTDatatablesBasicBasic = function() {

	var initTable1 = function() {
		var table = $('#kt_table_1');

		// begin first table
		table.DataTable({
			responsive: true,

			// DOM Layout settings
			dom: `<'row'<'col-sm-12'tr>>
			<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,

			lengthMenu: [5, 10, 25, 50],

			pageLength: 10,

			language: {
				'lengthMenu': 'Display _MENU_',
			},

			// Order settings
			order: [[1, 'desc']],

			// headerCallback: function(thead, data, start, end, display) {
			// 	thead.getElementsByTagName('th')[0].innerHTML = `
            //         <label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
            //             <input type="checkbox" value="" class="kt-group-checkable">
            //             <span></span>
            //         </label>`;
			// },
        })
		// table.on('change', '.kt-group-checkable', function() {
		// 	var set = $(this).closest('table').find('td:first-child .kt-checkable');
		// 	var checked = $(this).is(':checked');

		// 	$(set).each(function() {
		// 		if (checked) {
		// 			$(this).prop('checked', true);
		// 			$(this).closest('tr').addClass('active');
		// 		}
		// 		else {
		// 			$(this).prop('checked', false);
		// 			$(this).closest('tr').removeClass('active');
		// 		}
		// 	});
		// });

		// table.on('change', 'tbody tr .kt-checkbox', function() {
		// 	$(this).parents('tr').toggleClass('active');
		// });
	};

	return {

		//main function to initiate the module
		init: function() {
			initTable1();
		},

	};

}();

jQuery(document).ready(function() {
	KTDatatablesBasicBasic.init();
});
</script>
@endsection
