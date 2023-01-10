<div class="container p-3">
    <div class="profile-header">
        <div class="profile-img">
            @if(empty($citizen->image))
            <img src="{{ asset('img/avatar.png') }}" class="user-image" height="36" width="36" />
            @else
            <img src="{{ $citizen->image }}" class="user-image" height="36" width="36">
            @endif
        </div>
        <div class="profile-nav-info">
            <h3 class="user-name">{{ $citizen->name }}</h3>
            <div class="address">
                <p id="state" class="state">{{ $citizen->citizenDivision->name }}</p>&nbsp;|&nbsp;
                <span id="country" class="country">{{ $citizen->citizenDistrict->name }}</span>&nbsp;|&nbsp;
                <span id="country" class="country">{{ $citizen->citizenUpazila->name }}</span>&nbsp;|&nbsp;

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
                <p class="mobile-no"><i class="fa fa-phone"></i> {{ $citizen->mobile }}</p>
                <p class="user-mail"><i class="fa fa-envelope"></i> {{ $citizen->email }}</p>
                <div class="user-bio">
                    <div class="field">
                        <select name="division" id="division" class="form-controll common-list-button common-list-select w-100 profile-area-select mb-2">
                            <option value="" selected class="division_dummy"> Select Division..</option>
                            @foreach($divisions as $key => $division)
                            @if($division->id == $citizen->division)
                            <option value="{{ $division->id }}" selected>{{ $division->name}} ~ {{ $division->bn_name }}</option>
                            @else
                            <option value="{{ $division->id }}">{{ $division->name}} ~ {{ $division->bn_name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="field">
                        <select name="district" id="district" class="form-controll common-list-button common-list-select w-100 profile-area-select mb-2">
                            <option value="{{ $citizen->district }}" selected hidden disabled class="district_dummy"> {{ $citizen->citizenDistrict->name }} ~ {{ $citizen->citizenDistrict->bn_name }}</option>
                        </select>
                    </div>
                    <div class="field">
                        <select name="upazila" id="upazila" class="form-controll common-list-button common-list-select w-100 profile-area-select mb-2">
                            <option value="{{ $citizen->upazila }}" selected hidden disabled class="upazila_dummy"> {{ $citizen->citizenUpazila->name }} ~ {{ $citizen->citizenUpazila->bn_name }}</option>
                        </select>
                    </div>
                </div>
            </div>

        </div>
        <div class="right-side">

            <div class="nav">
                <ul>
                    <li onclick="tabs(0)" class="user-post active">My Complaints</li>
                    {{-- <li onclick="tabs(1)" class="user-review">Reviews</li>
                    <li onclick="tabs(2)" class="user-setting"> Settings</li> --}}
                </ul>
            </div>
            <div class="profile-body">
                <div class="profile-posts tab pt-0">
                    <div class="mycomplaint-wrapper text-left">
                        @include('profile.mycomplaint')
                    </div>
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
