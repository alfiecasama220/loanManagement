@extends('users.app')

@section('title', ' Welcome to Metro Dumaguete College Resource Cooperative')
@section('image', 'assets/users/images/background/bg.jpg')
@section('content')

<section class="section page-title">
	<div class="container">
		<div class="row">
			<div class="col-sm-8 m-auto">
				<!-- Page Title -->
				<h1>About this site</h1>
				<!-- Page Description -->
				<p>Metro Dumaguete College Resource Cooperative (MDCRC) is a duly registered Cooperative with the Cooperative Development Authority (CDA) on August 30, 2007 with Registration No. CBU- 3326XL; and it was Re-registered with CDA on February 18, 2010. Under R.A 9520, known as the Philippine Cooperative Code of 2008. Since its registration in 2007, it has yet to receive its new Certificate of Registration. </p>
				<a href="{{ route('about') }}" class="btn btn-primary mt-4">Read more</a>
			</div>
		</div>
	</div>
</section>

  
  {{-- <section class="section pt-0 position-relative pull-top">
	  <div class="container">
		  <div class="rounded shadow p-5 bg-white">
			  <div class="row">
				  <div class="col-lg-4 col-md-6 mt-5 mt-md-0 text-center">
					  <i class="ti-paint-bucket text-primary h1"></i>
					  <h3 class="mt-4 text-capitalize h5 ">themes made easy</h3>
					  <p class="regular text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam non, recusandae
						  tempore ipsam dignissimos molestias.</p>
				  </div>
				  <div class="col-lg-4 col-md-6 mt-5 mt-md-0 text-center">
					  <i class="ti-shine text-primary h1"></i>
					  <h3 class="mt-4 text-capitalize h5 ">powerful design</h3>
					  <p class="regular text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam non, recusandae
						  tempore ipsam dignissimos molestias.</p>
				  </div>
				  <div class="col-lg-4 col-md-12 mt-5 mt-lg-0 text-center">
					  <i class="ti-thought text-primary h1"></i>
					  <h3 class="mt-4 text-capitalize h5 ">creative content</h3>
					  <p class="regular text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam non, recusandae
						  tempore ipsam dignissimos molestias.</p>
					  </p>
				  </div>
			  </div>
		  </div>
	  </div>
  </section> --}}
  
  {{-- <section class="call-to-action-app section bg-blue">
	  <div class="container">
		  <div class="row">
			  <div class="col-lg-12">
				  <h2>It's time to change your mind</h2>
				  <p>Download over 2 million humans .Get <a href="https://themefisher.com/products/small-apps-free-app-landing-page-template/">Small Apps</a> free forever!
					  <br>We say you won’t look back.</p>
				  <ul class="list-inline">
					  <li class="list-inline-item">
						  <a href="" class="btn btn-rounded-icon">
							  <i class="ti-apple"></i>
							  Iphone
						  </a>
					  </li>
					  <li class="list-inline-item">
						  <a href="" class="btn btn-rounded-icon">
							  <i class="ti-android"></i>
							  Android
						  </a>
					  </li>
					  <li class="list-inline-item">
						  <a href="" class="btn btn-rounded-icon">
							  <i class="ti-microsoft-alt"></i>
							  Windows
						  </a>
					  </li>
				  </ul>
			  </div>
		  </div>
	  </div>
  </section> --}}
  
  
  
  
	<!-- To Top -->
	<div class="scroll-top-to">
	  <i class="ti-angle-up"></i>
	</div>
	
	
@endsection