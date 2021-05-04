@extends('template')
@section('content')
<div class="col-md-12">
    <div class="card card-primary card-outline">
        <div class="card-body">
        <div class="row">
            <div class="col-md-12 mb-2">
                <div class="float-left">
                    <button type="button" onclick="add()" class="btn btn-info btn-sm"><i class="fa fa-plus"></i></button>
                </div>
            </div>
            <div class="col-md-12">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width:5%">No</th>
                            <th style="width:15%">Nama Projek</th>
                            <th style="width:20%">Deskripsi</th>
                            <th style="width:15%">Nama Client</th>
                            <th style="width:10%">Tgl Masuk</th>
                            <th style="width:10%">Tgl Dateline</th>
                            <th style="width:10%">Status</th>
                            <th style="width:15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($projek as $i => $a)
                        <tr>
                            <td>{{$i+1}}</td>
                            <td>{{$a->judul}}</td>
                            <td>{{$a->deskripsi}}</td>
                            <td>{{$a->nama_client}}</td>
                            <td>{{$a->tanggal_masuk}}</td>
                            <td>{{$a->tanggal_dateline}}</td>
                            <td>
                                @if($a->status == 0)
                                <span>Waiting</span>
                                @elseif($a->status == 1)
                                <span>Progres</span>
                                @elseif($a->status == 2)
                                <span>Finish</span>
                                @endif
                            </td>
                            <td align="center">
                                <button class="btn btn-info btn-sm" onclick="add_detail('{{$a->id_project}}')"><i class="fa fa-info"></i></button>
                                <button class="btn btn-warning btn-sm" onclick="edit(
                                    '{{$a->id_project}}',
                                    '{{$a->judul}}',
                                    '{{$a->deskripsi}}',
                                    '{{$a->tanggal_masuk}}',
                                    '{{$a->tanggal_dateline}}',
                                    '{{$a->nama_client}}',
                                    '{{$a->no_hp_client}}',
                                    '{{$a->harga}}'
                                    )"><i class="fa fa-edit"></i></button>
                                <a href="{{route('projek-masuk-del',$a->id_project)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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

<div class="modal" id="myModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Data Project</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form action="{{route('projek-masuk-add')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="">Nama Project</label>
                <input type="hidden" id="id" name="id">
                <input type="text" name="judul" id="judul" class="form-control" placeholder="Nama Project">
            </div>
            <div class="form-group">
                <label for="">Deskripsi</label>
                <input type="text" name="deskripsi" id="deskripsi" class="form-control" placeholder="Deskripsi">
            </div>
            <div class="form-group">
                <label for="">Tanggal Masuk</label>
                <input type="date" name="tgl_masuk" id="tgl_masuk" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Tanggal Dateline</label>
                <input type="date" name="tgl_dateline" id="tgl_dateline" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Nama Client</label>
                <input type="text" name="nama_client" id="nama_client" class="form-control" placeholder="Nama Client">
            </div>
            <div class="form-group">
                <label for="">No. Hp Client</label>
                <input type="number" name="hp_client" id="hp_client" class="form-control" placeholder="08xxxxxx">
            </div>
            <div class="form-group">
                <label for="">Harga Project</label>
                <input type="number" name="harga" id="harga" class="form-control" placeholder="Harga Project">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Simpan</button>
        </form>
      </div>

    </div>
  </div>
</div>

<div class="modal" id="myModal1">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Detail Project</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form action="{{route('projek-masuk-add')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="">Fitur</label>
                <input type="hidden" id="id" name="id">
                <input type="text" name="fitur" id="fitur" class="form-control" placeholder="Fitur">
            </div>
            <button type="button" onclick="simpan()" class="btn btn-primary btn-block">Simpan</button>
        </form>
        <div class="row">
            <div class="col-md-12 pt-2">
                <div id="isi"></div>
            </div>
        </div>
      </div>

    </div>
  </div>
</div>

<script>
    function add()
    {
        $('#myModal').modal()
    }

    function edit(id,judul,deskripsi,tgl_masuk,tgl_dateline,nama_client,hp_client,harga)
    {
        $('#id').val(id);
        $('#judul').val(judul);
        $('#deskripsi').val(deskripsi);
        $('#tgl_masuk').val(tgl_masuk);
        $('#tgl_dateline').val(tgl_dateline);
        $('#nama_client').val(nama_client);
        $('#hp_client').val(hp_client);
        $('#harga').val(harga);
        $('#myModal').modal()
    }
    
    function add_detail(id)
    {
        $('#id').val(id)
        $('#isi').load('detail-fitur/'+id)
        $('#myModal1').modal()
    }

    function simpan()
    {
        var id = $('#id').val();
        var fitur = $('#fitur').val();

        $.ajax({
            url: 'detail-fitur-add',
            type: 'POST',
            data: {
                '_token': '{{ csrf_token() }}',
                'id': id, 
                'fitur': fitur
            },
            dataType: 'json',
            success: function(res)
            {
                $('#fitur').val('');
                $('#isi').load('detail-fitur/'+id)
            }
        })
    }

    function deletefitur(id)
    {
        var idtabel = $('#id').val();
        $.ajax({
            url: 'detail-fitur-del',
            type: 'POST',
            data: {
                '_token': '{{ csrf_token() }}',
                'id': id
            },
            dataType: 'json',
            success: function(res)
            {
                $('#isi').load('detail-fitur/'+idtabel)
            }
        })
    }

</script>
@endsection