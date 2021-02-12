
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
            <h1 class="m-0 text-dark">Messages</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
              <li class="breadcrumb-item active">Messages</li>
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
                        <h3 class="card-title">All Messages</h3>

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
                            <th>Subject</th>
                            <th>Actions</th>
                         </tr>
                        </thead>
                        <tbody>

                            @foreach ($messages as $message)

                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td >{{ $message->name }}</td>
                                    <td >{{ $message->email }}</td>
                                    <td >{{ $message->subject ?? "..." }}</td>

                                    

                                    <td >
                                        <a href="{{url("/dashboard/messages/show/$message->id")}}" class="btn btn-sm btn-success">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>

                                    

                                   
                                </tr>

                                
                            @endforeach
                         
                        </tbody>
                      </table>

                      <div class="d-flex my-3 justify-content-center">
                        {{ $messages->links() }}  
                      </div>


                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                


               
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