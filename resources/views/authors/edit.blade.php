@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				@include('layouts._flash')
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ url('/home') }}">Dasboard</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/admin/authors') }}">Penulis</a></li>
					<li class="breadcrumb-item active">Ubah Penulis</li>				
				</ol>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h2 class= "pane-title">Penulis</h2>				
					</div>
					<div class="panel-body">
					{!! Form::model($author, ['url' => route('authors.update', $author->id),
					'method'=>'patch', 'class'=>'form-horizontal']) !!}
					@include('authors._form')
					{!! Form::close() !!}
		</div>
	 </div>				
    </div>				
 </div>
@endsection

@section('script')

@endsection