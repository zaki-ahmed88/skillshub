
@extends('admin.layout')

@section('main')


{{-- //https://adminlte.io/themes/v3/ --}}

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Students</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
              <li class="breadcrumb-item active">Students</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->




    




    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                


                @include('admin.inc.messages')


                  <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Students</h3>

                        <div class="card-tools">

                         
                              
                        </div> 

                        
                    </div>
                    
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                      <table class="table table-hover text-nowrap">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Verified</th>
                            <th>Actions</th>
                         </tr>
                        </thead>
                        <tbody>

                            @foreach ($students as $student)

                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td >{{ $student->name }}</td>
                                    <td >{{ $student->email }}</td>

                                    <td >
                                        @if($student->email_verified_at != null)
                                            <span class="badge bg-success">yes</span>
                                        @else
                                            <span class="badge bg-danger">no</span>    
                                        @endif
                                    </td>

                                    <td >
                                        <a href="{{url("/dashboard/students/show-scores/$student->id")}}" class="btn btn-sm btn-success">
                                            <i class="fas fa-percent"></i>
                                        </a>
                                    </td>

                                    

                                   
                                </tr>

                                
                            @endforeach
                         
                        </tbody>
                      </table>

                      <div class="d-flex my-3 justify-content-center">
                        {{ $students->links() }}  
                      </div>


                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                
            </div>
          
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->




    {{-- <div class="modal fade" id="add-modal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add New</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>

            <div class="modal-body">

            @include('admin.inc.errors')
              
                <form method="POST" action="{{url("dashboard/exams/store")}}" id="add-form" enctype="multipart/form-data">

                      @csrf


                       <div class="row">

                            <div class="col-6">
                                <div class="form-group">
                                    <label >Name (en)</label>
                                    <input type="text" name = "name_en" class="form-control" >
                                </div>      
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label >Name (ar)</label>
                                    <input type="text" name = "name_ar" class="form-control" >
                                </div>
                            </div>

                      </div>

                      <div class="row">

                       <div class="col-6">
                            <div class="form-group">
                              <label>Category</label>
                              <select class="custom-select form-control" name="cat_id">
                                @foreach($cats as $cat)
                                
                                    <option value="{{$cat->id}}">{{$cat->name('en')}}</option>
                                    
                                @endforeach
                                
                              </select>
                            </div>
                        </div>

                        <div class="col-6">
                           <div class="form-group">
                                <label for="exampleInputFile">Image</label>
                                <div class="input-group">
                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="img">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                  </div>
                                  
                                </div>
                            </div>    
                        </div>

                       

                      </div>

           
                </form>

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" form="add-form" class="btn btn-primary">Submit</button>

            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div> --}}



  {{--   <div class="modal fade" id="edit-modal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">

             @include('admin.inc.errors')
              
                <form method="POST" action="{{url("dashboard/exams/update")}}" id="edit-form" enctype="multipart/form-data">

                    @csrf

                    <input type="hidden" name="id" id="edit-form-id">

                    <div class="row">

                        <div class="col-6">
                            <div class="form-group">
                                <label >Name (en)</label>
                                <input type="text" name = "name_en" class="form-control" id="edit-form-name-en">
                            </div>      
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label >Name (ar)</label>
                                <input type="text" name = "name_ar" class="form-control" id="edit-form-name-ar">
                            </div>
                        </div>

                    </div>



                    <div class="row">

                       <div class="col-6">
                            <div class="form-group">
                              <label>Category</label>
                              <select class="custom-select form-control" name="cat_id" id="edit-form-cat-id">
                                @foreach($cats as $cat)
                                
                                    <option value="{{$cat->id}}">{{$cat->name('en')}}</option>

                                    
                                @endforeach
                                
                              </select>
                            </div>
                        </div>

                        <div class="col-6">
                           <div class="form-group">
                                <label for="exampleInputFile">Image</label>
                                <div class="input-group">
                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="img">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                  </div>
                                  
                                </div>
                            </div>    
                        </div>

           
                </form>

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" form="edit-form" class="btn btn-primary">Submit</button>

            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div> --}}










@endsection



@section('scripts')

    <script>

       
    </script>
    
@endsection