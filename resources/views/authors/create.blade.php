@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ url('/home') }}">Dasboard</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/admin/authors') }}">Penulis</a></li>
					<li class="breadcrumb-item active">Tambah Penulis</li>				
				</ol>
		<div class="panel panel-default">
			<div class="panel-heading">
	<h2 class="panel-title">Tambah Penulis</h2>
</div>
	<div class="panel-body">

		{!! Form::open(['url' => route('authors.store'),
		'method' => 'post', 'class'=>'form-horizontal']) !!}
		@include('authors._form')
		{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection