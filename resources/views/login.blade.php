@extends('landing-layout')

@section('title', 'Peminjaman Buku | Login')

@section('body')
<div class="container mt--8 pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <div class="card bg-secondary border-0 mb-0">
                <div class="card-body px-lg-5 py-lg-5">
                    <form action="{{route('login-auth')}}" method="post">
                        @csrf
                        <h1 class="text-default text-center mb-5">Login</h1>
                        <div class="form-group mb-3">
                            <div class="input-group input-group-merge input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                </div>
                                <input class="form-control @error('email') is-invalid @enderror" placeholder="Email" type="email" name="email" id="email" value="{{old('email')}}" required spellcheck="false">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group input-group-merge input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                </div>
                                <input class="form-control @error('password') is-invalid @enderror" placeholder="Password" type="password" name="password" id="password" value="{{old('password')}}" required spellcheck="false">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary my-4">Sign in</button>
                        </div>
                    </form>
                    @if ($message = Session::get('error'))
                    <div class="alert alert-danger mt-3" role="alert">
                        <strong>{{$message}}</strong>
                    </div>
                    @endif

                    @if ($message = Session::get('warning'))
                    <div class="alert alert-warning mt-3" role="alert">
                        <strong>{{$message}}</strong>
                    </div>
                    @endif
                </div>
            </div>
            <div class="mt-2 text-right">
                <a href="{{route('register')}}" class="text-light"><small>Buat Akun Baru</small></a>
            </div>
        </div>
    </div>
</div>
@endsection