@extends('layouts.default')

@section('content')
<div class="orders">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-body">
                        <h4 class="box-title">Daftar Transaksi Masuk</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-stats order-table ov-h">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Nomor</th>
                                        <th>Total Transaksi</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- foreales adalah looping dari controller di product controller yakni $items --}}
                                    @forelse ($items as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->number }}</td>
                                        <td>Rp.{{ number_format($item->transaction_total, 0, ', ','.') }}</td>
                                        <td>
                                            @if($item->transaction_status == 'PENDING')
                                            <span class="badge badge-info">
                                                @elseif($item->transaction_status == 'SUCCESS')
                                                <span class="badge badge-success">
                                                    @elseif($item->transaction_status == 'FAILED')
                                                    <span class="badge badge-danger">
                                                        @else
                                                        <span>
                                                            @endif
                                                            {{ $item->transaction_status }}
                                                        </span>
                                        </td>
                                        <td>

                                            @if ($item->transaction_status == 'PENDING')
                                            <a href="{{ route('transactions.status', $item->id) }}?status=SUCCESS"
                                               class="btn btn-success btn-sm"><i class="fa fa fa-check"></i>
                                            </a>
                                            <a href="{{ route('transactions.status', $item->id) }}?status=FAILED"
                                               class="btn btn-warning btn-sm"><i class="fa fa fa-times"></i>
                                            </a>

                                            @endif
                                            {{-- manggil data berdasarkan id yakni di $items->id --}}
                                            <a href="#mymodal"
                                               data-remote="{{ route('transactions.show', $item->id) }}"
                                               data-toggle="modal"
                                               data-target="#mymodal"
                                               data-title="Detail Transaksi {{ $item->uuid }}"
                                               class="btn btn-info btn-sm">
                                                <i class="fa fa-eye">

                                                </i>
                                            </a>
                                            <a href="{{ route('transactions.edit', $item->id) }}"
                                               class="btn btn-primary btn-sm">
                                                <i class="fa fa-pencil">

                                                </i>
                                            </a>
                                            <form action="{{ route('transactions.destroy', $item->id) }}"
                                                  method="post"
                                                  class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash">

                                                    </i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty

                                    {{-- ini adalah empty jadi jika data ga ada akan di tampilkan perintah di bawah --}}
                                    <tr>
                                        <td colspan="6"
                                            class="text-center p-5">
                                            Data Tidak Tersedia
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection