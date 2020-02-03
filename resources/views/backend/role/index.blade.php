@extends('layouts.backend')
@section('title','Role List')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Role Management
            <small>it all about role</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Role</a></li>
            <li class="active">List Role</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Title</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    @include('backend.includes.flash_message')
                    <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($data['rows'] as $key => $row)
                    <tr>
                       <td>{{$key+1}}</td>
                        <td>{{$row->name}}</td>
                        <td>
                            @if($row->status == 1)
                                <span class="label label-success">Active</span>
                            @else
                                <span class="label label-danger">De-active</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('backend.role.edit',$row->id)}}" class="btn btn-warning">Edit</a>
                            <a href="{{route('backend.role.show',$row->id)}}" class="btn btn-info">Show</a>
                            {!! Form::open(['route' => ['backend.role.destroy',$row->id], 'method' => 'delete']) !!}
                            {!! Form::submit('Delete',['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                Footer
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
