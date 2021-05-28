@extends('template')
@section('content')
<div class="col-md-12">
    <div class="card card-primary card-outline">
        <form action="{{ route('bonus-simpan') }}" method="post">
        @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">        
                            <label>Nama Project</label>
                            <select class="form-control select2" name="id_project" id="id_project" style="width: 100%;">
                                <option value="">-Pilih-</option>
                                @foreach($project as $i => $a)
                                <option Value="{{ $a->id_project }}">{{ $a->judul }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">        
                            <label>Proses Pengerjaan</label>
                            <input type="text" class="form-control" name="bonus_hari" id="bonus_hari" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">        
                            <label>Harga Project</label>
                            <input type="text" class="form-control" name="bonus_harga_project_text" id="bonus_harga_project_text" readonly>
                            <input type="hidden" class="form-control" name="bonus_harga_project" id="bonus_harga_project" readonly>
                        </div>
                    </div>
                </div>
                <div class="row" id="isi">

                </div>    
            </div>
        </form>
    </div>
</div>

<script>

    $('#id_project').change(function (e) { 
        e.preventDefault();
        var id_project = $('#id_project').val();
        if(id_project != ''){
            $.ajax({
                type: "POST",
                url: "bonus-cari-harga",
                data: {
                    '_token' : '{{ csrf_token() }}',
                    'id_project' : id_project
                },
                dataType: "json",
                success: function (res) {
                    console.log(res.data);
                    $('#bonus_hari').val(res.data.lama)
                    $('#bonus_harga_project_text').val(new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(res.data.harga))
                    $('#bonus_harga_project').val(res.data.harga)
                    $('#isi').load('bonus-programmer/'+ id_project)

                    setTimeout(() => {
                        var bonus_harga_operasional = $('#bonus_harga_operasional').val()
                        $('#bonus_harga_bersih_text').val(new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(res.data.harga - bonus_harga_operasional))
                        $('#bonus_harga_bersih').val(res.data.harga - bonus_harga_operasional)
                    }, 1500);
                }
            });
        }else{
            $('#bonus_hari').val('')
            $('#bonus_harga_project_text').val('')
            $('#bonus_harga_project').val('')
            $('#isi').html('')
        }   
    });
    function bonusProjectPersen() { 
        var bonus_persen = $('#bonus_persen').val();
        var bonus_harga_bersih = $('#bonus_harga_bersih').val();

        var bonus_harga_text = Math.round(bonus_harga_bersih * bonus_persen / 100);
        $('#bonus_harga').val(bonus_harga_text)
        $('.bonus').text(new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(bonus_harga_text))
        $('.bonus_programmer_harga_text').text('')
        $('.bonus_programmer_harga').val('')
        $('.bonus_persen').val('')
        $('#bonus_harga_text').val(new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(bonus_harga_text))

    }

    function bonusProgrammer(val, id) { 
        var bonus_harga = $('#bonus_harga').val();
        $(`#bonus_programmer_harga_text${id}`).text(new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(Math.round(bonus_harga * val / 100)))
        $(`#bonus_programmer_harga${id}`).val(Math.round(bonus_harga * val / 100))
    }
    
</script>

@endsection