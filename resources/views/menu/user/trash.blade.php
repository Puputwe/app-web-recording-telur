@extends('layouts.master')
@section('heading', 'Trash User')
@section('page')
    <li class="breadcrumb-item active">Trash User</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-olive card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <a href="/user/delete_all" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus Semua</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        <table id="user-datatable" class="table table-bordered" style="width:100%">
                            <thead>
                                <tr class="table-secondary">
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no=1; @endphp
                                @foreach ($user_trash as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->role }}</td>
                                        <td><span class="badge {{ ($item->status == 'aktif') ? 'bg-success' : 'bg-danger' }}">{{ ($item->status ==
                                            'aktif') ? 'aktif' : 'non-aktif' }}</span></td>
                                        <td>
                                            <a href="/user/restore/{{$item->id}}" class="btn btn-success btn-sm">Restore</a>
                                            <a href="/user/delete_kill/{{$item->id}}" class="btn btn-danger btn-sm">Hapus Permanen</a>
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
@include('sweetalert::alert')
@endsection

@section('footer')
<script>
    $(document).ready(function() {
        $('#user-datatable').DataTable();
    });
</script>

@endsection
