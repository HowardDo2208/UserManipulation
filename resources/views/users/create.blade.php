@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add User</div>

                    <div class="card-body">
                        <form method="POST" action="/users" autocomplete="off">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid  @enderror" name="password"  autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                                </div>
                            </div>



                            <div class="form-group row">
                                <label for="geo-region" class="col-md-4 col-form-label text-md-right">Region</label>
                                <div class="col-md-6">
                                    <select class="form-control" id="geo-region" name="geoRegionId">
                                        <option value="" selected>Select Region</option>
                                        @foreach($regions as $region)
                                            <option
                                                value="{{$region->geoRegionId}}">{{$region->geoRegionName}} {{$region->geoRegionId}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="geo-district" class="col-md-4 col-form-label text-md-right">District</label>
                                <div class="col-md-6">
                                    <select class="form-control" id="geo-district" name="geoDistrictId">
                                        <option value="" selected>Pls Select Region First</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="geo-township" class="col-md-4 col-form-label text-md-right">Town Ship</label>
                                <div class="col-md-6">
                                    <select class="form-control" id="geo-township" name="geoTownShipId">
                                        <option value="" selected>Pls Select Region First</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="geo-town" class="col-md-4 col-form-label text-md-right">Town</label>
                                <div class="col-md-6">
                                    <select class="form-control" id="geo-town" name="geoTownId">
                                        <option value="" selected>Pls Select Region First</option>
                                    </select>
                                </div>
                            </div>


                            <input type="hidden" id="lastPage" name="lastPage" value="{{$lastPage}}">


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Add User
                                    </button>
                                </div>
                            </div>
                        </form>
                        <script src="{{asset('js/users/edit.js')}}"></script>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
