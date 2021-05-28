<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Biaya Operasional</th>
        <th>Lama Pengerjaan</th>
        <th>Total</th>
    </tr>
    <?php 
    $sub = 0;
    ?> 
    @foreach($programmer as $no => $prg)
    <?php 
    $sub += (floor(($prg->gaji / $prg->hari_kerja) * $prg->total));
    ?>
    <tr>
        <td>{{ $no + 1 }}</td>
        <td>{{ $prg->nama }}</td>
        <td>
            Rp. {{ number_format(floor($prg->gaji / $prg->hari_kerja)) }}
            <input type="hidden" id="bonus_programmer_operasional" name="bonus_programmer_operasional[]" value="{{ (floor($prg->gaji / $prg->hari_kerja)) }}">
        </td>
        <td>
            {{ $prg->total }}
            <input type="hidden" id="bonus_programmer_lama" name="bonus_programmer_lama[]" value="{{ $prg->total }}">
        </td>
        <td>Rp. {{ number_format(floor(($prg->gaji / $prg->hari_kerja) * $prg->total)) }}</td>
    </tr>
    @endforeach
    <tr>
        <th colspan="4">Total</th>
        <th>
            Rp. {{ number_format($sub) }}
            <input type="hidden" id="bonus_harga_operasional" name="bonus_harga_operasional" value="{{ $sub }}">
        </th>
    </tr>
</table>
<div class="col-md-12">
    <hr>
</div>
<div class="col-md-4">
    <div class="form-group">        
        <label>Total Bersih Keuntungan</label>
        <input type="text" class="form-control" name="bonus_harga_bersih_text" id="bonus_harga_bersih_text" readonly>
        <input type="hidden" class="form-control" name="bonus_harga_bersih" id="bonus_harga_bersih" readonly>
    </div>
</div>
<div class="col-md-4">
    <div class="form-group">        
        <label>Bonus (%)</label>
        <input type="text" class="form-control" name="bonus_persen" id="bonus_persen" onkeyup="bonusProjectPersen()" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
    </div>
</div>
<div class="col-md-4">
    <div class="form-group">        
        <label>Bonus Project</label>
        <input type="text" class="form-control" name="bonus_harga_text" id="bonus_harga_text" readonly>
        <input type="hidden" class="form-control" name="bonus_harga" id="bonus_harga" readonly>
    </div>
</div>
<div class="col-md-12">
    <hr>
</div>
<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Bonus Project</th>
        <th>Persen(%)</th>
        <th>Total</th>
    </tr>
    @foreach($programmer as $no => $prgm)

    <tr>
        <td>{{ $no + 1 }}</td>
        <td>
            {{ $prgm->nama }}
            <input type="hidden" id="id_user" name="id_user[]" value="{{ $prgm->id_user }}">    
        </td>
        <td>
            <span class="bonus"></span>
        </td>
        <td>
            <input type="text" name="bonus_programmer_persen[]" class="form-control bonus_persen" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" onkeyup="bonusProgrammer(this.value, '{{ $no + 1 }}')">
        </td>
        <td>
            <span id="bonus_programmer_harga_text{{ $no + 1 }}" class="bonus_programmer_harga_text"></span>
            <input type="hidden" name="bonus_programmer_harga[]" class="form-control bonus_programmer_harga" id="bonus_programmer_harga{{ $no + 1 }}" readonly>
        </td>
    </tr>
    @endforeach
</table>
<div class="col-md-12">
    <button class="btn btn-primary" type="submit"  onclick="if (confirm('Yakin Simpan Data?')){return true;}else{event.stopPropagation(); event.preventDefault();};">Simpan Bonus</button>
</div>
