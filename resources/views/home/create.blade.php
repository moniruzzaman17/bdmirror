<section class="create-post-wrapper">
    <div class="create-post-card">
        <div class="d-flex align-items-center mt2 mr4 ml4">
            <a href="" class="create-post-profile-avatar-anchor">
                <div class="create-post-profile-avatar">
                    @if(empty(Auth::guard('citizen')->user()->image))
                    <img src="{{ asset('img/avatar.png') }}" id="ember1652" class="w-100" />
                    @else
                    <img src="{{ Auth::guard('citizen')->user()->image }}" id="ember1652" class="w-100" />
                    @endif
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
                <form action="{{ route('create.complaint') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="createPostModalLabel" style="justify-content:left; width:100%">Create New Complaint</h1>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="main-body">
                            <textarea name="complaint" class="w-100 complaint_textarea" id="" required></textarea>
                        </div>
                        <div class="d-flex align-items-center mt-3 mb-3">
                            <select name="category" id="category" class="form-controll common-list-button common-list-select w-100" required>
                                <option value="" selected disabled> Select Complaint Category..</option>
                                @foreach($categories as $key => $category)
                                <option value="{{ $category->id }}">{{ $category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex align-items-center">
                            <input type="checkbox" id="complaint_type" name="is_anonymous" value="1">&nbsp;&nbsp;
                            <label for="complaint_type" class="font-italic text-primary">Check this box if you want to post anonymously. <i>(Optional)</i></label>
                        </div>
                        <div class="d-flex align-items-center mt-3 mb-3">
                            <label for="complaint_schedule" class="">Set Publish Schedule <i class="text-danger">(If no needed leave the field blank)</i></label>&nbsp;&nbsp;
                            <input type="datetime-local" name="complaint_schedule" id="complaint_schedule" name="publish_timetable">
                        </div>
                        <div class="toolbar__wrapper" style="text-align:left;">
                            <label aria-label="Add a photo" class="bdmirror-button" for="image">
                                <li-icon aria-hidden="true" type="image" class="button__icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" data-supported-dps="24x24" fill="currentColor" class="mercado-match" width="24" height="24" focusable="false">
                                        <path d="M19 4H5a3 3 0 00-3 3v10a3 3 0 003 3h14a3 3 0 003-3V7a3 3 0 00-3-3zm1 13a1 1 0 01-.29.71L16 14l-2 2-6-6-4 4V7a1 1 0 011-1h14a1 1 0 011 1zm-2-7a2 2 0 11-2-2 2 2 0 012 2z"></path>
                                    </svg></li-icon>

                                <span class="button__text">
                                    Photo
                                </span>
                            </label>
                            <input type="file" name="image[]" data-max_length="20" class="upload__inputfile inputFile" accept="image/*" id="image" multiple>
                            <label for="video" aria-label="Add a video" class="bdmirror-button">
                                <li-icon aria-hidden="true" type="video" class="button__icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" data-supported-dps="24x24" fill="currentColor" class="mercado-match" width="24" height="24" focusable="false">
                                        <path d="M19 4H5a3 3 0 00-3 3v10a3 3 0 003 3h14a3 3 0 003-3V7a3 3 0 00-3-3zm-9 12V8l6 4z"></path>
                                    </svg></li-icon>

                                <span class="button__text">
                                    Video
                                </span>
                            </label>
                            <input type="file" name="video[]" accept="video/mp4,video/x-m4v,video/*" data-max_length="20" class="upload__inputfile" id="video" multiple>

                            <label for="document" aria-label="Add a video" class="bdmirror-button">
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

                                        .svg-icon path,
                                        .svg-icon polygon,
                                        .svg-icon rect {
                                            fill: #4691f6;
                                        }

                                        .svg-icon circle {
                                            stroke: #4691f6;
                                            stroke-width: 1;
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
                            </label>
                            <input type="file" name="document[]" data-max_length="20" class="upload__inputfile" id="document" accept="application/*" multiple>


                            <div class="toolbar-button">
                                <style>
                                    .bdmirror-button {
                                        width: 50px;
                                        height: 50px;
                                        border-radius: 10px;
                                    }

                                </style>
                                <div class="preview-upload">
                                    <div class="upload__img-wrap"></div>
                                    <div class="video-preview" style="display: none">
                                        <b>Selected Video/s:</b> <br>
                                    </div>
                                    <div class="document-preview" style="display: none">
                                        <b>Selected Document/s:</b> <br>
                                    </div>
                                </div>
                                {{-- <label for="attachment" class="bdmirror-button" data-toggle="tooltip" data-placement="top" title="Add video, photo & audio">
                                    <i class="fas fa-photo-video text-success"></i>
                                </label>
                                <input type="file" class="d-none upload__inputfile" accept="audio/*|video/*|video/x-m4v|video/webm|video/x-ms-wmv|video/x-msvideo|video/3gpp|video/flv|video/x-flv|video/mp4|video/quicktime|video/mpeg|video/ogv|.ts|.mkv|image/*|image/heic|image/heif" id="attachment" data-max_length="20" multiple> --}}


                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary w-25" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary w-25">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
        jQuery(document).ready(function() {
            ImgUpload();
        });

        function ImgUpload() {
            var imgWrap = "";
            var imgArray = [];

            $('.upload__inputfile').each(function() {
                $(this).on('change', function(e) {

                    imgWrap = $('.upload__img-wrap');
                    var maxLength = $(this).attr('data-max_length');

                    var files = e.target.files;
                    var filesArr = Array.prototype.slice.call(files);
                    var iterator = 0;
                    filesArr.forEach(function(f, index) {
                        console.log(f.name);
                        if (f.type.match('video.*')) {
                            let file = e.target.files[0];
                            let blobURL = URL.createObjectURL(file);
                            $('.video-preview').show();
                            var videohtml = '<video width="320" src="' + blobURL + '" height="200" style="margin-right: 18px;" controls autoplay>Your browser does not support the video tag.</video>';
                            $('.video-preview').append(videohtml);
                        }
                        if (f.type.match('application.*')) {
                            $('.document-preview').show();
                            var documenthtml = f.name + "<br>";
                            $('.document-preview').append(documenthtml);

                        }

                        if (f.type.match('image.*')) {
                            // $('.upload__inputfile').push(f);
                            imgArray.push(f);
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                var html = "<div class='upload__img-box'> <div style ='background-image: url(" + e.target.result + ")' data - number = '" + $(".upload__img-close").length + "'data-file = '" + f.name + "'class = 'img-bg'><div class='upload__img-close'></div> </div> </div>";
                                imgWrap.append(html);
                                iterator++;
                            }
                            reader.readAsDataURL(f);
                        }
                    });
                });
            });

            $('body').on('click', ".upload__img-close", function(e) {
                var file = $(this).parent().data("file");
                for (var i = 0; i < imgArray.length; i++) {
                    if (imgArray[i].name === file) {
                        imgArray.splice(i, 1);
                        break;
                    }
                }
                $(this).parent().parent().remove();
            });
        }

    </script>
</section>
