@extends('layouts.master')

@section('title', 'Teams')

@section('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
<div class="content-wrapper">
    
    <section class="content-header">
	    <h1>Teams</h1>
    </section>
    <div class="content">
        @if (Session::has('message'))
            <div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Success!</h4>{{ Session::get('message') }}</div>
        @endif        
        <div class="box">
            
            <div class="box-header with-border">
                <h3 class="box-title">Teams List</h3>
                <a href="/teams/create" class="btn btn-success pull-right"><i class="fa fa-plus mr05"></i> ADD TEAM</a>
            </div>
            
            <div class="box-body">
					
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Division</th>
                            <th>Team Name</th>
                            <th class="no-sort"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($teams as $key => $team)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>@isset($team->division->name) {{ $team->division->name }} @endisset</td>
                            <td>{{ $team->name }}</td>
                            <td>
                                <a href="/teams/{{ $team->id }}/edit" class="btn btn-success btn-xs btn-edit"><i class="fa fa-pencil"></i></a>
                                
                                <form style="display: inline-block;" action="/teams/{{ $team->id }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete this item?');" title="Delete"><i class="fa fa-trash-o"></i></button>
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
        'iDisplayLength': 10,
        'columnDefs': [{'targets': 'no-sort','orderable': false,}]
    });
});
</script>
@endsection