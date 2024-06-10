@extends('layouts.adm-main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tambah Barang Keluar</div>

                    <div class="card-body">
                        <!-- Tambahkan blok ini untuk menampilkan pesan error -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('barangkeluar.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="tgl_keluar">Tanggal Keluar:</label>
                                <input type="date" name="tgl_keluar" id="tgl_keluar" class="form-control" value="{{ old('tgl_keluar') }}" required>
                                @if ($errors->has('tgl_keluar'))
                                    <span class="text-danger">{{ $errors->first('tgl_keluar') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="qty_keluar">Jumlah Keluar:</label>
                                <input type="number" name="qty_keluar" id="qty_keluar" class="form-control" value="{{ old('qty_keluar') }}" required>
                                @if ($errors->has('qty_keluar'))
                                    <span class="text-danger">{{ $errors->first('qty_keluar') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="barang_id">Barang:</label>
                                <select name="barang_id" id="barang_id" class="form-control" required>
                                    @foreach ($barangs as $barang)
                                        <option value="{{ $barang->id }}" {{ old('barang_id') == $barang->id ? 'selected' : '' }}>
                                            {{ $barang->merk }} - {{ $barang->seri }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('barang_id'))
                                    <span class="text-danger">{{ $errors->first('barang_id') }}</span>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary">Tambah Barang Keluar</button>

                            <a href="{{ route('barangkeluar.index') }}" class="btn btn-secondary">Kembali</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
