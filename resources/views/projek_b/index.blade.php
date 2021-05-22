@extends('template')
@section('content')
<div class="col-md-12">
    <div class="card card-primary card-outline">
        <div class="card-body">
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th style="width: 1%">No</th>
                        <th style="width: 34%">Nama Projek</th>
                        <th style="width: 30%">Team</th>
                        <th style="width: 20%">Projek Progress</th>
                        <th style="width: 10%" class="text-center">Status</th>
                        <th style="width: 5%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($projek as $i => $a)
                    <tr>
                        <td>{{$i+1}}</td>
                        <td>
                            <a>{{$a['judul']}}</a>
                            <br />
                            <small>Mulai {{$a['tgl_masuk']}}</small>
                        </td>
                        <td>
                            <ul class="list-inline">
                                <?php
                                $team = DB::table('tb_progres')->join('tb_user','tb_user.id_user','tb_progres.id_user')->where('tb_progres.id_project',$a['id_project'])->get();
                                ?>
                                @foreach($team as $team)
                                <li class="list-inline-item">
                                    <img role="button" alt="{{$team->nama}}" data-toggle="tooltip"
                                        data-placement="bottom" title="{{$team->nama}}" class="table-avatar"
                                        src="{{asset('/image/'.$team->foto)}}">
                                </li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="project_progress">
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-success" role="progressbar"
                                    aria-volumenow="{{round($a['progres'])}}" aria-volumemin="0" aria-volumemax="100"
                                    style="width: {{round($a['progres'])}}%">
                                </div>
                            </div>
                            <small>
                                {{round($a['progres'])}}% Complete
                            </small>
                        </td>
                        <td class="project-state">
                            @if($a['status'] == 1)

                            <span class="badge badge-info">Progres</span>
                            @elseif($a['status'] == 2)
                            <span class="badge badge-success">Selesai</span>
                            @endif
                        </td>
                        <td align="center">
                            <a class="btn btn-primary btn-sm" href="{{ route('projek-berjalan-timeline', $a['id_project']) }}">
                                <i class="fas fa-folder"></i>
                            </a>
                            <!-- <a class="btn btn-info btn-sm" href="#">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <a class="btn btn-danger btn-sm" href="#">
                                <i class="fas fa-trash"></i>
                            </a> -->
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
