	<nav id="nav">



        <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
             @csrf
        </form>

					<ul class="main-menu nav navbar-nav navbar-right">
						<li><a href="/">@lang('web.home')</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">@lang('web.cats') <span class="caret"></span></a>
                            <ul class="dropdown-menu">

							@foreach ($cats as $cat)

								<li><a href="{{url("categories/show/{$cat->id}")}}">
									{{-- @if (App::getLocale() == "en")
										{{json_decode($cat->name)->en}}
									@else
										{{json_decode($cat->name)->ar}}
									@endif --}}

									{{$cat->name()}}

								</a></li>

								{{--  true -> array, false -> object, default is false --}}

								{{-- {{json_decode($cat->name)->en}}    =====      {{json_decode($cat->name, true)['en']}} --}}

							@endforeach


                            </ul>
                        </li>
                        <li><a href="{{ url("/contact") }}">{{__('web.contact')}}</a></li>

                        @guest
                            <li><a href="{{ url("/login") }}">@lang('web.signin')</a></li>
                            <li><a href="{{ url("/register") }}">@lang('web.signup')</a></li>
                        @endguest

                        @auth

							@if(Auth::user()->role->name == 'student')
								<li><a href="{{url('/profile')}}">@lang('web.profile')</a></li>

							@else
								<li><a href="{{url('/dashboard')}}">@lang('web.dashboard')</a></li>
								
							@endif


							

                            <li><a id="logout-link" href="#">@lang('web.signout')</a></li>
                        @endauth
						



                        {{--     <input type="submit" value="{{__('web.logout')}}"> --}}




						@if(App:: getLocale() == "ar")
							<li><a href="{{ url("lang/set/en") }}">EN</a></li>
						@else
							<li><a href="{{ url("lang/set/ar") }}">ع</a></li>
						@endif


					</ul>
				</nav>
