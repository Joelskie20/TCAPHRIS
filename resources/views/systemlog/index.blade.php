@extends('layouts.master')

@section('title', 'System Log')

@section('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
<div class="content-wrapper" style="min-height: 842px;">

    <section class="content-header">
        <h1>System Log</h1>
    </section>

    <!-- MAIN CONTENT -->
    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Log List </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                    
                    </div>
                    <div class="row">
                        <div class="col-sm-12 table-responsive">
                            <table id="table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th style="width: 200px;">Date/Time</th>
                                        <th>Log Type</th>
                                        <th>Message</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($activities as $activity)
                                    <tr>
                                        <td>{{ $activity->id }}</td>
                                        <td>{{ Carbon::parse($activity->created_at)->format('F d, Y') }}<br>{{ Carbon::parse($activity->created_at)->format('h:i:s A - l') }}</td>
                                        <td>{{ $activity->log_name }}</td>
                                        <td>
                                            <p>
                                                <a href="/employee/{{ $activity->causer->id }}">{{ $activity->causer->firstNameFirst()  }}</a>
                                                    {{ $activity->description }}
                                                    @isset($activity->changes['old']['name'])<strong>{{ $activity->changes['old']['name'] }} </strong> to @endisset
                                                    @isset($activity->changes['attributes']['name']) <strong> {{ $activity->changes['attributes']['name'] }}</strong>. @endisset
                                            </p>
                                        </td>
                                        <td>{{ $activity->created_at->diffForHumans() }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>

    </section>

</div>
@endsection

@section('scripts')
<!-- DataTables -->
<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script>
$(document).ready(function() {
    $('#table').dataTable({
        'iDisplayLength': 100,
        "order": [[ 0, "desc" ]]
    });
});
</script>
@endsection