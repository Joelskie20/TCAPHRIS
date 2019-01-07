@extends('layouts.master')

@section('title', 'Edit Department')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
	  <h1>Edit team</h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ action('TeamController@update', ['id' => $team->id]) }}" method="POST">
              @method('PATCH')
              @csrf
              <div class="box-body" style="padding-bottom: 0">
                <div class="form-group">
                  <label for="description">Team Name</label>
                  
                  <input type="text" class="form-control has-error" id="description" name="team_name" value="{{ $team->team_name }}" required>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="/teams" class="btn btn-default">Back</a>
              </div>
            </form>
            
          </div>
    </div>
</div>
@endsection