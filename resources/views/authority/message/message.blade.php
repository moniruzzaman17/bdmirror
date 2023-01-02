@extends('authority.layouts.app')
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
                <input type="hidden" id="user_type" value="authority">
                <input type="hidden" id="sender_id" value="{{ Auth::guard('authority')->user()->id }}">
                <input type="hidden" id="receiver_id" value="{{ request('id') }}">
                @elseif(Auth::guard('citizen')->check())
                <input type="hidden" id="user_type" value="citizen">
                <input type="hidden" id="sender_id" value="{{ Auth::guard('citizen')->user()->id }}">
                <input type="hidden" id="receiver_id" value="{{ request('id') }}">
                @else
                @endif
            </div>
            <ul class="bar_tool">
                <li><span class="alink"><i class="fas fa-phone"></i></span></li>
                <li><span class="alink"><i class="fas fa-video"></i></span></li>
                <li><span class="alink"><i class="fas fa-ellipsis-v"></i></span></li>
            </ul>
        </div>
        <div class="body" id="msg_body">
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
        var user_type = $("#user_type").val();
        var sender_id = $("#sender_id").val();
        var receiver_id = $("#receiver_id").val();
        var _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "/send-message"
            , type: "POST"
            , data: {
                message: message
                , user_type: user_type
                , sender_id: sender_id
                , receiver_id: receiver_id
                , _token: _token
            },

            // shows the loader element before sending.
            beforeSend: function() {
                $(".msg-spinner").fadeIn('fast');
            }
            , success: function(data) {
                $(".msg").val("");
                $('#msg_body').html(data);
                var objDiv = document.getElementById("chat_body_container");
                objDiv.scrollTop = objDiv.scrollHeight;

            }
            , error: function(response) {
                console.log('Error Function Working');
            }
        });
    });

    // keep chat scrooll always down
    var objDiv = document.getElementById("chat_body_container");
    objDiv.scrollTop = objDiv.scrollHeight;


    // Auto view chat
    // var interval = setInterval(viewChatTimer, 1000);
    var interval;
    var mouseinside = false;

    function viewChatTimer() {
        console.log('interval working');
        var user_type = $("#user_type").val();
        var sender_id = $("#sender_id").val();
        var receiver_id = $("#receiver_id").val();
        $.ajax({
            url: "/view-message"
            , type: "GET"
            , data: {
                user_type: user_type
                , sender_id: sender_id
                , receiver_id: receiver_id
            }
            , success: function(data) {
                $('#msg_body').html(data);
                var objDiv = document.getElementById("chat_body_container");
                objDiv.scrollTop = objDiv.scrollHeight;
            }
        });
    }

    $("#msg_body").mouseenter(function() {
        clearInterval(interval);
    });

    $("#msg_body").mouseleave(function() {
        clearInterval(interval);
        interval = setInterval(viewChatTimer, 1000);
    });
    clearInterval(interval);
    interval = setInterval(viewChatTimer, 1000);

</script>
@endsection
