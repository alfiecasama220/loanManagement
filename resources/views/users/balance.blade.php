@extends('users.app')

@section('title', 'Balance')
@section('image', '')
@section('content')

<!-- Balance Section -->
<section class="section pt-0 position-relative pull-top">
	<div class="container">
		<div class="rounded shadow p-5 bg-white">
			<div class="row">
				<div class="col-md-12 text-center">
					<h2 class="font-weight-bold mb-4">Your Current Balance</h2>
					<p class="lead text-muted">Stay updated with your recent transactions and balance details</p>
				</div>
				<div class="col-lg-12 col-md-6 mt-4 text-center">
					<i class="ti-wallet text-primary h1"></i>
					<h3 class="mt-4 text-capitalize h5">Loan Balance</h3>
					<p class="regular text-muted">₱ 5,600.00</p>
				</div>
				{{-- <div class="col-lg-4 col-md-6 mt-4 text-center">
					<i class="ti-credit-card text-primary h1"></i>
					<h3 class="mt-4 text-capitalize h5">Total Loans</h3>
					<p class="regular text-muted">₱ </p>
				</div>
				<div class="col-lg-4 col-md-6 mt-4 text-center">
					<i class="ti-receipt text-primary h1"></i>
					<h3 class="mt-4 text-capitalize h5">Monthly Dues</h3>
					<p class="regular text-muted">₱ </p>
				</div> --}}
			</div>
			{{-- <div class="row mt-5">
				<div class="col-12 text-center">
					<a href="" class="btn btn-main-md">View Transaction History</a>
				</div>
			</div> --}}
		</div>
	</div>
</section>

<!-- Call-to-Action Section -->
<section class="call-to-action-app section bg-blue">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h2>Stay in Control of Your Finances</h2>
				<p>Track your balances and manage loans with ease. Take control of your financial future today!</p>
			</div>
		</div>
	</div>
</section>

<!-- To Top -->
<div class="scroll-top-to">
	<i class="ti-angle-up"></i>
</div>

@endsection
