@extends('layouts.master')

@section('title', 'Edit Position')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
	  <h1>Edit Position</h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ action('PositionController@update', ['id' => $position->id]) }}" method="POST">
              @method('PATCH')
              @csrf
              <div class="box-body" style="padding-bottom: 0">
                <div class="form-group">
                  <label for="description">Position Name</label>
                  
                  <input type="text" class="form-control" id="position_name" name="name" value="{{ $position->name }}" required>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="/positions" class="btn btn-default">Back</a>
              </div>
            </form>
            
          </div>
    </div>
</div>
@endsection