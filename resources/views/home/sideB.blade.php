<aside class="side-b">
    <section class="common-section">
        <ul class="common-list">
            <li class="common-list-item">
                <a href="javascript:void(0)" class="common-list-button">
                    <h5>Searched by Area</h5>
                </a>
            </li>
            <li class="common-list-item mb-3">
                <select name="" id="division" class="form-controll common-list-button common-list-select w-100">
                    <option value="" selected> Select Division..</option>
                    @foreach($divisions as $key => $division)
                    <option value="{{ $division->id }}">{{ $division->name}} ~ {{ $division->bn_name }}</option>
                    @endforeach
                </select>
            </li>
            <li class="common-list-item">
                <select name="" id="district" class="form-controll common-list-button common-list-select w-100">
                    <option value="" selected disabled hidden> Select District..</option>
                </select>
            </li>
        </ul>
        <button class="common-more">
            <span class="text">See More</span>
            <span class="icon">🔻</span>
        </button>
    </section>
</aside>
<script>
    $("#division").change(function() {
        var divisionID = this.value;
        var _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "/get-district"
            , dataType: 'json'
            , type: "POST"
            , data: {
                divisionID: divisionID
                , _token: _token
            }
            , success: function(data) {
                $('#msg_body').html(data);
                var objDiv = document.getElementById("chat_body_container");
                objDiv.scrollTop = objDiv.scrollHeight;
            }
        });

        $("#district").append('<option value="">Working</option>');
    });

</script>
