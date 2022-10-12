@extends('layouts.master')
@section('heading', 'User Role')
@section('page')
  <li class="breadcrumb-item active">User Role</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModalrole">
                      <i class="fa fa-plus"></i>  
                      Tambah data
                    </button>
                 </div>
                <div class="card-body">   
                <table id="role-datatable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                       @php $no=1; @endphp
                        @foreach ($role as $data )
                        <tr>
                          <td>{{$no++}}</td>
                            <td>{{$data->role}}</td>
                            <td>
                              <a href="#" class="btn btn-danger btn-sm delete" role-id="{{$data->id}}"><i class="nav-icon fas fa-trash"></i> Hapus</a>
                            
                              {{-- <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModalrole{{$data->id}}">
                                <i class="fa fa-edit"></i> 
                                Edit
                              </button> --}}
                            </td>
                        </tr>
                            @endforeach
                    </tbody>
                </table>

                {{-- Modal Tambah Data --}}
                <div class="modal fade" id="addModalrole" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Tambah data</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <form action="/role/store" method="POST">
                                @csrf
                                <div class="form-group">
                                  <input type="text" name="role" class="form-control" id="role" placeholder="Role..." required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                  </div>
                            </form>
                        </div>
                      </div>
                    </div>
                  </div> 

                  @foreach ($role as $edit)
                  {{-- Modal Edit Data --}}
                    <div class="modal fade" id="editModalrole{{$edit->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Editdata</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <form action="/role/{{$edit->id}}/update" method="POST">
                                @csrf
                                <div class="form-group">
                                  <input type="text" name="role" value="{{$edit->role}}" class="form-control" id="role" placeholder="Role..." required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
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
    $('.delete').click(function(){
      var role_id = $(this).attr('role-id');
      swal({
        title: "Hapus Data",
        text: "Yakin akan menghapus data role ini ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        console.log(willDelete);
        if (willDelete) {
            window.location = "/role/"+role_id+"/delete"
        }
      });
    });
  </script>

  <script>
    $(document).ready( function () {
    $('#role-datatable').DataTable();
  } );
  </script>

@endsection