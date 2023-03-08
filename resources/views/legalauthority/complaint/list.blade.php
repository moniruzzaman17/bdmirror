@extends('layouts.app')
@section('title', __('Complaint List BD Mirror'))
@section('body-class', 'complaint-list-home')
@section('content')
<div class="complaint-list-wrapper">
    <div class="container table-responsive py-5">
        <table class="table table-bordered table-hover">
            <thead class="thead-bg">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Rating</th>
                    <th scope="col">Opinion</th>
                    <th scope="col">Status</th>
                    <th scope="col">Division</th>
                    <th scope="col">District</th>
                    <th scope="col">Upazila</th>
                    <th scope="col">Details</th>
                </tr>
            </thead>
            <tbody>
                @php
                $j = 1;
                @endphp
                @foreach($complaints as $key => $complaint)
                @php
                $words = explode(' ', $complaint->details);
                $title = '';
                for ($i=0; $i < 9 ; $i++) { $title .=$words[$i]." "; } 
                $title.=" ...."; @endphp <tr>
                    <th scope=" row">{{ $j++ }}</th>
                    <td>{{ $title }}</td>
                    <td>
                        @if (count($complaint->ratings) > 0)
                        {{ count($complaint->ratings); }} <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                        @endif
                    </td>
                    <td>
                        @if (count($complaint->comments) > 0)
                        {{ count($complaint->comments) }} <i class="fa fa-comment" aria-hidden="true"></i>
                        @endif
                    </td>
                    <td style="width: 136px;">
                        <select name="" id="status" class="form-controll common-list-button common-list-select w-100">
                            <option value="" selected disabled> Select Status..</option>
                            @foreach($statuses as $key => $status)
                            @if($status->id == $complaint->status)
                            <option value="{{ $status->id }}" data-complaintID="{{ $complaint->id }}" selected>{{ $status->name}}</option>
                            @else
                            <option value="{{ $status->id }}" data-complaintID="{{ $complaint->id }}">{{ $status->name}}</option>
                            @endif
                            @endforeach
                        </select>

                        {{-- {{ $complaint->complaintstatus->name }} --}}
                    </td>
                    <td>{{ $complaint->complaintdivision->name }}</td>
                    <td>{{ $complaint->complaintdistrict->name }}</td>
                    <td>{{ $complaint->complaintupazila->name }}</td>
                    <td><a href="{{ route('complaint.details',["id" => $complaint->id]) }}"><i class="fa fa-rocket" aria-hidden="true"></i></a></td>


                    </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).on('change', '#status', function() {
        var statusID = this.value;
        var complaintID = $('option:selected', this).attr('data-complaintID');
        var _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "/update-complaint-status"
                // , dataType: 'json'
            , type: "POST"
            , data: {
                statusID: statusID
                , complaintID: complaintID
                , _token: _token
            }
            , success: function(data) {
                swal("Success", "Status has been updated!", "success");
            }
        });
    });

</script>
@endsection
