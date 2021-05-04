@extends('template')
@section('content')
<div class="col-md-12">
    <div class="card card-primary card-outline">
        <div class="card-body">
            <div class="row">
                <div class="float-left md-2">
                    <button type="button" onclick="add()" class="btn btn-info btn-sm"><i class="fa fa-plus"></i></button>
                </div>
                <div class="col-md-12">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width:5%">No</th>
                                <th style="width:85%">Jabatan</th>
                                <th style="width:10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jabatan as $i => $a)
                                <tr>
                                    <td>{{$i+1}}</td>
                                    <td>{{$a->jabatan}}</td>
                                    <td>
                                        <button type="button" onclick="edit('{{$a->id_jabatan}}','{{$a->jabatan}}')" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
                                        <a href="{{route('data-jabatan-del',$a->id_jabatan)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Data Jabatan</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <form action="{{route('data-jabatan-add')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="">Nama</label>
                <input type="hidden" id="id" name="id">
                <input type="text" name="jabatan" id="jabatan" Placeholder="Jabatan" class="form-control">
            </div>
            <button type="submit" class="btn btn-info btn-block">Simpan</button>
        </form>
      </div>

    </div>
  </div>
</div>

<script>
    function add()
    {
        $('#myModal').modal()
    }
   
    function edit(id,jabatan)
    {
        $('#id').val(id)
        $('#jabatan').val(jabatan)
        $('#myModal').modal()
    }
</script>
@endsection