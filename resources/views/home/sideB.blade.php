<aside class="side-b">
    <section class="common-section">
        <ul class="common-list">
            <form action="{{ route('filter') }}" method="get" enctype="multipart/form-data">
                {{-- @csrf --}}
                <li class="common-list-item">
                    <a href="javascript:void(0)" class="common-list-button">
                        <h5>Searched by Area</h5>
                    </a>
                </li>
                <li class="common-list-item mb-3">
                    <select name="div" id="division" class="form-controll common-list-button common-list-select w-100" required>
                        <option value="" selected> Select Division..</option>
                        @foreach($divisions as $key => $division)
                        <option value="{{ $division->id }}">{{ $division->name}} ~ {{ $division->bn_name }}</option>
                        @endforeach
                    </select>
                </li>
                <li class="common-list-item mb-3">
                    <select name="dis" id="district" class="form-controll common-list-button common-list-select w-100">
                        <option value="" selected> Select District..</option>
                    </select>
                </li>
                <li class="common-list-item">
                    <select name="upa" id="upazila" class="form-controll common-list-button common-list-select w-100">
                        <option value="" selected> Select Upazila..</option>
                    </select>
                </li>
                <li class="common-list-item mt-4">
                    <button type="submit" class="btn btn-success">Search</button>
                </li>
            </form>
        </ul>
        {{-- <button class="common-more">
            <span class="text">See More</span>
            <span class="icon">🔻</span>
        </button> --}}
    </section>
</aside>
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
