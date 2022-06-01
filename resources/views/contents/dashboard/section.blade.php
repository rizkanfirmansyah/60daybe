@extends('templates.pages')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table table-hover my-0" id="table-section">
                            <thead>
                                <tr>
                                    <th width="10px"><label class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="checkboxAll"
                                                onchange="checkboxAll(this)">
                                        </label></th>
                                    <th>Name</th>
                                    <th class="d-none d-xl-table-cell">Description</th>
                                    <th class="d-none d-md-table-cell">Status</th>
                                    <th class="d-none d-md-table-cell">Created By</th>
                                    <th class="d-none d-md-table-cell">Created At</th>
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
    <form method="post" action="/section" data-title="Input Data Section" data-reload="">
        <div class="mb-3">
            <label for="name" class="form-label">Nama Section</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Masukkan Nama Section">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi Section</label>
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
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'created_by',
                    name: 'created_by'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'action',
                    name: 'action'
                },
            ],
            url: '/section/create',
            table: 'table-section',
            switch: true,
        }

        crud.get(data)
    </script>
@endpush
