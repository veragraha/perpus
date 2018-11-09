@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
					<h2 class= "panel-title"> Daftar Buku</h2>				
				</div>

	@include('layouts._flash')
				<div class="panel-body">
			<table class="table table-striped">
				<thead>
					<tr>
						<td>Judul</td>
						<td>Stok</td>
						<td>Penulis</td>
						<td></td>
					</tr>
				</thead>
				<tbody>
					@foreach($data as $key => $value)
					<tr>
						<td >{{$value->title}}</td>
						<td>{{$value->stock}}</td>
						<td>{{$value->author->name}}</td>
						<td align="right" valign="top">
						<a class="btn btn-xs btn-primary" href="{{ URL::to ('guest/books/borrow/' .$value->id) }}">Pinjam</a>
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