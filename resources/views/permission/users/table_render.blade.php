
    <table class="table dataTable no-footer table-bordered" id="table">
        <thead>


        <tr>
            <th class="text-center">#</th>
            <th>Name</th>
            <th>User Name</th>
            <th>Job Title</th>
            <th>Group</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>

        @foreach($users  as $index=>$user)
            @include('permission.users.row')
        @endforeach
        </tbody>
        <div class="modal fade" id="modalUserGroup" tabindex="-1" role="">
            <div class="modal-dialog modal-login" role="document">
                <div id="contentModal"></div>
            </div>
        </div>
    </table>

