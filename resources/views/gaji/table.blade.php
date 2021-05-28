<table class="example1 table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Bulan</th>
            <th>Hari Kerja</th>
            <th>Gaji</th>
            <th>Harian</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($detail as $i => $a)
        <tr>
            <td>{{$i+1}}</td>
            <td>{{ \Carbon\Carbon::parse($a->tanggal_gajian)->isoFormat('MMMM Y') }}</td>
            <td>{{ $a->hari_kerja }}</td>
            <td>Rp. {{ number_format(floor($a->gaji)) }}</td>
            <td>Rp. {{ number_format(floor($a->gaji / $a->hari_kerja)) }}</td>
            <td align="center">
                <button type="button" onclick="deleteGaji('{{$a->id_gaji}}')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(function () {		
		$(".example1").DataTable({
            "responsive": true,
            "autoWidth": false,
		});
	});
</script>