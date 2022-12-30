@extends('admin.index')
@section('title', __('Authority User Details / bdmirror'))
@section('body-class', 'bdmirror-authority-user-details')
@section('content')
<div class="grid-container">
    @csrf
    <div class="grid-head">
        <div style="height: 15px;"></div>
        <div class="head-content row">
            <div class="col-sm-4 text-left">
                <h4></h4>
            </div>
            <div class="col-sm-8">
                <a href="{{route('authority.user.approve',['user_id'=>request('user_id')])}}" class="btn action-button mr-2"><i class="fa fa-arrow-left" aria-hidden="true"></i>{{ __(' Back') }}</a>
                @if($authority->is_approved == 0)
                <a href="{{route('authority.user.approve',['user_id'=>request('user_id')])}}" class="btn action-button mr-2"><i class="fa fa-check" aria-hidden="true"></i>{{ __(' Approve') }}</a>

                @else
                <a href="{{route('authority.user.refuse',['user_id'=>request('user_id')])}}" class="btn action-button bg-danger mr-2"><i class="fa fa-times" aria-hidden="true"></i>{{ __(' Remove Approval') }}</a>

                @endif
                <a href="{{route('authority.user.delete',['user_id'=>request('user_id')])}}" onclick="return confirm('Are you sure?')" class="btn action-button mr-2"><i class="fa fa-trash" aria-hidden="true"></i>{{ __(' Delete User') }}</a>

            </div>
        </div>
    </div>
    @if(session()->has('success'))
    <div class="alert alert-success" role="alert">
        <i class="fa fa-check" aria-hidden="true"></i> {{ session()->get('success') }}
    </div>
    @elseif(session()->has('failed'))
    <div class="alert alert-danger" role="alert">
        <i class="fa fa-times" aria-hidden="true"></i> {{ session()->get('failed') }}
    </div>
    @elseif(session()->has('warning'))
    <div class="alert alert-warning" role="alert">
        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> {{ session()->get('warning') }}
    </div>
    @elseif ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $message)
            <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div style="height: 30px;"></div>
    <div class="details-container">
        <div class="p-3">
            <div class="profile-header">
                <div class="profile-img">
                    <img src="{{ asset('img/moon.jpg') }}" width="200" alt="Profile Image">
                </div>
                <div class="profile-nav-info">
                    <h3 class="user-name">{{$authority->name}}</h3>
                    <div class="address">
                        <p id="state" class="state">Rangpur</p>
                        <span id="country" class="country">Nilphamari</span>
                    </div>

                </div>
                <div class="profile-option">
                    <div class="notification">
                        <i class="fa fa-bell"></i>
                        <span class="alert-message">3</span>
                    </div>
                </div>
            </div>

            <div class="main-bd">
                <div class="left-side">
                    <div class="profile-side">
                        <p class="mobile-no"><i class="fa fa-phone"></i> +8801761189963</p>
                        <p class="user-mail"><i class="fa fa-envelope"></i> bdmirror@gmail.com</p>
                        <div class="user-bio">
                            <h3>Bio</h3>
                            <p class="bio">
                                Lorem ipsum dolor sit amet, hello how consectetur adipisicing elit. Sint consectetur provident magni yohoho consequuntur, voluptatibus ghdfff exercitationem at quis similique. Optio, amet!
                            </p>
                        </div>
                        <div class="profile-btn">
                            <button class="chatbtn" id="chatBtn"><i class="fa fa-comment"></i> Chat</button>
                            <button class="createbtn" id="Create-post"><i class="fa fa-plus"></i> Create</button>
                        </div>
                        <div class="user-rating">
                            <h3 class="rating">4.5</h3>
                            <div class="rate">
                                <div class="star-outer">
                                    <div class="star-inner">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </div>
                                <span class="no-of-user-rate"><span>123</span>&nbsp;&nbsp;reviews</span>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="right-side">

                    <div class="nav">
                        <ul>
                            <li onclick="tabs(0)" class="user-post active">Posts</li>
                            <li onclick="tabs(1)" class="user-review">Reviews</li>
                            <li onclick="tabs(2)" class="user-setting"> Settings</li>
                        </ul>
                    </div>
                    <div class="profile-body">
                        <div class="profile-posts tab">
                            <h1>Your Post</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa quia sunt itaque ut libero cupiditate ullam qui velit laborum placeat doloribus, non tempore nisi ratione error rem minima ducimus. Accusamus adipisci quasi at itaque repellat sed
                                magni eius magnam repellendus. Quidem inventore repudiandae sunt odit. Aliquid facilis fugiat earum ex officia eveniet, nisi, similique ad ullam repudiandae molestias aspernatur qui autem, nam? Cupiditate ut quasi iste, eos perspiciatis maiores
                                molestiae.</p>
                        </div>
                        <div class="profile-reviews tab">
                            <h1>User reviews</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam pariatur officia, aperiam quidem quasi, tenetur molestiae. Architecto mollitia laborum possimus iste esse. Perferendis tempora consectetur, quae qui nihil voluptas. Maiores debitis
                                repellendus excepturi quisquam temporibus quam nobis voluptatem, reiciendis distinctio deserunt vitae! Maxime provident, distinctio animi commodi nemo, eveniet fugit porro quos nesciunt quidem a, corporis nisi dolorum minus sit eaque error
                                sequi ullam. Quidem ut fugiat, praesentium velit aliquam!</p>
                        </div>
                        <div class="profile-settings tab">
                            <div class="account-setting">
                                <h1>Acount Setting</h1>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit omnis eaque, expedita nostrum, facere libero provident laudantium. Quis, hic doloribus! Laboriosam nemo tempora praesentium. Culpa quo velit omnis, debitis maxime, sequi
                                    animi dolores commodi odio placeat, magnam, cupiditate facilis impedit veniam? Soluta aliquam excepturi illum natus adipisci ipsum quo, voluptatem, nemo, commodi, molestiae doloribus magni et. Cum, saepe enim quam voluptatum vel debitis
                                    nihil, recusandae, omnis officiis tenetur, ullam rerum.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(".nav ul li").click(function() {
                $(this)
                    .addClass("active")
                    .siblings()
                    .removeClass("active");
            });

            const tabBtn = document.querySelectorAll(".nav ul li");
            const tab = document.querySelectorAll(".tab");

            function tabs(panelIndex) {
                tab.forEach(function(node) {
                    node.style.display = "none";
                });
                tab[panelIndex].style.display = "block";
            }
            tabs(0);

            let bio = document.querySelector(".bio");
            const bioMore = document.querySelector("#see-more-bio");
            const bioLength = bio.innerText.length;

            function bioText() {
                bio.oldText = bio.innerText;

                bio.innerText = bio.innerText.substring(0, 100) + "...";
                bio.innerHTML += `<span onclick='addLength()' id='see-more-bio'>See More</span>`;
            }
            // console.log(bio.innerText)

            bioText();

            function addLength() {
                bio.innerText = bio.oldText;
                bio.innerHTML +=
                    "&nbsp;" + `<span onclick='bioText()' id='see-less-bio'>See Less</span>`;
                document.getElementById("see-less-bio").addEventListener("click", () => {
                    document.getElementById("see-less-bio").style.display = "none";
                });
            }
            if (document.querySelector(".alert-message").innerText > 9) {
                document.querySelector(".alert-message").style.fontSize = ".7rem";
            }

        </script>
    </div>
</div>
@endsection
