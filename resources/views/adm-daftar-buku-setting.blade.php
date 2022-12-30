@extends('layout')

@auth("adm")
@section('title', 'Admin | Buku')
@endauth

@auth("peminjam")
@section('title', 'Detail Buku')
@endauth

@section('body')

@if (!empty($tambah))
<div class="card-header">
    <div class="row align-items-center">
        <div class="col-8">
            <h3 class="mb-0">Tambah Buku</h3>
        </div>
        <div class="col-4 text-right">
            <a type="button" href="{{route('adm-daftar-buku')}}" class="btn btn-sm btn-danger text-white">Kembali</a>
        </div>
    </div>
</div>
<div class="card-body">
    <form action="{{route('adm-daftar-buku-tambah-submit')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg">
                <div class="form-group">
                    <label class="form-control-label" for="judul">Judul</label>
                    <input type="text" id="judul" class="form-control @error('judul') is-invalid @enderror" placeholder="Masukkan Judul" spellcheck="false" name="judul" value="{{old('judul')}}" required>
                    @error('judul')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-control-label" for="kode">Kode</label>
                    <input type="text" id="kode" class="form-control @error('kode') is-invalid @enderror" placeholder="Masukkan Kode" spellcheck="false" name="kode" value="{{old('kode')}}" required>
                    @error('kode')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-control-label" for="kode">Jumlah Halaman</label>
                    <input type="text" id="halaman" class="form-control @error('halaman') is-invalid @enderror" placeholder="Masukkan halaman" value="{{old('halaman')}}" spellcheck="false" name="halaman" required>
                    @error('halaman')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label" for="pengarang">Pengarang</label>
                    <input type="text" id="pengarang" class="form-control @error('pengarang') is-invalid @enderror" placeholder="Masukkan pengarang" spellcheck="false" name="pengarang" value="{{old('pengarang')}}" required>
                    @error('pengarang')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="penerbit">Penerbit</label>
                    <select class="form-control" id="penerbit" name="penerbit">
                        @foreach ($penerbit as $penerbits)
                        @if(!old('penerbit'))
                        <option value="{{$penerbits->id}}">{{$penerbits->penerbit}}</option>
                        @elseif(old('penerbit') && old('penerbit')==$penerbits->id)
                        <option value="{{old('penerbit')}}" selected>{{$penerbits->penerbit}}</option>
                        @else
                        <option value="{{$penerbits->id}}">{{$penerbits->penerbit}}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label" for="tahun">Tahun Terbit</label>
                    <input type="text" id="tahun" class="form-control @error('tahun') is-invalid @enderror" placeholder="Masukkan tahun" spellcheck="false" name="tahun" value="{{old('tahun')}}" required>
                    @error('tahun')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-control-label" class="form-control-label" for="kondisi">Kondisi</label>
                    <select class="form-control" id="kondisi" name="kondisi">
                        @foreach ($kondisi as $kondisis)
                        @if(!old('kondisi'))
                        <option value="{{$kondisis->id}}">{{$kondisis->kondisi}}</option>
                        @elseif(old('kondisi') && old('kondisi')==$kondisis->id)
                        <option value="{{old('kondisi')}}" selected>{{$kondisis->kondisi}}</option>
                        @else
                        <option value="{{$kondisis->id}}">{{$kondisis->kondisi}}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-control-label" class="form-control-label" for="status">Status</label>
                    <select class="form-control" id="status" name="status">
                        @foreach ($status as $statuss)
                        @if(!old('status'))
                        <option value="{{$statuss->id}}">{{$statuss->status}}</option>
                        @elseif(old('status') && old('status')==$statuss->id)
                        <option value="{{old('status')}}" selected>{{$statuss->status}}</option>
                        @else
                        <option value="{{$statuss->id}}">{{$statuss->status}}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <label class="form-control-label">Foto Sampul</label>
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="customFileLang" name="sampul" lang="en">
            <label class="custom-file-label form-control @error('sampul') is-invalid @enderror" for="customFileLang">Pilih Gambar</label>
            @error('sampul')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group mt-4">
            <label class="form-control-label">Deskripsi</label>
            <textarea class="form-control @error('deskripsi') is-invalid @enderror" placeholder="Masukkan Deskripsi" rows="3" id="alamat" name="deskripsi" required spellcheck="false">{{old('deskripsi')}}</textarea>
            @error('deskripsi')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="text-right">
            <button type="submit" class="btn btn-primary" style="margin-top:40px;">Simpan</button>
        </div>
    </form>
</div>


</div>
@endif

@if (!empty($ubah))
<div class="card-header">
    <div class="row align-items-center">
        <div class="col-8">
            <h3 class="mb-0">Ubah Buku</h3>
        </div>
        <div class="col-4 text-right">
            <a type="button" href="{{route('adm-daftar-buku')}}" class="btn btn-sm btn-danger text-white">Kembali</a>
        </div>
    </div>
</div>
<div class="card-body">
    <form action="{{route('adm-daftar-buku-ubah-submit', $daftars->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg">
                <div class="form-group">
                    <label class="form-control-label" for="judul">Judul</label>
                    <input type="text" id="judul" class="form-control @error('judul') is-invalid @enderror" placeholder="Masukkan Judul" spellcheck="false" name="judul" value="{{old('judul') ?? $daftars->judul}}" required>
                    @error('judul')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-control-label" for="kode">Kode</label>
                    <input type="text" id="kode" class="form-control @error('kode') is-invalid @enderror" placeholder="Masukkan Kode" spellcheck="false" name="kode" value="{{old('kode') ?? $daftars->kode}}" required>
                    @error('kode')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-control-label" for="kode">Jumlah Halaman</label>
                    <input type="text" id="halaman" class="form-control @error('halaman') is-invalid @enderror" placeholder="Masukkan halaman" value="{{old('halaman') ?? $daftars->jumlah_halaman}}" spellcheck="false" name="halaman" required>
                    @error('halaman')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label" for="pengarang">Pengarang</label>
                    <input type="text" id="pengarang" class="form-control @error('pengarang') is-invalid @enderror" placeholder="Masukkan pengarang" spellcheck="false" name="pengarang" value="{{old('pengarang') ?? $daftars->pengarang}}" required>
                    @error('pengarang')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="penerbit">Penerbit</label>
                    <select class="form-control" id="penerbit" name="penerbit">
                        @foreach ($penerbit as $penerbits)
                        @if(!old('penerbit') && $daftars->buku_penerbit->penerbit == $penerbits->penerbit)
                        <option class="select-input" value="{{$daftars->buku_penerbit->id}}" selected>{{$daftars->buku_penerbit->penerbit}}</option>
                        @elseif(old('penerbit') && old('penerbit') == $penerbits->id)
                        <option class="select-input" value="{{old('penerbit')}}" selected>{{$penerbits->penerbit}}</option>
                        @elseif($daftars->buku_penerbit->penerbit == $penerbits->penerbit)
                        <option class="select-input" value="{{$penerbits->id}}">{{$penerbits->penerbit}}</option>
                        @elseif(old('penerbit') == $penerbits->id)
                        @else
                        <option class="select-input" value="{{$penerbits->id}}">{{$penerbits->penerbit}}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label" for="tahun">Tahun Terbit</label>
                    <input type="text" id="tahun" class="form-control @error('tahun') is-invalid @enderror" placeholder="Masukkan tahun" spellcheck="false" name="tahun" value="{{old('tahun') ?? $daftars->tahun_terbit}}" required>
                    @error('tahun')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-control-label" class="form-control-label" for="kondisi">Kondisi</label>
                    <select class="form-control" id="kondisi" name="kondisi">
                        @foreach ($kondisi as $kondisis)
                        @if(!old('kondisi') && $daftars->buku_kondisi->kondisi == $kondisis->kondisi)
                        <option class="select-input" value="{{$daftars->buku_kondisi->id}}" selected>{{$daftars->buku_kondisi->kondisi}}</option>
                        @elseif(old('kondisi') && old('kondisi') == $kondisis->id)
                        <option class="select-input" value="{{old('kondisi')}}" selected>{{$kondisis->kondisi}}</option>
                        @elseif($daftars->buku_kondisi->kondisi == $kondisis->kondisi)
                        <option class="select-input" value="{{$kondisis->id}}">{{$kondisis->kondisi}}</option>
                        @elseif(old('kondisi') == $kondisis->id)
                        @else
                        <option class="select-input" value="{{$kondisis->id}}">{{$kondisis->kondisi}}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-control-label" class="form-control-label" for="status">Status</label>
                    @if(!$pinjam)
                    <select class="form-control" id="status" name="status">
                        @elseif($pinjam->status_id == '1')
                        <select class="form-control" id="status" name="status" disabled readonly>
                            @else
                            <select class="form-control" id="status" name="status">
                                @endif
                                @foreach ($status as $statuss)
                                @if(!old('status') && $daftars->buku_status->status == $statuss->status)
                                <option class="select-input" value="{{$daftars->buku_status->id}}" selected>{{$daftars->buku_status->status}}</option>
                                @elseif(old('status') && old('status') == $statuss->id)
                                <option class="select-input" value="{{old('status')}}" selected>{{$statuss->status}}</option>
                                @elseif($daftars->buku_status->status == $statuss->status)
                                <option class="select-input" value="{{$statuss->id}}">{{$statuss->status}}</option>
                                @elseif(old('status') == $statuss->id)
                                @else
                                <option class="select-input" value="{{$statuss->id}}">{{$statuss->status}}</option>
                                @endif
                                @endforeach
                            </select>
                </div>
            </div>
        </div>

        <label class="form-control-label">Foto Sampul</label>
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="customFileLang" name="sampul" lang="en">
            <label class="custom-file-label form-control @error('sampul') is-invalid @enderror" for="customFileLang">Pilih Gambar</label>
            @error('sampul')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group mt-4">
            <label class="form-control-label">Deskripsi</label>
            <textarea class="form-control @error('deskripsi') is-invalid @enderror" placeholder="Masukkan Deskripsi" rows="3" id="alamat" name="deskripsi" required spellcheck="false">{{old('deskripsi') ?? $daftars->deskripsi}}</textarea>
            @error('deskripsi')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="text-right">
            <button type="submit" class="btn btn-primary" style="margin-top:40px;">Simpan</button>
        </div>
    </form>
</div>
@endif

@if (!empty($detail))
<div class="card-header">
    <div class="row align-items-center">
        <div class="col-8">
            <h3 class="mb-0">Detail Buku</h3>
        </div>
        <div class="col-4 text-right">
            @auth('adm')
            <a type="button" href="{{route('adm-daftar-buku')}}" class="btn btn-sm btn-danger text-white">Kembali</a>
            @endauth
            @auth('peminjam')
            <a type="button" href="{{route('daftar-buku')}}" class="btn btn-sm btn-danger text-white">Kembali</a>
            @endauth
        </div>
    </div>
</div>


<div class="card-body">
    <img class="card-img-top mb-4" style="max-width:200px; max-height:200px; border-radius:3%;" src="{{asset('storage/'.$daftars->foto_sampul)}}" alt="Card image cap">
    <div class="row">
        <div class="col-lg">
            <div class="form-group">
                <label class="form-control-label">Judul</label>
                <input type="text" id="judul" class="form-control" value="{{$daftars->judul}}" disabled readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label class="form-control-label">Kode</label>
                <input type="text" id="kode" class="form-control" value="{{$daftars->kode}}" disabled readonly>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label class="form-control-label">Jumlah Halaman</label>
                <input type="text" id="halaman" class="form-control" value="{{$daftars->jumlah_halaman}}" disabled readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label class="form-control-label">Pengarang</label>
                <input type="text" class="form-control" value="{{$daftars->pengarang}}" disabled readonly>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label class="form-control-label">Penerbit</label>
                <input type="text" class="form-control" value="{{$daftars->buku_penerbit->penerbit}}" disabled readonly>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label class="form-control-label">Tahun Terbit</label>
                <input type="text" class="form-control" value="{{$daftars->tahun_terbit}}" disabled readonly>
            </div>
        </div>
    </div>
    @auth('adm')
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label class="form-control-label">Kondisi</label>
                <input type="text" class="form-control" value="{{$daftars->buku_kondisi->kondisi}}" disabled readonly>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                <label class="form-control-label">Status</label>
                <input type="text" class="form-control" value="{{$daftars->buku_status->status}}" disabled readonly>
            </div>
        </div>
    </div>

    @endauth
    <div class="form-group">
        <label class="form-control-label">Deskripsi</label>
        <textarea class="form-control" rows="3" disabled readonly>{{$daftars->deskripsi}}</textarea>
    </div>
</div>
@endif

@endsection