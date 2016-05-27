@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')

<section class="content">
	<!-- Info boxes -->
	<div class="row">
		@if ($auth)
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box">
			<span class="info-box-icon bg-aqua"><i class="ion ion-ios-people-outline"></i></span>

			<div class="info-box-content">
				<span class="info-box-text">Total Users</span>
				<span class="info-box-number">{{ $userCount }}</span>
			</div>
			<!-- /.info-box-content -->
			</div>
			<!-- /.info-box -->
		</div>
		<!-- /.col -->
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box">
			<span class="info-box-icon bg-red"><i class="ion ion-ios-person-outline"></i></span>

			<div class="info-box-content">
				<span class="info-box-text">Total Inquiries</span>
				<span class="info-box-number">{{ $inquiriesCount }}</span>
			</div>
			<!-- /.info-box-content -->
			</div>
			<!-- /.info-box -->
		</div>
		<!-- /.col -->

		<!-- fix for small devices only -->
		<div class="clearfix visible-sm-block"></div>

		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box">
			<span class="info-box-icon bg-green"><i class="ion ion-ios-flag-outline"></i></span>

			<div class="info-box-content">
				<span class="info-box-text">My Inquiries</span>
				<span class="info-box-number">{{ $myInquiriesCount }}</span>
			</div>
			<!-- /.info-box-content -->
			</div>
			<!-- /.info-box -->
		</div>
		<!-- /.col -->
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box">
			<span class="info-box-icon bg-yellow"><i class="ion ion-ios-paperplane-outline"></i></span>

			<div class="info-box-content">
				<span class="info-box-text">Started on</span>
				<?php
				$datec = Auth::user()['created_at'];
				?>
				<span class="info-box-number"><?php echo date("d M Y", strtotime($datec)); ?></span>
			</div>
			<!-- /.info-box-content -->
			</div>
			<!-- /.info-box -->
		</div>
		<!-- /.col -->
		@endif
	</div>
	<!-- /.row -->
</section>
@endsection
