@extends('template')
@section('content')
<div class="col-md-12">
    <div class="card card-primary card-outline">
        <div class="card-body">
        <h3>Data Bonus</h3>
        <hr>
            <div class="row">
                <div class="float-left md-2">
                    <a href="{{ route('bonus-tambah') }}" class="btn btn-info btn-sm"><i class="fa fa-plus"></i></a>
                </div>
                <div class="col-md-12">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width:5%">No</th>
                                <th>Project</th>
                                <th>Lama Proses</th>
                                <th>Harga Project Kotor</th>
                                <th>Harga Project Operasional</th>
                                <th>Harga Project Bersih</th>
                                <th>Bonus Persen</th>
                                <th>Bonus Harga</th>
                                <th style="width:10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($project as $i => $a)
                                <tr>
                                    <td>{{ $i+1 }}</td>
                                    <td>{{ $a->judul }}</td>
                                    <td>{{ $a->bonus_hari }}  Hari</td>
                                    <td>Rp. {{ number_format($a->bonus_harga_project) }}</td>
                                    <td>Rp. {{ number_format($a->bonus_harga_operasional) }}</td>
                                    <td>Rp. {{ number_format($a->bonus_harga_bersih) }}</td>
                                    <td>{{ $a->bonus_persen }} %</td>
                                    <td>Rp. {{ number_format($a->bonus_harga) }}</td>
                                    <td>
                                        <button type="button" onclick="detail('{{ $a->bonus_id }}')" class="btn btn-info btn-sm"><i class="fa fa-search"></i></button>
                                        <button onclick="hapus('{{ $a->id_project }}')" class="btn btn-danger btn-sm"><i class="text-white fa fa-trash"></i></button>
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Detail Bonus</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class="row" id="isi"></div>
        </div>

        </div>
    </div>
</div>

<script>
    function detail(bonus_id)
    {
        $('#isi').load('bonus-detail/'+ bonus_id)
        $('#myModal').modal()
    }

    function hapus(id){
        var confimit = confirm("Yakin ingin hapus?");
        if (confimit) {
            $.ajax({
                url: 'data-bonus-del',
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'id_project': id
                },
                dataType: 'json',
                success: function(res)
                {
                    location.reload();
                }
            })
        }
    }
</script>
@endsection