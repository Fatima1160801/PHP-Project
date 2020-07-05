@extends('layouts._layout_login')

@section('content')

    <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
        {{ csrf_field() }}
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="card card-login card-hidden">
            <div class="card-header card-header-rose text-center">
                <h4 class="card-title">Reset your Password</h4>
            </div>
            <div class="card-body ">
                <p class="card-description text-center"></p>

                <span class="bmd-form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="material-icons">email</i>
                      </span>
                    </div>
                      <input id="email" type="email" class="form-control" placeholder="Email" name="email" required>
                      @if ($errors->has('email'))
                          <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                          </span>
                      @endif
                  </div>
                </span>


                <span class="bmd-form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="material-icons">lock_outline</i>
                      </span>
                    </div>
                      <input id="password" type="password" class="form-control" placeholder="New Password"
                             name="password" required>
                      @if ($errors->has('password'))
                          <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                      @endif
                  </div>
                </span>


                <span class="bmd-form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="material-icons">lock_outline</i>
                      </span>
                    </div>
                  <input id="password-confirm" type="password" class="form-control"
                         placeholder="New Password Confirmation"
                         name="password_confirmation" required>
                      @if ($errors->has('password'))
                          <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                          </span>
                      @endif
                  </div>
                </span>

            </div>

            <div class="card-footer justify-content-center login-submit-class">
                <button type="submit" class="btn btn-rose btn-link btn-lg">
                    Reset Password
                </button>
            </div>


        </div>
    </form>

@endsection
