@extends('template')
@section('content')
<div class="col-md-12">
    <div class="card card-primary card-outline">
        <div class="card-body">
            <h3>Data Gaji</h3>
            <div class="row">
                <div class="float-left md-2">
                    <button type="button" onclick="add()" class="btn btn-info btn-sm"><i
                            class="fa fa-plus"></i></button>
                </div>
                <div class="col-md-12">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width:5%">No</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th style="width:10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($karyawan as $i => $a)
                            <tr>
                                <td>{{$i+1}}</td>
                                <td>{{$a->nama}}</td>
                                <td>{{$a->jabatan}}</td>
                                <td>
                                    <button type="button" onclick="detail('{{$a->id_user}}')"
                                        class="btn btn-info btn-sm"><i class="fa fa-search"></i></button>
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
                        <label for="id_user">Nama Karyawan</label>
                        <input type="hidden" id="id" name="id">
                        <select class="form-control select2" name="id_user" id="id_user" style="width: 100%;">
                            <option value="">-Pilih-</option>
                            @foreach($karyawan as $i => $karyawans)
                            <option Value="{{ $karyawans->id_user}}">{{ $karyawans->nama}}</option>
                            @endforeach
                        </select>
                    </div>
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

<!-- modal detail -->
<div class="modal fade" id="modal_detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Gaji</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id_user">
                <div id="isi"></div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<script>
    function add() {
        $('#myModal').modal()
    }

    function detail(id) {
        $('#id_user').val(id)
        $('#isi').load('data-gaji-detail/'+id)
        $('#modal_detail').modal()
    }

    function deleteGaji(id) {
        var confimit = confirm("Yakin ingin hapus?");
        if (confimit) {
            var id_user =  $('#id_user').val()
            $.ajax({
                url: 'data-gaji-del',
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'id': id
                },
                dataType: 'json',
                success: function(res)
                {
                    console.log(res);
                    $('#isi').load('data-gaji-detail/'+ id_user)
                }
            })
        }
    }

</script>
@endsection
