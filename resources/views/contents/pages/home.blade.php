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
        <div class="container mt-3 mb-5" id="jumbotron">
            <div class="row flex-column-reverse flex-md-row">
                <div class="col-lg-4 d-flex flex-column justify-content-center">
                    <h2>Get Your Passion in 60 Day Challenge</h2>
                    <p class="my-1">Challenge yourself in 60 day and choice your favorite challenge & get your achievement</p>
                        <form action="c" class="d-flex position-relative mt-4">
                            <input type="text" class="form-control" placeholder="Enter your challenge..." name="search"
                                aria-label="Enter your challenge..." aria-describedby="button-addon2">
                            <button class="btn btn-primary py-2 px-4" type="submit" id="button-addon2">Check</button>
                        </form>
                </div>
                <div class="col-lg-8 mb-3 mb-md-0">
                    <img src="/assets/images/banner.png" class="img-fluid" alt="">
                </div>
            </div>
        </div>

        <div id="highlight" class="py-3">
            <div class="container py-5">
                <div class="row">
                    <div class="col-lg-4 d-flex flex-column justify-content-center">
                        <h3>The most contributed Leaderboard</h3>
                        <p class="mt-2">Here are some of the most credit points recipients on campus</p>
                    </div>
                    <div class="col-lg-1"></div>
                    <div class="col-lg-6">
                        <div class="table-responsive">
                            <table class="table table-borderedless" cellspacing="500">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Points</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Admin</td>
                                        <td>4000pt</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Admin</td>
                                        <td>4000pt</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Admin</td>
                                        <td>4000pt</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-1"></div>
                </div>
            </div>
        </div>

        <section id="section-one" class="py-5">
            <div class="container">
                <div class="row text-center row-title">
                    <h2>How It Works</h2>
                    <p>Here are some of the most credit points recipients on campus</p>
                </div>
                <div class="row mt-5">
                    <div class="col-lg-7 mb-3">
                        <img src="/assets/images/section-1.png" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-5 d-flex flex-column justify-content-center mb-5">
                        <h2>Statistic of Student Index Point</h2>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have
                            suffered alteration in some form</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-two" class="py-3">
            <div class="container">
                <div class="row mt-5 flex-md-row flex-column-reverse">
                    <div class="col-lg-5 d-flex flex-column justify-content-center mb-5">
                        <h2>Statistic of Student Index Point</h2>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have
                            suffered alteration in some form</p>
                    </div>
                    <div class="col-lg-1">
                    </div>
                    <div class="col-lg-6 d-flex justify-content-end mb-3">
                        <img src="/assets/images/section-2.png" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </section>

        <section id="list" class="my-5">
            <div class="container">
                <div class="row text-center row-title">
                    <h2>List Task Available</h2>
                    <p>Some assignments or activities that can get credit points for active <br> campus students</p>
                </div>
                <div class="row" id="task-list">
                    @foreach ($challenge as $item)
                        <div class="col-lg-4 mt-4">
                            <div class="card bg-transparent">
                                <a href="c?title={{$item->slug}}&id={{$item->id}}">
                                    <div class="card-header p-4 bg-transparent">
                                        <h2>{{ $item->title }}</h2>
                                        <div class="images my-3">
                                            <img src="/images/{{ $item->image }}" alt="" class="img-fluid">
                                        </div>
                                        <p class="">{{ $item->description }}
                                        </p>
                                        <div class="badge text-bg-primary">All</div>
                                    </div>
                                </a>
                                <div class="card-body bg-transparent">
                                    <div class="justify-content-between d-flex">
                                        <div>
                                            <span class="mx-1"><i class="fas fa-code"></i> Coding</span>
                                            <span class="mx-1"><i class="fas fa-clock"></i>
                                                {{ $item->estimated }} Hours</span>
                                        </div>
                                        <div>
                                            <span class="mx-1"><i class="fas fa-calendar-alt"></i> {{$item->day}}
                                                Day</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        @include('partials.questions')

    </main>

    @include('layouts.home.footer')

    <script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
