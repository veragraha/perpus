@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
	style="padding: 170px;">
		<div class="col-sm" align="center">
			<i class="fas fa-envelope fa-8x" style="color:black;"></i>
			<h1>Email CS</h1>
			<p>Perpus@gmail.com</p>			
		</div>
		<div class="col-sm"aligm="center">
			<a href="{{ URL (")}} ">
				<i class="fas fa-envelope-open fa-8x" style="color:black;"></i>
			</a>
			<h1>Live Chat</h1>
		</div>
		<div class="col sm"align="center">
			<<i class="fas fa-phone fa-8x"style="color:black;"></i>
			<h1>Contact</h1>
			<p>0xxx</p>
		</div>
	</div>
	
</div>
	@include('layouts._flash')

	 <div class="row">
	    <div class="col" align="center">
	      <i class="fas fa-phone fa-5x"></i>
	    </div>
	    <div class="col" align="center">
	      <i class="fas fa-phone fa-10	x"></i>
	    </div>
	    <div class="col" align="center">
	      <i class="fas fa-phone fa-5x"></i>
	    </div>
	  </div>

@endsection