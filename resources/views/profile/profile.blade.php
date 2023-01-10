@extends('layouts.app')
@section('title', __('Profile | BD Mirror'))
@section('body-class', 'profile-home')
@section('content')
<div class="profile-wrapper">
    @auth('citizen')
    @include('profile.citizenprofilecontent')
    @endauth
    @auth('authority')
    @include('profile.authorityprofilecontent')
    @endauth
</div>
<script>
    $("#division").change(function() {
        var divisionID = this.value;
        var _token = $('meta[name="csrf-token"]').attr('content');
        if (divisionID == "") {
            $('#district').find('option').not(':first').remove();
            $('#upazila').find('option').not(':first').remove();
        }
        $.ajax({
            url: "/get-district"
            , dataType: 'json'
            , type: "POST"
            , data: {
                divisionID: divisionID
                , _token: _token
            }
            , success: function(data) {
                $('#district').find('option').not(':first').remove();
                $('#upazila').find('option').not(':first').remove();
                $.each(data, function(key, district) {
                    $("#district").append('<option value="' + district.id + '">' + district.name + ' ~ ' + district.bn_name + '</option>');
                });
            }
        });
    });

    $("#district").change(function() {
        var districtID = this.value;
        var _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "/get-upazila"
            , dataType: 'json'
            , type: "POST"
            , data: {
                districtID: districtID
                , _token: _token
            }
            , success: function(data) {
                $('#upazila').find('option').not(':first').remove();
                $.each(data, function(key, upazila) {
                    $("#upazila").append('<option value="' + upazila.id + '">' + upazila.name + ' ~ ' + upazila.bn_name + '</option>');
                });
            }
        });
    });

</script>
@endsection
