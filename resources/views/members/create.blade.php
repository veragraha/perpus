@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ url('/home') }}">Dasboard</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/admin/members') }}">Member</a></li>
					<li class="breadcrumb-item active">Tambah Member</li>				
				</ol>
		<div class="panel panel-default">
			<div class="panel-heading">
	<h2 class="panel-title">Tambah Member</h2>
</div>
	<div class="panel-body">

		{!! Form::open(['url' => route('members.store'),
		'method' => 'post', 'class'=>'form-horizontal', 'files'=>true]) !!}
		@include('members._form')
		{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection