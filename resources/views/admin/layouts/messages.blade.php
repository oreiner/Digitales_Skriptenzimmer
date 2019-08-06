@if(Session::has('success'))
     <div class="col-md-12">
     <div class="alert callout callout-info alert-dismissable" style="margin-top: 10px; margin-bottom:10px"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Success !</strong>&emsp;
          {{ Session::get('success') }}  
     </div>
     </div>
     <br>

@endif
<div class="col-md-12" id="alertbox">

</div>

{{--@if(count($errors) > 0)--}}
    {{--<div class="alert alert-danger" role="alert">--}}
     {{--<strong>Errors :</strong>--}}
     {{--<ul>--}}
         {{--@foreach($errors->all() as $error)--}}
         {{--<li>  {{ $error }}</li>--}}
         {{--@endforeach--}}
     {{--</ul>--}}
    {{--</div>--}}
{{--@endif--}}