@extends('validation/index')
@section('style')
<style>
    
    .errorMessageClass{
        color: white;
    }
</style>
@stop
@section('content')
<!-- /.box-header -->

<div class="box-body">
    <div class="col-md-6 col-md-offset-2">
        <div class="box box-primary"> 
            <div class="box-header with-border">
                <h3 class="box-title">Edit Data</h3>
            </div>
            <form  role="form" method="post" action="{{URL::route('practise')}}" id="registration-form">
                <div class="box-body">
                    {{csrf_field()}}
                    <div class="form-group">
                        <p>
                        <label for="name" class="control-label">Name</label>
                         <input type="text" data-validation-error-msg="Name should be alphanumeric min 5 characters"  id="name" class="form-control" name="name"  data-validation="length alphanumeric" data-validation-length="min5">
                    </p></div>
                    <div class="form-group">
                        <p>
                        <label for="pass_confirmation" class="control-label">Password</label>
                        <input type="password" data-validation-error-msg="password should be strong enough" class="form-control"   name="pass_confirmation" data-validation="strength" 
                               data-validation-strength="1"></p></div>
                    <div class="form-group">
                        <p>
                        <label for="pass" class="control-label">Confirm Password</label>
                        <input type="password" name="pass" class="form-control" data-validation-confirm="pass_confirmation" data-validation="confirmation">
                        </p></div>
                
                    <div class="form-group">
                        
                        <label for="date" class="control-label">Birth date</label>
                        <input type="date" class="form-control" name="date" data-validation="birthdate" 
                      data-validation-help="yyyy-mm-dd (Not allowing dates in...">
	
                        
                    </div>
                    <div class="form-group">
                        <label for="reg" class="control-label">
                            Regex Validation
                        </label>
                        <input type="text"data-validation-error-msg="small letter characters only" class="form-control" name="reg" data-validation="custom" data-validation-regexp="^([a-z]+)$">
                    </div>
                </div>
                
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" id="subm" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>


</div>
@stop

@section('script')

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.19/jquery.form-validator.min.js"></script>
<script>
$.validate({
  modules : 'security date'
});
</script>
@stop
