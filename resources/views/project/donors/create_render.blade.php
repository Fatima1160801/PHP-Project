        {!! Form::open(['route' => 'project.donors.store' ,'action'=>'post' ,'novalidate'=>'novalidate','id'=>'formAddDonors']) !!}
        <div class="card-body ">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {!! $html !!}

            <div class="col-md-12">
                <a href="#" class="btn  btn-default  btn-sm pull-right" id="saveNextContact">

                    {{$labels['next'] ?? 'next'}}
                           </a>


                <button btn="btnToggleDisabled" type="submit" class="btn btn-rose btn-sm pull-right" id="AddDonor">
                    {{$labels['save'] ?? 'save'}}
                    <div class="loader pull-left" style="display: none;"></div>
                </button>

            </div>

            {!! Form::close() !!}
        </div>

