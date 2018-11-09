@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ url('/home') }}">Dasboard</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/admin/books') }}"> Buku</a></li>
					<li class="breadcrumb-item active">Ubah Buku</li>				
				</ol>
		<div class="panel panel-default">
			<div class="panel-heading">
	<h2 class="panel-title">Ubah Buku</h2>
</div>
	<div class="panel-body">

		{!! Form::model($book, ['url' => route('books.update', $book->id),
		'method' => 'put', 'files'=>'true','class'=>'form-horizontal', ]) !!}
		@include('books._form')
		{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection