@extends('layouts.app')

@section('title')
    Datatable
@endsection

@section('links')
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
@endsection


@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title pull-left">
                Student List
            </h3>
            <button class="btn btn-success pull-right create"><i class="glyphicon glyphicon-plus"></i> Create</button>
            <button class="btn btn-success pull-right import" style="margin-right:10px;"><i class="glyphicon glyphicon-import"></i> Import</button>
            <div class="dropdown">
              <button class="dropbtn"><i class="glyphicon glyphicon-export"></i> Export</button>
              <div class="dropdown-content">
                <a class="dropdown-item" href="{{ route('excel-file',['type'=>'xlsx']) }}">Download Excel</a>
                <a class="dropdown-item" href="{{ route('excel-file',['type'=>'csv']) }}">Download CSV</a>
              </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="table-responsive">
            <table id="students-table" class="table" style="width:100% !important">
                <thead>
                    <td>Name</td>
                    <td>DOB (YYYY-MM-DD)</td>
                    <td>Class</td>
                    <td>Gender</td>
                    <td>Status</td>
                    <td>District</td>
                    <td>State</td>
                    <td>Donor</td>
                    <td>Actions</td>
                </thead>
            </table>
        </div>

    </div>

<div id="modalImport" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Import</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div style="padding: 20px;">
          {!! Form::open(array('route' => 'import-csv-excel','method'=>'POST','files'=>'true')) !!}
           <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12">
                   <div class="form-group">
                       {!! Form::label('sample_file','Select File to Import:',['class'=>'col-md-3']) !!}
                       <div class="col-md-9">
                       {!! Form::file('sample_file', array('class' => 'form-control')) !!}
                       {!! $errors->first('sample_file', '<p class="alert alert-danger">:message</p>') !!}
                       </div>
                   </div>
               </div>
               <div class="col-xs-12 col-sm-12 col-md-12 text-center">
               {!! Form::submit('Upload',['class'=>'btn btn-primary']) !!}
               </div>
           </div>
          {!! Form::close() !!}
        </div>
      </div>
      </div>
    </div>

    {{-- modal for add --}}
    <div id="modalAdd" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Modal Header</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="store">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="studname">Full Name</label>
                            <input type="text" class="form-control studname" name="studname" placeholder="Enter name" required>
                        </div>
                        <div class="form-group">
                            <label for="dob">Birth Date</label>
                            <input type="date" class="form-control dob" name="dob" value="1990-12-30" >
                        </div>
                        <div class="form-group">
                            <label for="class">Class</label>
                            <input type="number" class="form-control class" name="class">
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select class="form-control gender" name="gender">
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control status" name="status">
                              <option value="Sponsered">Sponsered</option>
                              <option value="Unsponsered">Unsponsered</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="address">District</label>
                            <input type="text" class="form-control district" name="district" placeholder="Enter district name" required>
                        </div>
                        <div class="form-group">
                            <label for="state">State</label>
                            <input type="text" class="form-control district" name="status" placeholder="Enter State name" required>
                        </div>
                        <div class="form-group">
                            <label for="donor">Donor</label>
                            <input type="text" class="form-control donor" name="donor" placeholder="Enter donor's name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </form>
            </div>

        </div>
    </div>

    <div id="modalEdit" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Modal Header</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="update">
                    <div class="modal-body">
                        <input type="hidden" name="id" class="id">
                        <div class="form-group">
                            <label for="studname">Full Name</label>
                            <input type="text" class="form-control studname" name="studname" placeholder="Enter name" required>
                        </div>
                        <div class="form-group">
                            <label for="dob">Birth Date</label>
                            <input type="date" class="form-control dob" name="dob" value="1990-12-30" >
                        </div>
                        <div class="form-group">
                            <label for="class">Class</label>
                            <input type="number" class="form-control class" name="class">
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select class="form-control gender" name="gender">
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control status" name="status">
                              <option value="Sponsered">Sponsered</option>
                              <option value="Unsponsered">Unsponsered</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="address">District</label>
                            <input type="text" class="form-control district" name="district" placeholder="Enter district name" required>
                        </div>
                        <div class="form-group">
                            <label for="state">State</label>
                            <input type="text" class="form-control district" name="status" placeholder="Enter State name" required>
                        </div>
                        <div class="form-group">
                            <label for="donor">Donor</label>
                            <input type="text" class="form-control donor" name="donor" placeholder="Enter donor's name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
