
@if(session('success'))

    <div class="alert alert-success">
        {{ session('success') }}
    </div>

@endif


@if($errors->any())

    <div class="alert alert-danger">

        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
        
    </div>
   

@endif



@if(session('status'))

    <div class="alert alert-success">
        {{ session('status') }}
    </div>

@endif

