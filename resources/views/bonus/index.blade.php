@extends('template')
@section('content')
<div class="col-md-12">
    <div class="card card-primary card-outline">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width:5%">No</th>
                                <th>Project</th>
                                <th>Progress</th>
                                <th>Tanggal Selesai</th>
                                <th>Creator</th>
                                <th>Bonus</th>
                                <th style="width:10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($project as $i => $a)
                                <tr>
                                    <td>{{$i+1}}</td>
                                    <td>{{$a['judul']}}</td>
                                    <td>{{$a['lama']}}  Hari</td>
                                    <td>{{$a['tanggal']}}</td>
                                    <td>{{$a['tanggal']}}</td>
                                    <td>{{$a['tanggal']}}</td>
                                    <td>
                                        <button type="button" onclick="edit()" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
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
        <h4 class="modal-title">Data Gaji</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <form action="{{route('data-gaji-add')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="hari_kerja">Hari Kerja</label>
                <input type="number" name="hari_kerja" id="hari_kerja" Placeholder="26" class="form-control">
            </div>
            <div class="form-group">
                <label for="gaji">Gaji</label>
                <input type="number" name="gaji" id="gaji" Placeholder="Rp ..." class="form-control">
            </div>
            <div class="form-group">
                <label for="tanggal_gajian">Tanggal</label>
                <input type="date" name="tanggal_gajian" id="tanggal_gajian" class="form-control">
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

    function edit(id,gaji)
    {
        $('#id').val(id)
        $('#id_user').val(id_user)
        $('#gaji').val(gaji)
        $('#tanggal_gajian').val(tanggal_gajian)
        $('#myModal').modal()
    }
</script>
@endsection