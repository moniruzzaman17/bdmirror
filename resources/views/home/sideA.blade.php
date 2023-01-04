<aside class="side-a">
    <section class="common-section text-center">
        <ul class="common-list">
            <li class="common-list-item">
                <a href="{{ route('profile') }}" class="common-list-button">
                    <span class="icon">
                        <img class="user-image" src="{{ asset('img/moon.jpg') }}" height="36" width="36" alt="">
                    </span>
                    <span class="text">{{ $logedUser->name }}</span>

                </a>
            </li>
            <li class="common-list-item">
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
            </li>
        </ul>
        <button class="common-more">
            <span class="text">See More</span>
            <span class="icon">🔻</span>
        </button>
    </section>
</aside>
