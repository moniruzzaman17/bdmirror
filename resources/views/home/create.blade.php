<section class="create-post-wrapper">
    <div class="create-post-card">
        <div class="d-flex align-items-center mt2 mr4 ml4">
            <a href="" class="create-post-profile-avatar-anchor">
                <div class="create-post-profile-avatar">
                    <img src="{{ asset('img/moon.jpg') }}" alt="" id="ember1652" class="w-100">
                </div>
            </a>
            <button class="typing-button" type="button" data-bs-toggle="modal" data-bs-target="#createPostModal">
                <!---->
                <span class="typing-button__text">
                    Create New Complaint
                </span></button>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade create-post-modal" id="createPostModal" tabindex="-1" aria-labelledby="createPostModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createPostModalLabel">Create New Complaint</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="main-body">
                        <textarea name="complaint_textarea" class="w-100 complaint_textarea" id=""></textarea>
                    </div>
                    <div class="toolbar__wrapper">
                        <button aria-label="Add a photo" class="bdmirror-button">
                            <li-icon aria-hidden="true" type="image" class="button__icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" data-supported-dps="24x24" fill="currentColor" class="mercado-match" width="24" height="24" focusable="false">
                                    <path d="M19 4H5a3 3 0 00-3 3v10a3 3 0 003 3h14a3 3 0 003-3V7a3 3 0 00-3-3zm1 13a1 1 0 01-.29.71L16 14l-2 2-6-6-4 4V7a1 1 0 011-1h14a1 1 0 011 1zm-2-7a2 2 0 11-2-2 2 2 0 012 2z"></path>
                                </svg></li-icon>

                            <span class="button__text">
                                Photo
                            </span>
                        </button>
                        <button aria-label="Add a video" class="bdmirror-button">
                            <li-icon aria-hidden="true" type="video" class="button__icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" data-supported-dps="24x24" fill="currentColor" class="mercado-match" width="24" height="24" focusable="false">
                                    <path d="M19 4H5a3 3 0 00-3 3v10a3 3 0 003 3h14a3 3 0 003-3V7a3 3 0 00-3-3zm-9 12V8l6 4z"></path>
                                </svg></li-icon>

                            <span class="button__text">
                                Video
                            </span>
                        </button>
                        <button aria-label="Add a video" class="bdmirror-button">
                            <li-icon aria-hidden="true" type="video" class="button__icon">
                                <style>
                                    .svg-icon {
                                        width: 24px;
                                        height: 24px;
                                    }

                                    .svg-icon path,
                                    .svg-icon polygon,
                                    .svg-icon rect {
                                        fill: #4691f6;
                                    }

                                    .svg-icon circle {
                                        stroke: #4691f6;
                                        stroke-width: 1;
                                    }

                                </style>
                                <svg class="svg-icon" viewBox="0 0 20 20">
                                    <path d="M4.317,16.411c-1.423-1.423-1.423-3.737,0-5.16l8.075-7.984c0.994-0.996,2.613-0.996,3.611,0.001C17,4.264,17,5.884,16.004,6.88l-8.075,7.984c-0.568,0.568-1.493,0.569-2.063-0.001c-0.569-0.569-0.569-1.495,0-2.064L9.93,8.828c0.145-0.141,0.376-0.139,0.517,0.005c0.141,0.144,0.139,0.375-0.006,0.516l-4.062,3.968c-0.282,0.282-0.282,0.745,0.003,1.03c0.285,0.284,0.747,0.284,1.032,0l8.074-7.985c0.711-0.71,0.711-1.868-0.002-2.579c-0.711-0.712-1.867-0.712-2.58,0l-8.074,7.984c-1.137,1.137-1.137,2.988,0.001,4.127c1.14,1.14,2.989,1.14,4.129,0l6.989-6.896c0.143-0.142,0.375-0.14,0.516,0.003c0.143,0.143,0.141,0.374-0.002,0.516l-6.988,6.895C8.054,17.836,5.743,17.836,4.317,16.411"></path>
                                </svg>
                            </li-icon>

                            <span class="button__text">
                                File
                            </span>
                        </button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

</section>
