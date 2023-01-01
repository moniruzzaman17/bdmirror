@extends('layouts.app')
@section('title', __('Message | BD Mirror'))
@section('body-class', 'message-home')
@section('content')
<div class="message-wrapper">
    <div class="chat_box">
        <div class="head">
            <div class="user">
                <div class="avatar">
                    <img src="https://picsum.photos/g/40/40" />
                </div>
                <div class="name">{{ $user->name }}</div>
                @if(Auth::guard('authority')->check())
                <input type="hidden" id="type" value="authority">
                <input type="hidden" id="sender_id" value="{{ Auth::guard('authority')->user()->id }}">
                <input type="hidden" id="receiver_id" value="{{ request('id') }}">
                @elseif(Auth::guard('citizen')->check())
                <input type="hidden" id="type" value="citizen">
                <input type="hidden" id="sender_id" value="{{ Auth::guard('citizen')->user()->id }}">
                <input type="hidden" id="receiver_id" value="{{ request('id') }}">
                @endif
            </div>
            <ul class="bar_tool">
                <li><span class="alink"><i class="fas fa-phone"></i></span></li>
                <li><span class="alink"><i class="fas fa-video"></i></span></li>
                <li><span class="alink"><i class="fas fa-ellipsis-v"></i></span></li>
            </ul>
        </div>
        <div class="w-100 message-body-wrapper">
            @include('message.messagebody')
        </div>
        <div class="foot">
            <input type="text" class="msg" placeholder="Type a message..." />
            <button type="submit" id="send_msgBTN"><i class="fas fa-paper-plane"></i></button>
        </div>
    </div>
</div>
<script>
    $(document).on('click', '#send_msgBTN', function(event) {
        event.preventDefault();
        var message = $(".msg").val();
        var utype = $("#type").val();
        var sender_id = $("#sender_id").val();
        var receiver_id = $("#receiver_id").val();




        var _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "/send-message"
            , dataType: 'json'
            , type: "POST"
            , data: {
                message: message
                , utype: utype
                , sender_id: sender_id
                , receiver_id: receiver_id
                , _token: _token
            },

            // shows the loader element before sending.
            beforeSend: function() {
                $(".msg-spinner").fadeIn('fast');
            }
            , success: function(data) {
                $('.message-body-wrapper').html(data);
            }
            , error: function(response) {
                console.log('Error Function Working');
            }
        });
    });

</script>
@endsection
