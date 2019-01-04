@extends('layouts.master')

@section('title', 'Departments')

@section('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
<div class="content-wrapper">
    <section class="content-header">
	    <h1>Department</h1>
    </section>
    <div class="content">
        @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
        @endif
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">View Department</h3>
                <a href="#" class="btn btn-primary pull-right">Add Department</a>
            </div>
            <div class="box-body">
                
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            
                        @endphp
                        @foreach ($departments as $department)
                            <tr>
                                <td>1</td>
                                <td>{{ $department->description }}</td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-xs" title="Edit"><i class="fa fa-pencil"></i></a>
                                    <form style="display: inline-block;">
                                        <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete this item?');" title="Delete">
                                        <i class="fa fa-trash-o"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
    $('#table').dataTable();
});
</script>
@endsection