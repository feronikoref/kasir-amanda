@extends('layout.layout')
@section('content')
    <div class="content-body">

        <div class="row page-titles mx-0">
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">{{ $title }}</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $title }}</a></li>
                </ol>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Data Berita</h4>
                            <button class="btn btn-primary btn-round" data-toggle="modal" data-target="#modalCreate">
                                <i class="fa fa-plus"></i>
                                Tambah Data
                            </button>
                            <a class="btn btn-primary btn-round ml-auto" href="/lap_barang" target="_blank">
                                <i class="fa fa-print"></i>
                                Cetak Data
                            </a>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered zero-configuration">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Jenis</th>
                                            <th>Stok</th>
                                            <th>Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($data_barang as $row)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $row->nama_barang }}</td>
                                                <td>{{ $row->nama_jenis }}</td>
                                                <td>{{ $row->stok }} Pcs</td>
                                                <td>Rp. {{ number_format($row->harga) }}</td>
                                                <td>
                                                    <button href="#modalEdit{{ $row->id }}" data-toggle="modal"
                                                        class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></button>

                                                    <button href="#modalHapus{{ $row->id }}" data-toggle="modal"
                                                        class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create {{ $title }}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <form method="POST" action="/barang/store">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Barang</label>
                            <input type="text" class="form-control" name="nama_barang" placeholder="Nama Barang..."
                                required>
                        </div>
                        <div class="form-group">
                            <label>Jenis Barang</label>
                            <select class="form-control" name="id_jenis" required>
                                <option value="">--Pilih Jenis Barang--</option>
                                @foreach ($data_jenis as $b)
                                    <option value="{{ $b->id }}">{{ $b->nama_jenis }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <input type="number" name="stok" placeholder="stok ..." class="form-control" required>
                            <div class="input-group-append"><span class="input-group-text">pcs</span>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend"><span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" name="harga" class="form-control" placeholder="Harga" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                class="fa fa-undo">Close</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save">Save changes</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    @foreach ($data_barang as $u)
        <div class="modal fade" id="modalEdit{{ $u->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit {{ $title }}</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="/barang/update/{{ $u->id }}">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nama Barang</label>
                                <input type="text" class="form-control" name="nama_barang" value="{{ $u->nama_barang }}"
                                    placeholder="Nama Barang..." required>
                            </div>
                            <div class="form-group">
                                <label>Jenis Barang</label>
                                <select class="form-control" name="id_jenis" required>
                                    <option value="{{ $u->id_jenis }}">--Pilih Jenis Barang--</option>
                                    @foreach ($data_jenis as $b)
                                        <option value="{{ $b->id }}" hidden>{{ $b->nama_jenis }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group mb-3">
                                <input type="number" name="stok" placeholder="stok ..." class="form-control"
                                    required>
                                <div class="input-group-append"><span class="input-group-text">pcs</span>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend"><span class="input-group-text">Rp</span>
                                </div>
                                <input type="number" name="harga" class="form-control" placeholder="Harga" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                        class="fa fa-undo"></i></button>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>
                                    changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    @foreach ($data_barang as $d)
        <div class="modal fade" id="modalHapus{{ $d->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Hapus {{ $title }}</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <form method="post" action="/barang/destroy/{{ $d->id }}">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <h5>Apakah Anda Ingin menghapus Data Ini ?</h5>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                    class="fa fa-undo"></i></button>
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
