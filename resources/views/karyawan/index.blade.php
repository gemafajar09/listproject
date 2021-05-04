@extends('template')
@section('content')
<div class="col-md-12">
    <div class="card card-primary card-outline">
        <div class="card-body">
            <div class="row">
                <div class="float-left mb-2">
                    <button type="button" onclick="add()" class="btn btn-info btn-sm"><i class="fa fa-plus"></i></button>
                </div>
                <div class="col-md-12">
                    <div class="row d-flex align-items-stretch">
                        @foreach($karyawan as $i => $a)
                        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                            <div class="card bg-light">
                                <div class="card-header text-muted border-bottom-0">
                                {{$a->jabatan}}
                                </div>
                                <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-7">
                                    <h2 class="lead"><b>{{$a->nama}}</b></h2>
                                    <p class="text-muted text-sm"><b>Username: </b>{{$a->username}}</p>
                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: {{$a->alamat}}</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone : + {{$a->notelpon}}</li>
                                    </ul>
                                    </div>
                                    <div class="col-5 text-center">
                                    <img src="{{asset('/image/'.$a->foto)}}" alt="" class="img-circle img-fluid">
                                    </div>
                                </div>
                                </div>
                                <div class="card-footer">
                                <div class="text-right">
                                    <a href="https://api.whatsapp.com/send?phone=082122855458&text=hallo" target="_blank" class="btn btn-sm bg-teal">
                                    <i class="fas fa-comments"></i>
                                    </a>
                                    <a href="" class="btn btn-sm bg-red">
                                    <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
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
        <h4 class="modal-title">Data karyawan</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <form action="{{route('data-karyawan-add')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="">Nama</label>
                <input type="text" name="nama" id="nama" Placeholder="Nama" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Jabatan</label>
                <select name="jabatan" id="jabatan" class="form-control">
                    <option value="">-JABATAN-</option>
                    @foreach($jabatan as $jab)
                    <option value="{{$jab->id_jabatan}}">{{$jab->jabatan}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Alamat</label>
                <textarea name="alamat" id="alamat" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="">No. Telpon</label>
                <input type="number" name="notelp" id="notelp" Placeholder="08xxx" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Username</label>
                <input type="text" name="username" id="username" Placeholder="Username" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" name="password" id="password" Placeholder="*******" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Ulangi Password</label>
                <input type="password" name="password1" id="password1" Placeholder="*******" class="form-control">
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
</script>
@endsection