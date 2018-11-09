@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				@include('Layouts._flash')
				<div class="card">
					<h2 class= "card-header"> Dashboard</h2>				
				<div class="card-body">
					
				<div class="panel-body">
					Selamat datang di Larapus
					<table class="table">
				<tbody>
					<tr>
						<td class="text-muted">Buku dipinjam</td>
						<td>
							@if ($borrowLogs->count() == 0)
							Tidak ada buku dipinjam
							@endif
							<ul>
							@foreach ($borrowLogs as $borrowLog)
							<li>
								{!! Form::open(['url' => route('member.books.return', $borrowLog->book_id),
								'method' => 'put',
								'class' => 'form-inline js-confirm',
								'data-confirm' => "Anda yakin hendak mengembalikan " . $borrowLog->book->title . "?"] ) !!}
								{{ $borrowLog->book->title }}
								{!! Form::submit('Kembalikan', ['class'=>'btn btn-xs btn-default']) !!}
								{!! Form::close() !!}
							</li>
							@endforeach
							</ul>
						</td>
					</tr>
				</tbody>
				</table>
				</div>		
			</div>
		</div>
	 </div>				
    </div>				
 </div>
@endsection