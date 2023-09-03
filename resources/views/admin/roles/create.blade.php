@extends('admin.app')


@section('content')

<div class="col-12">
    <h1>Add New Role</h1>

    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    New Role
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">

            <form action="{{ route('admin.roles.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Name">
                </div>

                <div class="mb-3">
                    <label>Permissions</label> <br>
                    <label><input type="checkbox" id="check_all"> All Permissions</label>
                    <ul style="column-count: 2" class="list-unstyled">
                        @foreach ($permissions as $item)
                            <li><label> <input type="checkbox" name="abilities[]" value="{{ $item->id }}"> {{ $item->name }}</label></li>
                        @endforeach
                    </ul>
                </div>

                <button class="btn btn-success px-5"><i class="fas fa-save"></i> Add</button>
            </form>

        </div>
    </div>
</div>

@endsection

@section('js')

<script>

    $('#check_all').change(function() {

        $('ul input[type=checkbox]').prop('checked', this.checked)

    })

</script>

@stop
