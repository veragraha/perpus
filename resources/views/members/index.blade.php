@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ url('/home') }}">Dasboard</a></li>
					<li class="breadcrumb-item active">Member</li>				
				</ol>
				<div class="panel panel-default">
					<div class="panel-heading">
					<h2 class= "pane-title">Member</h2>				
				</div>

	@include('layouts._flash')
				<div class="panel-body">
			<table class="table table-striped">
				<thead>
					<p><a class="btn btn-primary"href="{{ url('/admin/members/create') }}">Tambah</a></p>

					<tr>
						<td>Nama</td>
						<td>Email</td>
						<td align="center">Action</td>
					</tr>
				</thead>
				<tbody>
					@foreach($data as $key => $value)
					<tr>
						<td><a href="{{ URL::to ('admin/members/show/' . $value->id) }}">{{$value->name}}</a></td>
						<td>{{$value->email}}</td>
						<td align="right" valign="top">
							<a href="{{ URL::to ('admin/members/' . $value->id . '/destroy') }}" onclick="return confirm('Are you sure you want to delete this item?');">
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