@extends('layouts.download')
@section('title', 'Download')
@section('content')
    <!-- Teachers Area section -->
    <section class="register-area">
        <div class="container">
            <div class="row">
             <div class="col-md-12">


                 <div class="table-responsive">
                     <table class="table table-condensed" cellspacing="0" width="100%">
                         <thead>
                         <tr style="background-color: rgb(246,246,246)">
                             <th class="align-center" style="width: 1%">ID</th>
                             <th>Titel</th>
							 <th>Semester</th>
                             <th>Fach</th>
                             <th>Beschreibung</th>
                             <th>Datei herunterladen</th>
                         </tr>
                         </thead>
                         <tbody>
                         <?php $num=1 ?>
						 
                         @foreach($downloads as $download)
                             <tr id="companyidrow{{ $download->id }}">
                                 <td><?php echo $num++ ?></td>
                                 <td>{{$download->title}}</td>
								 <!--
								 <td>{{$download->Semester}}</td>
								 !-->
                                 <td>{{$download->category}}</td>
                                 <td>{{$download->description}}</td>
                                 {{--<td>{{Html::image($patient->pati_picture,$patient->pati_name,['height='=>'30','width'=>'30'])}}</td>--}}
                                 {{--<td >{{date('M j, Y', strtotime($company->created_at))}}</td>--}}
                                 <td  style="width: 10%;">
                                     <a href="{{url('getDownload/'.$download->id)}}"><i class="fa fa-download"></i> </a>
                                 </td>


                             </tr>
                         @endforeach
						 
                         </tbody>
                     </table>


                     <div class="paginator" style="text-align: center">
                         {{ $downloads->links() }}
                     </div>
                 </div>





             </div>
            </div>
        </div>
    </section>
    <!-- ./ End Teachers Area section -->
{{--<div class="container">--}}
    {{--<div class="row justify-content-center">--}}
        {{--<div class="col-md-8">--}}
            {{--<div class="card">--}}
                {{--<div class="card-header">{{ __('Register') }}</div>--}}

                {{--<div class="card-body">--}}
                    {{--<form method="POST" action="{{ route('register') }}">--}}
                        {{--@csrf--}}

                        {{--<div class="form-group row">--}}
                            {{--<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>--}}

                                {{--@if ($errors->has('name'))--}}
                                    {{--<span class="invalid-feedback" role="alert">--}}
                                        {{--<strong>{{ $errors->first('name') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row">--}}
                            {{--<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>--}}

                                {{--@if ($errors->has('email'))--}}
                                    {{--<span class="invalid-feedback" role="alert">--}}
                                        {{--<strong>{{ $errors->first('email') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row">--}}
                            {{--<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>--}}

                                {{--@if ($errors->has('password'))--}}
                                    {{--<span class="invalid-feedback" role="alert">--}}
                                        {{--<strong>{{ $errors->first('password') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row">--}}
                            {{--<label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row mb-0">--}}
                            {{--<div class="col-md-6 offset-md-4">--}}
                                {{--<button type="submit" class="btn btn-primary">--}}
                                    {{--{{ __('Register') }}--}}
                                {{--</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
@endsection
