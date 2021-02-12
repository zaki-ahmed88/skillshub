

@extends('admin.layout')


@section('main')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Starter Page</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
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
                <form method="POST" action="{{url("dashboard/exams/update/$exam->id")}}" enctype="multipart/form-data">

                  @csrf

                  <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Name(en)</label>
                                <input type="text" class="form-control" name="name_en" value="{{ $exam->name('en') }}">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label>Name(ar)</label>
                                <input type="text" class="form-control" name="name_ar"  value="{{ $exam->name('ar') }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Description(en)</label>
                        <textarea rows="5" class="form-control" name="desc_en" >{{ $exam->desc('en') }}</textarea>
                    </div>

                     <div class="form-group">
                        <label>Description(ar)</label>
                        <textarea rows="5" class="form-control" name="desc_ar" >{{ $exam->desc('ar') }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Skill</label>
                                <select class="custom-select form-control" id="edit-form-cat-id" name="skill_id">

                                    @foreach($skills as $skill)

                                        <option value="{{$skill->id}}"


                                            @if($exam->skill_id == $skill->id)

                                                selected

                                            @endif>

                                        {{$skill->name('en')}}
                                        </option>

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



                    <div class="row">

                        <div class="col-4">
                            <div class="form-group">
                                <label>Question no.</label>
                                <input type="number" class="form-control" name="questions_no" value="{{ $exam->questions_no }}">
                            </div>

                        </div>


                        <div class="col-4">
                            <div class="form-group">
                                <label>Difficulty</label>
                                <input type="number" class="form-control" name="difficulty" value="{{ $exam->difficulty }}">
                            </div>

                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label>Duration (mins.)</label>
                                <input type="number" class="form-control" name="duration_mins" value="{{ $exam->duration_mins }}">
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




