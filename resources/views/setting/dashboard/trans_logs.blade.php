<table class="table table-hover" id="table_logs_">
    <thead>
    <tr>
        <th>User</th>
        <th>Log</th>
        <th>Log Type</th>
        <th>Log Date</th>
        <th>Description</th>
    </tr>
    </thead>
    <tbody>
    @foreach($logs as $log)
        <tr>
            <td>{{$log->user_full_name}}</td>
            <td>{{Auth::user()->lang_id == 1 ? $log->trans_type_name_na : $log->trans_type_name_fo}}</td>
            <td>{!! logTblType($log->trans_type) !!}</td>
            <td>{{date('Y-m-d H:i A',strtotime($log->trans_date))}}</td>
            <td>{{Auth::user()->lang_id == 1 ? $log->trans_note_na : $log->trans_note_fo}}</td>
        </tr>
    @endforeach
    </tbody>
</table>