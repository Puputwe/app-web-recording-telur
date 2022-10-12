@extends('layouts.master')
@section('heading', 'User')
@section('page')
    <li class="breadcrumb-item active">User</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#userModal">
                                Tambah data
                            </button>
                    </div>
                    <div class="card-body">
                        <table id="user-datatable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
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
                                @foreach ($user as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->role }}</td>
                                        <td><span class="badge {{ ($item->status == 'aktif') ? 'bg-success' : 'bg-danger' }}">{{ ($item->status ==
                                            'aktif') ? 'aktif' : 'non-aktif' }}</span></td>
                                        <td>
                                            @if($item->status == 'aktif')
                                                <a href="/user/{{$item->id}}/upStatus" class="btn btn-secondary btn-sm" user-id="{{$item->id}}"><i class="nav-icon fas fa-ban"></i></a>
                                            @else
                                                <a href="/user/{{$item->id}}/upStatus" class="btn btn-success btn-sm" user-id="{{$item->id}}"><i class="nav-icon fas fa-check"></i></a>
                                            @endif
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModaluser{{$item->id}}">
                                                <i class="fa fa-edit"></i> 
                                                Edit
                                              </button>
                                            <a href="#" class="btn btn-danger btn-sm delete" user-id="{{ $item->id }}"><i class="nav-icon fas fa-trash"></i>
                                                Hapus</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{-- Tambah Data User--}}
                        <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah data ayam</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/user/create" method="POST">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <label>Nama Lengkap</label>
                                                <input type="text" name="name" class="form-control" id="name"
                                                    placeholder="Masukan Nama Lengkap" required>
                                            </div>
                                            <div class="form-group">
                                                <label>E-Mail</label>
                                                <input type="text" name="email" class="form-control" id="email"
                                                    placeholder="contoh : nama@gmail.com" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Role</label>
                                                <select name="role_id" class="form-control" id="role_id" required>
                                                  <option value="">--Pilih Role--</option>
                                                  @foreach ($role as $k)
                                                  <option value="{{ $k->id }}">{{ $k->id}}
                                                  </option>
                                                 @endforeach
                                                </select>
                                            </div>   
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" name="password" class="form-control" id="password"
                                                    placeholder="Buat Password" required>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Edit Data User --}}
                        @foreach ($user as $d )
                        <div class="modal fade" id="editModaluser{{$d->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah data ayam</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/user/{{$d->id}}/update" method="POST">
                                            @csrf
                                            <input type="text" name="email" hidden="" class="form-control" id="email" value="{{$d->status}}">
                                            <div class="form-group">
                                                <label>Nama Lengkap</label>
                                                <input type="text" name="name" class="form-control" id="name"
                                                    value="{{$d->name}}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>E-Mail</label>
                                                <input type="text" name="email" class="form-control" id="email"
                                                value="{{$d->email}}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Role</label>
                                                <select name="role_id" class="form-control" id="role_id" required>
                                                      <option value="{{ $d->role_id }}">{{$d->role}}</option>
                                                  @foreach ($role as $u)
                                                     <option value="{{$u->id}}">{{$u->role}}</option>
                                                  @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" name="password" class="form-control" id="password"
                                                   value="{{$d->password}}" required>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @include('sweetalert::alert')
                    @endsection

                    @section('footer')
                        <script>
                            $('.delete').click(function() {
                                var user_id = $(this).attr('user-id');
                                swal({
                                        title: "Hapus User",
                                        text: "Yakin akan menghapus data user ini ?",
                                        icon: "warning",
                                        buttons: true,
                                        dangerMode: true,
                                    })
                                    .then((willDelete) => {
                                        console.log(willDelete);
                                        if (willDelete) {
                                            window.location = "/user/" + user_id + "/delete"
                                        }
                                    });
                            });
                        </script>

                        <script>
                            $(document).ready(function() {
                                $('#user-datatable').DataTable();
                            });
                        </script>

                    @endsection
