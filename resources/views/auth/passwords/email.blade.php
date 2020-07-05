@extends('layouts._layout_login')

@section('content')
    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
        {{ csrf_field() }}


        <div class="card card-login card-hidden">
            <div class="card-header card-header-rose text-center">
                <h4 class="card-title" style="color: #ffffff">Reset Password</h4>
            </div>
            <div class="card-body ">
                <p class="card-description text-center"></p>

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <span class="bmd-form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="material-icons">email</i>
                      </span>
                    </div>
                    <input value="{{ old('email') }}" name="email" id="email" type="email" required autofocus
                           class="form-control" placeholder="Email">

                      @if ($errors->has('email'))
                          <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                      @endif

                  </div>
                   </span>


            </div>
            <div class="card-footer justify-content-center login-submit-class">
                <button type="submit" class="btn btn-rose btn-link btn-lg">
                    Send Password Reset Link
                </button>
            </div>
        </div>
    </form>











@endsection
