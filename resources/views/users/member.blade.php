@extends('users.app')

@section('title', 'Member Registration')
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
							<h3>Sign Up for New Account</h3>
						</div>
						<form action="{{ route('membership.store') }}" method="POST" enctype="multipart/form-data">
							@csrf

							<div class="w-100 pb-2">
								@if(session('success'))
									<p class="text-success">{{ session('success') }}</p>
								@elseif(session('error'))
										<p class="text-danger">{{ session('error') }}</p>
								@endif
							</div>
							<!-- Username -->
							<input class="form-control main" name="lname" type="text" placeholder="Last Name" required>
							<input class="form-control main" name="fname" type="text" placeholder="First Name" required>
							<input class="form-control main" name="mname" type="text" placeholder="Middle Name">
							<!-- Email -->

							<input class="form-control main" name="address" type="text" placeholder="Address" required>
							<select name="sex" class="form-control main">
								<option selected>Sex</option>
								<option value="male">Male</option>
								<option value="female">Female</option>
							  </select>
							
							<input class="form-control main" name="age" type="text" placeholder="Age" required>
							<input class="form-control main" name="civil" type="text" placeholder="Civil" required>

							@php
								$religion = [
									['name' => 'Roman Catholicism', 'value' => 'Roman Catholicism'],
									['name' => 'Protestantism', 'value' => 'Protestantism'],
									['name' => 'Iglesia ni Cristo', 'value' => 'Iglesia ni Cristo'],
									['name' => 'Philippine Independent Church (Aglipayan Church)', 'value' => 'Philippine Independent Church (Aglipayan Church)'],
									['name' => 'Islam', 'value' => 'Islam'],
									['name' => 'Animism', 'value' => 'Animism'],
									['name' => 'Folk Catholicism', 'value' => 'Folk Catholicism'],
									['name' => 'Buddhism', 'value' => 'Buddhism'],
									['name' => 'Hinduism', 'value' => 'Hinduism'],
									['name' => 'Judaism', 'value' => 'Judaism'],
									['name' => 'Atheism', 'value' => 'Atheism'],
									['name' => 'Agnosticism', 'value' => 'Agnosticism'],
									['name' => "Bahá'í Faith", 'value' => "Bahá'í Faith"],
									['name' => "Jehovah's Witnesses", 'value' => "Jehovah's Witnesses"],
									['name' => 'Seventh-day Adventists', 'value' => 'Seventh-day Adventists'],
									
								]
							@endphp

							<select name="religion" class="form-control main">
								<option selected>Religion</option>
								@foreach ($religion as $religions)
									<option value="{{ $religions['value'] }}">{{ $religions['name'] }}</option>
								@endforeach
							</select>

							

							<input class="form-control main" name="contact" type="text" placeholder="Contact" required>

							<div class="form-group text-left main">
								<label for="id_end_time">Date of Birth:</label>
								<div class="input-group date" id="id_4">
									<input type="text" value="05/16/2018" name="dateOfBirth" class="form-control" required/>
									<div class="input-group-addon input-group-append">
										<div class="input-group-text">
											<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
										</div>
									</div>
								</div>
							</div>

							{{-- <input class="form-control main" name="dateOfBirth" type="text" placeholder="Date of Birth" required> --}}
							<input class="form-control main" name="placeOfBirth" type="text" placeholder="Place of Birth" required>
							<input class="form-control main" name="yearLevel" type="text" placeholder="Year Level" required>
							<input class="form-control main" name="course" type="text" placeholder="Course" required>

							<input class="form-control main" name="email" type="email" placeholder="Email Address" required>
							<input class="form-control main" name="username" type="text" placeholder="Username" required>
							<input class="form-control main" name="password" type="password" placeholder="Password" required>
                            
							{{-- <input class="form-control main" name="tax_id" type="text" placeholder="Tax ID" required> --}}
							

                            {{-- <input class="form-control main" name="username" type="text" placeholder="Username" required>

							<!-- Password -->
							<input class="form-control main" name="password" type="password" placeholder="Password" required> --}}
							<!-- Submit Button -->

                            {{-- <div class="custom-file mb-3">
                                <input type="file" name="credentials" class="custom-file-input form-control main" id="validatedCustomFile" required>
                                <label class="custom-file-label" name="" for="validatedCustomFile">Click to upload credendials</label>
                                <div class="invalid-feedback">Example invalid custom file feedback</div>
                              </div> --}}
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