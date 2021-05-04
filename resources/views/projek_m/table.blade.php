<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th style="width:10%">No</th>
            <th style="width:60%">Fitur</th>
            <th style="width:20%">Status</th>
            <th style="width:10%">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($detail as $i => $a)
        <tr>
            <td>{{$i+1}}</td>
            <td>{{$a->fitur}}</td>
            <td>
                @if($a->status == 0)
                    <strong>Progres</strong>
                @else
                    <strong>Selesai</strong>
                @endif
            </td>
            <td align="center">
                <button type="button" onclick="deletefitur('{{$a->id_fitur}}')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>