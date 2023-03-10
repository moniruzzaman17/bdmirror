<table class="table table-bordered table-hover emergency-contact-table">
    <thead class="thead-bg">
        <tr class="update-row">
            <form action="{{ route('createorupdate.help') }}" method="post" enctype="multipart/form-data">
                @csrf
                <th scope="col">#</th>
                <input type="hidden" name="citizen_id" id="citizen_id" value="{{ Auth::guard('citizen')->user()->id }}">
                <input type="hidden" name="helpID" id="helpID">
                <th scope="col"><input type="text" name="email" id="email"></th>
                <th scope="col"><input type="text" name="mobile" id="mobile"></th>
                <th scope="col"><input type="text" name="relation" id="relation"></th>
                <th scope="col"><button type="submit" class="btn btn-success" style="width: 60px;"><i class="fa fa-paper-plane" aria-hidden="true"></i></button></th>
            </form>
        </tr>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Email</th>
            <th scope="col">Mobile</th>
            <th scope="col">Relation</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @php
        $j = 1;
        @endphp
        @foreach($em_contacts as $key => $em_contact)
        <tr>
            <th scope=" row">{{ $j++ }}</th>
            <td>{{ $em_contact->email }}</td>
            <td>{{ $em_contact->mobile }}</td>
            <td>{{ $em_contact->relation }}</td>
            <td>
                <a href="" data="{{ $em_contact->id }}" class="emergency-edit"><i class="fas fa-edit"></i></a> &nbsp; | &nbsp; <a href="" data="{{ $em_contact->id }}" class="emergency-trash"><i class="fa fa-trash" aria-hidden="true"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(".emergency-edit").click(function(e) {
        e.preventDefault();
        $('#email').val();
        $('#mobile').val();
        $('#relation').val();

        var _token = $('meta[name="csrf-token"]').attr('content');
        var helpID = $(this).attr('data');
        $.ajax({
            url: "/get-helpinfo"
            , dataType: 'json'
            , type: "POST"
            , data: {
                helpID: helpID
                , _token: _token
            }
            , success: function(data) {
                $('#helpID').val(data.id);
                $('#email').val(data.email);
                $('#mobile').val(data.mobile);
                $('#relation').val(data.relation);
                // $('.update-row').show();
            }
        });

    });

</script>
