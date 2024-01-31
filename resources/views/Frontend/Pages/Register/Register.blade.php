@extends('Frontend.Layout.App')
@section('title','Register Page')

@section('content')
<section class="registration_area">
    <div class="container">
        <div class="row ">
            <div class="col-md-6 offset-md-3 registration_form">
                   <h2 class="text-center mb-3">Create An Account</h2>
                   @if ($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                    @endif
                   <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                          <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Your Name" name="name">
                        </div>

                        <div class="form-group">
                          <input type="email" class="form-control " id="exampleInputPassword1" placeholder="Email" name="email">
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control " id="exampleInputPassword1" placeholder="Password" name="password">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control " id="exampleInputPassword1" placeholder="Repeat Password" name="password_confirmation">
                        </div>
                       
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                      </form>
                
            </div>
        </div>
    </div>

   </section>



@endsection