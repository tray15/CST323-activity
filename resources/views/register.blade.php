@extends('layouts.appmaster') @section('title', 'Registration Page')
@section('content')
<div class="container-fluid text-center">
	<h2 class="mt-5">Register here!</h2>
	<form action="doRegister" method="POST">
		<input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
		<div class="table mt-5">
			<div class="row m-2">
				<div class="col-lg-4 mx-auto">
					<input class="form-control" type="text" name="username"
						placeholder="Username" />
				</div>
				<div class="text-danger"><?php echo $errors->first('username')?></div>
			</div>
			<div class="row m-2">
				<div class="col-lg-4 mx-auto">
					<input class="form-control" type="text" name="password"
						placeholder="Password" />
				</div>
				<div class="text-danger"><?php echo $errors->first('password')?></div>
			</div>
			<div class="d-grid col-2 mx-auto">
				<input class="btn btn-success" type="submit" value="submit" />
			</div>
			<div class="mt-2">
				<h6>
					Already registered?<a href="/login">Login</a>
				</h6>
			</div>
		</div>
	</form>
</div>
@endsection
