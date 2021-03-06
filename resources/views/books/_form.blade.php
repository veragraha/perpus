			<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
		{!! Form::label('title', 'Judul', ['class'=>'col-md-2 control-label']) !!}
		<div class="col-md-4">
			{!! Form::text('title', null, ['class'=>'form-control']) !!}
			{!! $errors->first('title', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
	<div class="form-group {!! $errors->has('author_id') ? 'has-error' : '' !!}">
		{!! Form::label('author_id', 'Penulis', ['class'=>'col-md-2 control-label']) !!}
		<div class="col-md-4">
			<?php
				$arr = App\Author::pluck('name','id')->all();
				$arr = array_merge([''], $arr);
			?>
			{!! Form::select('author_id', $arr , null, ['class' => 'form-control'])!!}
			{!! $errors->first('author_id', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
	<div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
			{!! Form::label('amount', 'Jumlah', ['class'=>'col-md-2 control-label']) !!}
		<div class="col-md-4">
			{!! Form::number('amount', null, ['class'=>'form-control', 'min'=>1]) !!}
			{!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
			@if (isset($book))
		<p class="help-block">{{ $book->borrowed }} buku sedang dipinjam</p>
			@endif
		</div>
	</div>
	<div class="form-group{{ $errors->has('cover') ? ' has-error' : '' }}">
			{!! Form::label('cover', 'Jumlah', ['class'=>'col-md-2 control-label']) !!}
		<div class="col-md-4">
			<input type="file" name="cover"id="cover">
			{{---.{!! Form::file('cover', null,[]) !!} --}}
			@if (isset($book) && $book->cover)
			<p>
				{!! Html::image( asset ('img/'.$book->cover), null,['class'=>'img-rounded img-responsive' ]) !!}
			</p>
			@endif
			{!! $errors->first('cover', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-4 col-md-offset-2">
			{!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
		</div>
	</div>