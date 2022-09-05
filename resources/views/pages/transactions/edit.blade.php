@extends('layouts.default')


@section('content')
<div class="card">
    <div class="card-header">
        <strong>Edit Transaksi</strong>
        <small>{{ $item->uuid }}</small>
    </div>
    <div class="card-body card-block">
        <form action="{{ route('transactions.update', $item->id) }}"
              method="POST">
            @method('PUT')
            {{-- method laravel edit --}}
            @csrf
            <div class="form-group">
                <label for="name"
                       class="form-control-label">Nama Pemesan</label>
                <input type="text"
                       name="name"
                       value="{{ old('name') ? old('name') : $item->name }}"
                       {{--
                       gunanya
                       {{
                       old('name')
                       ?
                       old('name')
                       :
                       $item->name }} adalah jika data old ada maka akan di tampilkan, jika tidak maka akan menmapilkan
                data di database nya yakni $item->name }} --}} {{-- old gunanya untuk menampilkan data yang sudah pernah
                di inputkan sebelumnya --}} {{-- invalid error gunanya untuk menanyakan data nya ada atau engga --}}
                class="form-control @error('name') is-invalid @enderror" />
                @error('name')
                <div class="text-muted">{{ $message }}</div>
                @enderror
                {{-- gunanya untuk menampilkan pesan error --}}
            </div>
            <div class="form-group">
                <label for="email"
                       class="form-control-label">Email</label>
                <input type="text"
                       name="email"
                       value="{{ old('type') ? old('email') : $item->email }}"
                       class="form-control @error('email') is-invalid @enderror" />
                @error('email')
                <div class="text-muted">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="number"
                       class="form-control-label">Nomor HP</label>
                <input type="number"
                       name="number"
                       value="{{ old('number') ? old('number') : $item->number }}"
                       class="form-control @error('number') is-invalid @enderror" />
                @error('number')
                <div class="text-muted">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="address"
                       class="form-control-label">Kuantitas Barang</label>
                <input type="text"
                       name="address"
                       value="{{ old('address') ? old('address') : $item->address }}"
                       class="form-control @error('address') is-invalid @enderror" />
                @error('address')
                <div class="text-muted">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-block"
                        type="submit">Edit Transaksi</button>
            </div>
        </form>
    </div>
</div>
@endsection