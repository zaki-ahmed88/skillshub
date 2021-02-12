
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
            <h1 class="m-0 text-dark">Show</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
              <li class="breadcrumb-item"><a href="/dashboard/messages">Messages</a></li>
              <li class="breadcrumb-item active">Show</li>
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
                        <h3 class="card-title">Show</h3>

                        <div class="card-tools">

                         
                              
                        </div> 

                        
                    </div>
                    
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                      <table class="table table-hover text-nowrap">
                        
                          <tr>
                           
                            <th>Name</th>
                            <td>{{$message->name}}</td>

                         </tr>

                         <tr>
                           
                            <th>Email</th>
                            <td>{{$message->email}}</td>

                         </tr>

                         <tr>
                           
                            <th>Subject</th>
                            <td>{{$message->subject}}</td>

                         </tr>

                         <tr>
                           
                            <th>Body</th>
                            <td>{{$message->body}}</td>

                         </tr>
                        
                      </table>

                      <div class="d-flex my-3 justify-content-center">
                        
                      </div>


                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->



                   <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Send Response</h3>
                    </div>
                    <div class="card-body p-0">
                            
                            @include('admin.inc.errors')
                            
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="{{url("dashboard/messages/response/$message->id")}}" enctype="multipart/form-data">
                            
                            @csrf
                                
                                <div class="card-body">
                                    
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" class="form-control" name="title">
                                        </div>
                                       

                                       
                                        <div class="form-group">
                                            <label>Body</label>
                                            <input type="text" class="form-control" name="body">
                                        </div>
                                        
                                        <button type="submit" class="btn btn-success" >Submit</button>
                                        <a class="btn btn-sm btn-primary" href="{{url()->previous()}}">Back</a>
                                    </div>
                            
                                </div>
                            <!-- /.card-body -->
                        
                            
                            </form>
                    </div>
                
            </div>
          
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->











@endsection



@section('scripts')

    <script>

       
    </script>
    
@endsection