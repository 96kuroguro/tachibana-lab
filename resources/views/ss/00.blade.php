@extends('layouts.corp')

@section('title', 'Layer:00　――')

@section('content')
    <h3 class="pb-3 mb-4 font-italic border-bottom">
        serial experiments lain ファンアートSS
    </h3>

    <a href="{{ url('ss') }}" class="btn btn-sm btn-secondary mb-5">SS 目次へ</a>

    <h4>Layer:00　<br class="d-inline d-sm-none" />――</h4>
    <hr>

    <div class="row">
        <p class="col-md-8">
            <br>
            <br>
            <br>
            @96kuroguro<br>
            <br>
            <br>
            <a href="{{ url('ss') }}" class="btn btn-sm btn-secondary mb-5">SS 目次へ</a>
        </p>


    </div>

@endsection

@section('js')
<script>
</script>
@endsection