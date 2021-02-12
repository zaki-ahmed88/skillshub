
@extends('web.layout')

@section('title')

    Verify Email
    
@endsection

@section('main')

    <div class="alert alert-success">

        {{__('web.verificationAlert')}}

    </div>


    <!-- Contact -->
		<div id="contact" class="section">

			<!-- container -->
			<div class="container">

				<!-- row -->
				<div class="row">

					<!-- login form -->
					<div class="col-md-6 col-md-offset-3">
						<div class="contact-form">

                                <form method="POST" action="{{url('/email/verification-notification')}}">

                                    @csrf

                                    <button type="submit" class="main-button icon-button pull-right"> {{__('web.resendEmail')}}</button>

                                </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    
@endsection