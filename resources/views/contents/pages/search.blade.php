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
                    <div class="searchs row">
                        <form action="c" class="d-flex position-relative mt-4">
                            <input type="text" class="form-control" placeholder="Enter your challenge..." name="search"
                                aria-label="Enter your challenge..." aria-describedby="button-addon2">
                            <button class="btn btn-primary py-2 px-4" type="submit" id="button-addon2">Check</button>
                        </form>
                    </div>
                    <div class="col-10">
                        <h2 class="mt-4 mb-3 ">{{$search}}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div id="body-content">
            <section id="list">
                <div class="container">
                    <div class="row" id="task-list">
                        @foreach ($data as $item)
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
        </div>

        @include('partials.questions')

    </main>

    @include('layouts.home.footer')


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>
