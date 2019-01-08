@extends('layouts.master')

@section('title', 'Positions')

@section('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
<div class="content-wrapper">
    <section class="content-header">
	    <h1>Positions</h1>
    </section>
    <div class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Positions List</h3>
                <a href="{{ action('PositionController@create') }}" class="btn btn-primary pull-right">Add Position</a>
            </div>
            <div class="box-body">
                
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Position Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($positions as $key => $position)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $position->name }}</td>
                                <td>
                                    <a href="/positions/{{ $position->id }}/edit" class="btn btn-primary btn-xs" title="Edit"><i class="fa fa-pencil"></i></a>
                                    <form style="display: inline-block;" action="/positions/{{ $position->id }}" method="POST">
                                        @method('DELETE')
                                        @csrf
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
    $('#table').dataTable({
        'iDisplayLength': 100
    });
});
</script>
@endsection