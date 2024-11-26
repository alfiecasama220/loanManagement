@extends('users.app')

@section('title', 'Sign In')
@section('content')

<section class="user-login section">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="block">
					<!-- Image -->
					<div class="image align-self-center"><img class="img-fluid" src="{{ asset('assets/users/images/background/login.webp') }}" alt="desk-image"></div>
					<!-- Content -->
					<div class="content text-center">
						<div class="logo">
							<a href="index.html"><img src="" alt=""></a>
						</div>
						<div class="title-text">
							<h3>Sign in to To Your Account</h3>
						</div>
						<div class="w-100 pb-2">
							@if(session('success'))
								<p class="text-success">{{ session('success') }}</p>
							@elseif(session('error'))
									<p class="text-danger">{{ session('error') }}</p>
							@endif
						</div>
						<form action="{{ route('loginPost') }}" method="POST">
							@csrf
							<!-- Username -->
							<input class="form-control main" name="username" type="text" placeholder="Username" required="">
							<!-- Password -->
							<input class="form-control main" name="password" type="password" placeholder="Password" required="">
							<!-- Submit Button -->
							<button class="btn btn-main-sm">sign in</button>
						</form>
						<div class="new-acount">
							{{-- <a href="contact.html">Forget your password?</a> --}}
							<p>Become a member? <a href="{{ route('membership.index') }}"> SIGN UP HERE</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection