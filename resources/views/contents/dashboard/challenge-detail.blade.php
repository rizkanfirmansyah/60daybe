@extends('templates.pages')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table table-hover my-0" id="table-challenge">
                            <thead>
                                <tr>
                                    <th width="10px"><label class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="checkboxAll"
                                                onchange="checkboxAll(this)">
                                        </label></th>
                                    <th>Challenge</th>
                                    <th class="d-none d-md-table-cell">Title</th>
                                    <th class="d-none d-xl-table-cell">Description</th>
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
    <form method="post" action="/challenge-detail" data-title="Input Data Challenge Detail" data-reload="">
        <div class="mb-3">
            <label for="title" class="form-label">Pilih Challenge</label>
            <select name="challenge_id" id="challenge_id" class="form-select">
                <option selected value disabled>== Pilih Challenge==</option>
                @foreach ($challenge as $item)
                    <option value="{{ $item->id }}">{{$item->title}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">Title Silabus</label>
            <input type="text" name="title" class="form-control" id="title" placeholder="Masukkan Judul Challenge">
        </div>
        <div class="mb-3">
            <label for="estimated" class="form-label">Estimasi Waktu Challenge</label>
            <input type="number" name="estimated" class="form-control" id="estimated"
                placeholder="Masukkan Estimasi Waktu (satuan jam)">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi Challenge</label>
            <textarea class="form-control" name="description" id="description" rows="3"></textarea>
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
                    data: 'challenge_id',
                    name: 'challenge_id'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'description',
                    name: 'description'
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
            url: '/challenge-detail/create',
            table: 'table-challenge',
            switch: true,
        }

        crud.get(data)
    </script>
@endpush
