@extends('admin.app')


@section('content')

<div class="col-12">
    <h1>Add New Question</h1>

    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    New Question
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">

            <form action="{{ route('admin.questions.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Title</label>
                    <input type="text" class="form-control" name="title" placeholder="Title">
                </div>
                <div class="mb-3">
                    <label>Exam</label>
                    <input type="text" class="form-control" name="exam_id" placeholder="Title">
                </div>

                <hr>

                <fieldset class="border p-3 mb-4">
                    <legend>Answers</legend>
                    <div class="questions-wrapper">
                        <div class="mb-3 row align-items-center">
                            <div class="col-9">
                                <input type="text" class="form-control" name="answers[0][answer]" placeholder="Answer">
                            </div>

                            <div class="col-2">
                                <label class="mb-0"><input type="radio" value="1" name="answers[0][correct]"> Correct</label>
                            </div>
                            <div class="col-1">
                                <button onclick="delRow(event)" type="button" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                    </div>
                    <button onclick="addRow()" class="btn btn-dark btn-sm" type="button"><i class="fas fa-plus"></i></button>

                </fieldset>

                <button class="btn btn-success px-5"><i class="fas fa-save"></i> Add</button>
            </form>

        </div>
    </div>
</div>

@endsection

@section('js')

<script>
    let i = 1;
    function addRow() {
        let el = `<div class="mb-3 row align-items-center">
                    <div class="col-9">
                        <input type="text" class="form-control" name="answers[${i}][answer]" placeholder="Answer">
                    </div>

                    <div class="col-2">
                        <label class="mb-0"><input type="radio" value="1" name="answers[${i}][correct]"> Correct</label>
                    </div>
                    <div class="col-1">
                        <button onclick="delRow(event)" type="button" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button>
                    </div>
                </div>`
        // document.querySelector('.questions-wrapper').innerHTML += el
        $('.questions-wrapper').append(el)
        i++;
    }

    function delRow(e) {
        e.target.closest('.row').remove()
    }

    $('body').on('click', 'input[type=radio]', function() {
        // alert('dd')
        $('input[type=radio]').prop('checked', false)
        $(this).prop('checked', true)
    })

</script>

@endsection
