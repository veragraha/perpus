@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ url('/home') }}">Dasboard</a></li>
					<li class="breadcrumb-item active">Penulis</li>				
				</ol>
				<div class="panel panel-default">
					<div class="panel-heading">
					<h2 class= "pane-title">Penulis</h2>				
				</div>

	@include('layouts._flash')
				<div class="panel-body">
			<table class="table table-striped">
				<thead>
					<p><a class="btn btn-primary"href="{{ route('authors.create') }}">Tambah</a></p>

					<tr>
						<td>No</td>
						<td>Nama</td>
						<td>Tanggal</td>
						<td>Action</td>
					</tr>
				</thead>
				<tbody>
					@foreach($data as $key => $value)
					<tr>
						<td>{{++$key}}</td>
						<td>{{$value->name}}</td>
						<td>{{$value->created_at}}</td>
						<td align="right" valign="top">
							<a href="{{ URL::to ('admin/authors/' . $value->id . '/edit') }}">
								<button type="button"class="btn btn-primary">Edit</button>
							</a>
							<a href="{{ URL::to ('admin/authors/' . $value->id . '/destroy') }}" onclick="return confirm('Are you sure you want to delete this item?');">
								<button type="button" class="btn btn-danger">Delete</button>
								<a href="{{ URL::to ('admin/authors/' . $value->id . '/follow') }}">
								<button type="button class="btn btn-primary">follow</button>
								</a>
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