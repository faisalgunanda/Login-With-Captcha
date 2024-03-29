<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Captcha in Laravel 7</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" >
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>
  <div class="container" style="margin-top: 50px;">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel-heading">Login</div>
      <div class="panel-body">
        <form class="{{route('myCaptchapost')}}"  method="post" role="form" class="form-horizontal">
          {{csrf_field()}}
          <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="col-md-4 control-label">E-Mail Address</label>
            <div class="col-md-6">
              <input type="text" id="email" class="form-control" name="email" value="{{ old('email')}}">
              @if ($errors->has('email'))
              <span class="help-block">
                <strong>{{$errors->first('email')}}</strong>
              </span>
              @endif
            </div>
          </div>
          <div class="form-group {{ $errors->has('password') ? ' has-error' : ''}}">
            <label for="password" class="col-md-4 control-label">Password</label>
            <div class="col-md-6">
              <input type="password" name="password" class="form-control">
              @if( $errors->has('password'))
              <span class="help-block">
                <strong>{{$errors->first('password')}}</strong>
              </span>
              @endif
            </div>
          </div>
          <div class="form-group {{ $errors->has('captcha') ? ' has-error' : ''}}">
            <label for="captcha" class="col-md-4 control-label">Captcha</label>
            <div class="col-md-6">
              <div class="captcha">
                <span>{!! captcha_img() !!}</span>
                <button type="button" class="btn btn-success btn-refresh"><i class="fa fa-refresh"></i></button>
              </div>
              <input type="text" id="captcha" class="form-control" name="captcha" placeholder="Enter Captcha">
              @if ($errors->has('captcha'))
              <span class="help-block">
                <strong>{{ $errors->first('captcha')}}</strong>
              </span>
              @endif
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-8 col-md-offset-4">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
<script type="text/javascript">
  $('.btn-refresh').click(function(){
    $.ajax({
      dataType : 'json',
      type:'GET',
      url:'/refresh_captcha',
      success:function(data){
        $('.captcha span img').attr("src",data.captcha);
      }
    });
  });
</script>
</html>
