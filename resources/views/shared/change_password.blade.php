@extends('shared.header')

@section('title', 'User')

@section('content')

<div class="container">
    @if(\Session::has('success'))
    <div class="alert alert-dismissible alert-success mt-4" id="alert-success">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>{!! \Session::get('success') !!}</strong>
    </div>
    @elseif(\Session::has('failed'))
    <div class="alert alert-dismissible alert-danger mt-4" id="alert-failed">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>{!! \Session::get('failed') !!}</strong>
    </div>
    @endif
</div>


<div class="container">
    
<div class="card card-primary card-outline mt-3">
    <div class="card-body">
        <div class="card-body mb-3">
            <h3>Ganti Password</h3>
        </div>
        <form action="{{url('/update-password')}}" id="change_password_form" method="post">
            @method('PATCH')
            @csrf
            <div class="form-group col-5">
                <label for="old_password">Old Password</label>
                <input type="password" name="old_password" class="form-control" id="old_password" >
            
                @if($errors->any('old_password'))
                <span class="text-danger">{{$errors->first('old_password')}}</span>
                @endif
            </div>
            <div class="form-group col-5">
                <label for="password">New Password</label>
                <input type="password" name="new_password" class="form-control" id="new_password" >
                @if($errors->any('new_password'))
                <span class="text-danger">{{$errors->first('new_password')}}</span>
                @endif
            </div>
            <div class="form-group col-5">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" id="confirm_password" >
                @if($errors->any('confirm_password'))
                <span class="text-danger">{{$errors->first('confirm_password')}}</span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update Password</button>
        </form>
    </div>
  </div>
</div>
  @endsection

@section('script')
    <script>
        $('.btn-close').on('click', (e) => {
            $('#alert-success').addClass('d-none');
            $('#alert-failed').addClass('d-none');
        })
    </script>   
@endsection