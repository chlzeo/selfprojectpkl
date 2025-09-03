@extends('layouts.admin.master')

@section('testimoniActive')
    text-primary
@endsection

@section('content')
    <h1 class="mb-4" style="font-size:x-large">Manajemen Testimoni</h1>
    <hr><br>

    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-3">
                {{-- Form Pencarian --}}
                <form action="{{ route('admin.testimoni.index') }}" method="GET" class="d-flex me-3">
                    <input type="text" name="search" class="form-control form-control-sm me-2"
                        placeholder="Cari Testimoni..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-sm btn-outline-secondary">
                        Cari
                    </button>
                    @if (request('search') !== null)
                        <a href="{{ route('admin.testimoni.index') }}" class="btn btn-sm btn-outline-danger ms-2">
                            Reset
                        </a>
                    @endif
                </form>

                <a href="{{ route('admin.testimoni.create') }}" class="btn btn-sm btn-primary px-3">
                    <i class="fas fa-plus me-1"></i> Tambah Testimoni
                </a>
            </div>

            <div class="row gx-4">
                <div class="col-lg-8 mb-3">
                    @if ($testimonis->isEmpty())
                        <div class="alert alert-warning text-center" role="alert">
                            Tidak ada testimoni yang ditemukan.
                        </div>
                    @else
                        <table class="table table-bordered table-striped small">
                            <thead>
                                <tr class="text-center">
                                    <th width="5%">No.</th>
                                    <th>Pesan</th>
                                    <th>Rating</th>
                                    <th width="20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($testimonis as $val)
                                    <tr>
                                        <td class="text-center">
                                            {{ isset($testimonis->firstItem) ? $loop->iteration + $testimonis->firstItem() - 1 : $loop->iteration }}
                                        </td>
                                        <td>{{ $val->message }}</td>
                                        <td>{{ $val->rating }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.testimoni.edit', $val->id) }}"
                                                class="btn btn-sm btn-success">
                                                <i class="fas fa-pencil"></i>
                                            </a>
                                            <form action="{{ route('admin.testimoni.destroy', $val->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus Testimoni ini? Tindakan ini tidak dapat dibatalkan.')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            {{ $testimonis->links('pagination::bootstrap-4') }}
                        </div>
                    @endif
                </div>
                <!-- Chart removed for testimony management -->
            </div>
        </div>
    </div>
@endsection