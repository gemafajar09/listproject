<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Bonus Project</th>
        <th>Lama Pengerjaan</th>
        <th>Bonus Persen</th>
        <th>Bonus Harga</th>
    </tr>
    @foreach($detail as $no => $dtl)
    <tr>
        <td>{{ $no + 1 }}</td>
        <td>{{ $dtl->nama }}</td>
        <td>Rp. {{ number_format($dtl->bonus_harga) }}</td>
        <td>{{ $dtl->bonus_programmer_lama }} Hari</td>
        <td>{{ $dtl->bonus_programmer_persen }} %</td>
        <td>Rp. {{ number_format($dtl->bonus_programmer_harga) }}</td>
    </tr>
    @endforeach
</table>
