
            <table class="table" id="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>
                        {{$labels['staff_name'] ?? 'staff_name'}}
                    </th>
                    <th>
                        {{$labels['start_date'] ?? 'start_date'}}
                    </th>
                    <th>
                        {{$labels['end_date'] ?? 'end_date'}}
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($focalPoint  as $index=>$focal)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$focal->getNameStaff($focal->staff_id)}}</td>
                        <td>{{dateFormatSite($focal->start_date)}}</td>
                        <td>{{dateFormatSite($focal->end_date)}}</td>
                    </tr>

                @endforeach
                </tbody>
            </table>


