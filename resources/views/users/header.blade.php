<nav class="navbar main-nav navbar-expand-lg px-2 px-sm-0 py-2 py-lg-0">
	<div class="container">
	  <a class="navbar-brand" href="index.html"><img width="70" class="p-2" src="{{ asset('admin/assets/img/logo.png') }}" alt="logo"></a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
		aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="ti-menu"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNav">
		<ul class="navbar-nav ml-auto">
		  <li class="nav-item dropdown	">
			<a class="nav-link dropdown-toggle" href="{{ route('index') }}">Home
			  {{-- <span><i class="ti-angle-down"></i></span> --}}
			</a>
			{{-- <!-- Dropdown list -->
			<ul class="dropdown-menu">
			  <li><a class="dropdown-item active" href="index.html">Homepage</a></li>
			  <li><a class="dropdown-item" href="homepage-2.html">Homepage 2</a></li>
			  <li><a class="dropdown-item active3" href="homepage-3.html">Homepage 3</a></li>
  
			  <li class="dropdown dropdown-submenu dropright">
				<a class="dropdown-item dropdown-toggle" href="#!" id="dropdown0301" role="button"
				  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sub Menu</a>
  
				<ul class="dropdown-menu" aria-labelledby="dropdown0301">
				  <li><a class="dropdown-item" href="index.html">Submenu 11</a></li>
				  <li><a class="dropdown-item" href="index.html">Submenu 12</a></li>
				</ul>
			  </li>
			</ul> --}}
		  </li>
		  {{-- <li class="nav-item dropdown @@pages">
			<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Pages
			  <span><i class="ti-angle-down"></i></span>
			</a>
			<!-- Dropdown list -->
			<ul class="dropdown-menu">
			  <li><a class="dropdown-item @@team" href="team.html">Team</a></li>
			  <li><a class="dropdown-item @@career" href="career.html">Career</a></li>
			  <li><a class="dropdown-item @@blog" href="blog.html">Blog</a></li>
			  <li><a class="dropdown-item @@blogSingle" href="blog-single.html">Blog Single</a></li>
			  <li><a class="dropdown-item @@privacy" href="privacy-policy.html">Privacy</a></li>
			  <li><a class="dropdown-item @@faq" href="FAQ.html">FAQ</a></li>
			  <li><a class="dropdown-item" href="sign-in.html">Sign In</a></li>
			  <li><a class="dropdown-item" href="sign-up.html">Sign Up</a></li>
			  <li><a class="dropdown-item" href="404.html">404</a></li>
			  <li><a class="dropdown-item" href="comming-soon.html">Coming Soon</a></li>
  
			  <li class="dropdown dropdown-submenu dropleft">
				<a class="dropdown-item dropdown-toggle" href="#!" id="dropdown0501" role="button"
				  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sub Menu</a>
  
				<ul class="dropdown-menu" aria-labelledby="dropdown0501">
				  <li><a class="dropdown-item" href="index.html">Submenu 21</a></li>
				  <li><a class="dropdown-item" href="index.html">Submenu 22</a></li>
				</ul>
			  </li>
			</ul>
		  </li> --}}
		  <li class="nav-item @@about">
			<a class="nav-link" href="{{ route('about') }}">About</a>
		  </li>
		  {{-- <li class="nav-item @@contact">
			<a class="nav-link" href="contact.html">Contact</a>
		  </li> --}}
		  @if(Auth::guard('borrowers')->check())
			<li class="nav-item @@contact">
				<a class="nav-link" href="{{ route('balance.index') }}">Balance</a>
			</li>
			@endif
		  @if(Auth::guard('borrowers')->check())
			<li class="nav-item @@contact">
				<a class="nav-link" href="{{ route('logout') }}">Logout</a>
			</li>
		@else
			<li class="nav-item @@contact">
				<a class="nav-link" href="{{ route('login.index') }}">Login</a>
		  </li>
		@endif
		</ul>
	  </div>
	</div>
  </nav>