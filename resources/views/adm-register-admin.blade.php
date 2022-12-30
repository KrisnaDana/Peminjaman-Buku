@extends('layout')

@section('title', 'Admin | Register Admin')

@section('body')
<form action="{{route('adm-register-admin-submit')}}" method="post">
    @csrf
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col-8">
                <h3 class="mb-0">Register Admin</h3>
            </div>
            <div class="col-4 text-right">
                <button type="submit" class="btn btn-sm btn-primary">Register</button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label" for="email">Email</label>
                    <input id="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Masukkan Email" value="{{old('email')}}" type="email" spellcheck="false" required>
                    @error('email')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-control-label" for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan Password" spellcheck="false" required>
                    @error('password')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-control-label" for="konfirmasi">Konfirmasi Password</label>
                    <input type="password" id="konfirmasi" name="konfirmasi" class="form-control @error('konfirmasi') is-invalid @enderror" placeholder="Masukkan Konfirmasi Password" spellcheck="false" required>
                    @error('konfirmasi')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
            </div>
        </div>
        @if ($message = Session::get('error'))
        <hr class="my-4" />
        <div class="alert alert-danger mt-3" role="alert">
            <strong>{{$message}}</strong>
        </div>
        @endif
        @if ($message = Session::get('success'))
        <hr class="my-4" />
        <div class="alert alert-success mt-3" role="alert">
            <strong>{{$message}}</strong>
        </div>
        @endif
    </div>
</form>
@endsection