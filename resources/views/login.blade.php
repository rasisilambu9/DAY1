<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
<div class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    
    
<title>Login</title>
<div class="container">
@if (\Session::has('Fail'))
    <div class="alert alert-danger">
        <ul>
            <li>{!! \Session::get('Fail') !!}</li>
        </ul>
    </div>
@endif
  <form class="myForm" method="post">
      @csrf
    <div class="form-group">
      <label for="email">Email</label>
      <input class="form-control input-lg" type="email" name="email" id="email" placeholder="email" />
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input class="form-control input-lg" type="password" name="password" placeholder="password" />
    </div>
    <div class="form-group">
      <input type="submit" name="submit" class="btn btn-success btn-lg" value="Sign Up" />
    </div>
  </form>
</div>