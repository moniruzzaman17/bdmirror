<aside class="side-a">
    <section class="common-section text-center">
        <ul class="common-list">
            <li class="common-list-item">
                <a href="{{ route('profile') }}" class="common-list-button">
                    <span class="icon">
                        @auth('citizen')
                        @if(empty(Auth::guard('citizen')->user()->image))
                        <img src="{{ asset('img/avatar.png') }}" class="user-image" height="36" width="36" />
                        @else
                        <img src="{{ Auth::guard('citizen')->user()->image }}" class="user-image" height="36" width="36" />
                        @endif
                        @endauth
                        @auth('authority')
                        @if(empty(Auth::guard('authority')->user()->image))
                        <img src="{{ asset('img/avatar.png') }}" class="user-image" height="36" width="36" />
                        @else
                        <img src="{{ Auth::guard('authority')->user()->image }}" class="user-image" height="36" width="36" />
                        @endif
                        @endauth

                    </span>
                    <span class="text">{{ $logedUser->name }}</span>
                </a>
            </li>
            <li class="common-list-item">
                @include('home.leftAreaReport')
            </li>
            {{-- <li class="common-list-item">
                <a class="common-list-button">
                    <span class="icon" aria-hidden="true">💬</span>
                    <span class="text">Messenger</span>
                </a>
            </li>
            <li class="common-list-item">
                <a class="common-list-button">
                    <span class="icon">👨&zwj;👦&zwj;👦</span>
                    <span class="text">Groups</span>
                </a>
            </li>
            <li class="common-list-item">
                <a class="common-list-button">
                    <span class="icon">🏪</span>
                    <span class="text">Marketplace</span>
                </a>
            </li>
            <li class="common-list-item">
                <a class="common-list-button">
                    <span class="icon">📺</span>
                    <span class="text">Videos</span>
                </a>
            </li> --}}
        </ul>
        <button class="common-more">
            <span class="text">See More</span>
            <span class="icon">🔻</span>
        </button>
    </section>
</aside>
