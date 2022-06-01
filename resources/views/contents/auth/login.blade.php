@extends('templates.auth')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="m-sm-4">
                <div class="text-center">
                    <img src="/assets/img/avatars/avatar.jpg" alt="Charles Hall" class="img-fluid rounded-circle" width="132"
                        height="132" />
                </div>
                <form id="login">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input class="form-control form-control-lg" type="text" name="username"
                            placeholder="Enter your email or name" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input class="form-control form-control-lg" type="password" name="password"
                            placeholder="Enter your password" />
                        <small>
                            <a href="#" onclick="() => alert('masih develope')">Forgot password?</a>
                        </small>
                    </div>
                    <div>
                        <label class="form-check">
                            <input class="form-check-input" type="checkbox" value="remember-me" name="remember-me" checked>
                            <span class="form-check-label">
                                Remember me next time
                            </span>
                        </label>
                    </div>
                    <div class="text-center mt-3">
                        {{-- <a href="" class="btn btn-lg btn-primary">Sign in</a> --}}
                        <button type="submit" class="btn btn-lg btn-primary">Sign in</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <script src="/assets/js/services/service-helper.js"></script>
    <script src="/assets/js/services/service-auth.js"></script>
    <script>
        let auth = new Auth();

        $('form#login').on('submit', function (e) {
            e.preventDefault();
            let data = new FormData(this)
            auth.login(data);
        })
    </script>
@endpush
