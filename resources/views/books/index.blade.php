@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ url('/home') }}">Dasboard</a></li>
					<li class="breadcrumb-item active">Buku</li>				
				</ol>
				<div class="panel panel-default">
					<div class="panel-heading">
					<h2 class= "panel-title">Buku</h2>				
				</div>

	@include('layouts._flash')
				<div class="panel-body">
			<table class="table table-striped">
				<thead>
					<p><a class="btn btn-primary"href="{{ route('books.create') }}">Tambah</a></p>

					<tr>
						<td>Judul</td>
						<td>Jumlah</td>
						<td>Penulis</td>
						<td>Actions</td>
					</tr>
				</thead>
				<tbody>
					@foreach($data as $key => $value)
					<tr>
						<td>{{$value->title}}</td>
						<td>{{$value->amount}}</td>
						<td>{{$value->author->name}}</td>
						<td align="right" valign="top">
							<a href="{{ URL::to ('admin/books/' . $value->id . '/edit') }}">
								<button type="button"class="btn btn-primary">Edit</button>
							</a>
							<a href="{{ URL::to ('admin/books/' . $value->id . '/destroy') }}" onclick="return confirm('Are you sure you want to delete this item?');">
								<button type="button" class="btn btn-danger">Delete</button>
							</a>
						</td>
					</tr>
					@endforeach
				</tbody>
		       </table>
				{{$data->render()}}					
			</div>		
		</div>
	 </div>				
    </div>				
 </div>
@endsection

@section('script')

@endsection