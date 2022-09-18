@extends('layouts.appmaster') @section('title', 'Login Page')
@section('content')
<div class="container-fluid text-center">
	<h2 class="mt-5">Login</h2>
	<form action="dologin" method="POST">
		<input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
		<div class="table mt-5">
			<div class="row m-2">
				{{--
				<div class="col">Username:</div>
				--}}
				<div class="col-lg-4 mx-auto">
					<input class="form-control" type="text" name="username"
						placeholder="Username" />
				</div>
				<div class="text-danger"><?php echo $errors->first('username')?></div>
			</div>
			<div class="row m-2">
				{{--
				<div class="col">Password:</div>
				--}}
				<div class="col-lg-4 mx-auto">
					<input class="form-control" type="password" name="password"
						placeholder="Password" />
				</div>
				<div class="text-danger"><?php echo $errors->first('password')?></div>
			</div>
			<div class="d-grid col-2 mx-auto">
				<input class="btn btn-success" type="submit" value="Submit" />
			</div>
			<div class="mt-2">
				<h6>
					Don't have an account?<a href="/register">Register</a>
				</h6>
			</div>
		</div>
	</form>
</div>
@endsection
