@extends('layouts.master')

@section('title', 'Job Codes')

@section('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
<div class="content-wrapper">
    
    <section class="content-header">
	    <h1>Job Codes</h1>
    </section>
    <div class="content">
        @if (Session::has('message'))
            <div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Success!</h4>{{ Session::get('message') }}</div>
        @endif        
        <div class="box">
            
            <div class="box-header with-border">
                <h3 class="box-title">Job Codes' List</h3>
                <a href="/job-codes/create" class="btn btn-success pull-right"><i class="fa fa-plus mr05"></i> ADD Job Code</a>
            </div>
            
            <div class="box-body">
					
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Division Name</th>
                            <th>Team Name</th>
                            <th>Account Name</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th class="no-sort"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($job_codes as $key => $job_code)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $job_code->account->team->division->name }}</td>
                            <td>{{ $job_code->account->team->name }}</td>
                            <td>{{ $job_code->account->name }}</td>
                            <td>{{ $job_code->code }}</td>
                            <td>{{ $job_code->name }}</td>
                            <td>
                                <a href="/job-codes/{{ $job_code->id }}/edit" class="btn btn-success btn-xs btn-edit"><i class="fa fa-pencil"></i></a>
                                
                                <form style="display: inline-block;" action="/job-codes/{{ $job_code->id }}" method="POST">
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