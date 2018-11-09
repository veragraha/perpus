@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ url('/home') }}">Dasboard</a></li>
					<li class="breadcrumb-item active">Pinjam Buku</li>				
				</ol>
				<div class="panel panel-default">
					<div class="panel-heading">
					<h2 class= "pane-title">Pinjam Buku</h2>				
				</div>

	@include('layouts._flash')
				<div class="panel-body">
			<table class="table table-striped">
				<thead>
					
					<tr>
						<td>Judul</td>
						<td>Peminjaman</td>
						<td>Tanggal Peminjaman</td>
						<td>Tanggal Kembali</td>
					</tr>
				</thead>
				<tbody>
					@foreach($data as $key => $value)
					<tr>
						<td>{{$value->book->title}}</td>
						<td>{{$value->user->name}}</td>
						<td>{{$value->created_at}}</td>
						<td>{{$value->updated_at}}</td>
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