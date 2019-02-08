@extends('layouts.master')

@section('title', 'Create Division')

@section('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
<div class="content-wrapper">
    
    <section class="content-header">
	    <h1>Create Division</h1>
    </section>
    <div class="content">
        @if (Session::has('message'))
            <div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Success!</h4>{{ Session::get('message') }}</div>
        @endif        
        <div class="box">
            <div class="box-body">
                <form action="{{ action('DivisionController@store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="division-name">Division Name</label>
                        <input type="text" name="name" id="name" placeholder="Enter Division Name...">
                    </div>

                    <div class="form-group">
                        <button type="submit">Create Division</button>
                        <a href="/divisions">Cancel</a>
                    </div>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                </form>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- DataTables -->
<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script>
$(document).ready(function() {
    $('#table').dataTable({
        'iDisplayLength': 10,
        'columnDefs': [{'targets': 'no-sort','orderable': false,}]
    });
});
</script>
@endsection