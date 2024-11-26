@extends('users.app')

@section('title', 'Sign Up')
@section('content')

<section class="user-login section">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="block">
					<!-- Image -->
					<div class="image align-self-center"><img class="img-fluid" src="{{ asset('assets/users/images/background/register.png') }}" alt="desk-image">
					</div>
					<!-- Content -->
					<div class="content text-center">
						<div class="logo">
							<a href="index.html"><img src="images/logo.png" alt=""></a>
						</div>
						<div class="title-text">
							<h3>Sign Up to Become a Member</h3>
						</div>
						<form action="{{ route('login.store') }}" method="POST" enctype="multipart/form-data">
							@csrf

							<div class="w-100 pb-2">
								@if(session('success'))
									<p class="text-success">{{ session('success') }}</p>
								@elseif(session('error'))
										<p class="text-danger">{{ session('error') }}</p>
								@endif
							</div>
							<!-- Username -->
							<input class="form-control main" name="name" type="text" placeholder="Your Name" required="">
							<!-- Email -->
							<input class="form-control main" name="email" type="email" placeholder="Email Address" required="">

                            <input class="form-control main" name="contact" type="text" placeholder="Contact" required="">

							<input class="form-control main" name="address" type="text" placeholder="Address" required="">

                            <input class="form-control main" name="username" type="text" placeholder="Username" required="">

							<!-- Password -->
							<input class="form-control main" name="password" type="password" placeholder="Password" required="">
							<!-- Submit Button -->

                            <div class="custom-file mb-3">
                                <input type="file" name="credentials" class="custom-file-input form-control main" id="validatedCustomFile" required>
                                <label class="custom-file-label" name="" for="validatedCustomFile">Click to upload credendials</label>
                                <div class="invalid-feedback">Example invalid custom file feedback</div>
                              </div>
							<button class="btn btn-main-md">sign up</button>
						</form>
						<div class="new-acount">
							<p>By clicking “Sign Up” I agree to <a href="privacy-policy.html">Terms of Conditions.</a></p>
							<p>Anready have an account? <a href="{{ route('login.index') }}">SIGN IN</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection