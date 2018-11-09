@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ChatBox</div>

                <div class="card-body" style="height: 320px; overflow: auto;">
                    <chat :key=texts.index v-for="texts,index in text.pesan" :color=text.color[index]  :user=text.user[index]> @{{ texts }} </chat>
                </div>
            </div>
            <div class="panel-footer">
                <div class="input-group">
                    <input type="" class="form-control" v-model='input' @keyup.enter='push' placeholder="ketik disini.." name="">
                    <span class="input-group-btn">
                        <button class="btn btn-warning" @click.prevent='push'>Kirim</button>
                    </span>
                 </div>
            </div>
        </div>
    </div>
</div>
@endsection
