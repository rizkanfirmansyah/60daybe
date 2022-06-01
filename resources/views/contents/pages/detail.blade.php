<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>60 Day Challenge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="shortcut icon" href="/assets/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    @include('layouts.home.navbar')

    <main id="content">

        <div id="header-content" class="my-5">
            <div class="container">
                <div class="row text-center justify-content-center">
                    <div class="images row">
                        <img src="/images/{{$data->image}}" alt="">
                    </div>
                    <div class="col-10">
                        <h2 class="mt-4 mb-3">{{$data->title}}</h2>
                        <p>{{$data->description}}</p>
                        <span class="badge text-bg-primary">All</span>
                    </div>
                </div>
            </div>
        </div>

        <div id="body-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <ul class="nav nav-tabs justify-content-between" id="tabChallenges" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="list-tab" data-bs-toggle="tab"
                                    data-bs-target="#list-tab-pane" type="button" role="tab"
                                    aria-controls="list-tab-pane" aria-selected="true">List Challenge</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="result-tab" data-bs-toggle="tab"
                                    data-bs-target="#develope-tab-pane" type="button" role="tab"
                                    aria-controls="develope-tab-pane" aria-selected="false">Result Challenge</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="comment-tab" data-bs-toggle="tab"
                                    data-bs-target="#develope-tab-pane" type="button" role="tab"
                                    aria-controls="develope-tab-pane" aria-selected="false">Comment</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="rating-tab" data-bs-toggle="tab"
                                    data-bs-target="#develope-tab-pane" type="button" role="tab"
                                    aria-controls="develope-tab-pane" aria-selected="false">Rating</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="tabDetails">
                            <div class="tab-pane fade show active" id="list-tab-pane" role="tabpanel"
                                aria-labelledby="list-tab" tabindex="0">
                                <div class="row my-3">
                                    <div class="accordion col-lg-10" id="challenges">
                                        @foreach ($datas as $silabus)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="question-{{$silabus->id}}">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapse{{$silabus->id}}" aria-expanded="true" aria-controls="collapse{{$silabus->id}}">
                                                    {{$silabus->title}}
                                                </button>
                                            </h2>
                                            <div id="collapse{{$silabus->id}}" class="accordion-collapse collapse show" aria-labelledby="question-{{$silabus->id}}"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    {{$silabus->description}}
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel"
                                aria-labelledby="profile-tab" tabindex="0">...</div>
                            <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel"
                                aria-labelledby="contact-tab" tabindex="0">...</div>
                            <div class="tab-pane fade" id="develope-tab-pane" role="tabpanel"
                                aria-labelledby="develope-tab" tabindex="0">
                                <div class="row my-5 justify-content-center text-center">
                                    <h2>Masih dalam tahap development</h2>
                                    <img src="/assets/icons/error.svg" alt="" class="img-fluid mt-4">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="row mt-5 mx-2" id="detail-challenge">
                            <div class="card shadow p-3">
                                <h2>Detail Challenge</h2>
                                <table>
                                    <tr>
                                        <td>Creator</td>
                                        <td>: {{$data->created_by == 'admin' ? 'Rizkan Firmansyah' : 'Admin'}}</td>
                                    </tr>
                                    <tr>
                                        <td>Category</td>
                                        <td>: All</td>
                                    </tr>
                                    <tr>
                                        <td>Level</td>
                                        <td class="text-capitalize">: {{$data->level}}</td>
                                    </tr>
                                </table>

                                <button class="btn text-bg-primary mt-3">See Another Challenges</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('partials.questions')

    </main>

    @include('layouts.home.footer')


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>
