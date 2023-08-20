@extends('admin.app')


@section('content')



<div class="col-12">
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="fas fa-user"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Your Profile
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">

            <form action="{{ route('admin.profile') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" value="{{ $admin->name }}" class="form-control" />
                </div>

                <div class="mb-3 dropzone" id="dropimage">
                    {{-- <label>Image</label> --}}
                    {{-- <input type="file" name="image[]" multiple class="form-control" /> --}}
                    {{-- <input type="file" name="image" class="form-control" /> --}}
                </div>

                <button class="btn btn-success"><i class="fas fa-save"></i> Update</button>
            </form>

        </div>
    </div>
</div>

@endsection

@section('js')
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

<script>
    let myDropzone = new Dropzone("#dropimage", {
        url: "{{ route('admin.profile_image') }}",
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        success: function(file, res) {
            // console.log(res.url);
            // console.log($('.admin_img').length);
            if($('.admin_img').length > 0) {
                $('.admin_img').attr('src', res.url)
            }else {
                let img = `<img class="admin_img" alt="Pic" src="${res.url}" />`
                $('.admin_img_wrapper').html(img)
            }

        }
    });
</script>
@endsection
