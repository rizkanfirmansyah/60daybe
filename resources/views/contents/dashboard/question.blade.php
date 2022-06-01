@extends('templates.pages')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table table-hover my-0" id="table-question">
                            <thead>
                                <tr>
                                    <th width="10px"><label class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="checkboxAll"
                                                onchange="checkboxAll(this)">
                                        </label></th>
                                    <th>Question</th>
                                    <th class="d-none d-xl-table-cell">Answer</th>
                                    <th class="d-none d-md-table-cell">Created By</th>
                                    <th class="d-none d-md-table-cell">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('modal')
    <form method="post" action="/question" data-title="Input Data Pertanyaan" data-reload="">
        <div class="mb-3">
            <label for="question" class="form-label">Pertanyaan</label>
            <input type="text" name="question" class="form-control" id="question" placeholder="Masukkan Pertanyaan">
        </div>
        <div class="mb-3">
            <label for="answer" class="form-label">Jawaban</label>
            <input type="text" name="answer" class="form-control" id="answer" placeholder="Masukkan Jawaban">
        </div>
        <div class="d-flex mt-3 ">
            <button type="submit" class="ms-auto btn btn-primary px-3"> Simpan</button>
        </div>
    </form>
@endpush

@push('script')
    <script>
        let data = {
            colums: [{
                    data: 'check',
                    name: 'check',
                    sortable: false,

                },
                {
                    data: 'question',
                    name: 'question'
                },
                {
                    data: 'answer',
                    name: 'answer'
                },
                {
                    data: 'created_by',
                    name: 'created_by'
                },
                {
                    data: 'action',
                    name: 'action'
                },
            ],
            url: '/question/create',
            table: 'table-question',
            switch: true,
        }

        crud.get(data)
    </script>
@endpush
