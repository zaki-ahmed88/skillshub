

@extends('admin.layout')


@section('main')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Admin Page</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Admin Page</li>
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
          

            <div class="col-12 pb-3">
                
                  @include('admin.inc.errors')
                
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{url("dashboard/admins/store")}}" enctype="multipart/form-data">
                  
                  @csrf
                    
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email">
                                </div>
                            </div>                        
                        </div>

                    
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div> 

                            


                            <div class="col-6">
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>   

 
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Role</label>
                                    <select class="custom-select form-control"  name="role_id">
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>



                  
                    <div>
                        <button type="submit" class="btn btn-success" >Submit</button>
                        <a class="btn btn-sm btn-primary" href="{{url()->previous()}}">Back</a>
                    </div>
                   
                  </div>
                  <!-- /.card-body -->
            
                  
                </form>
              </div>


        
        <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

    
@endsection

  
 
 
