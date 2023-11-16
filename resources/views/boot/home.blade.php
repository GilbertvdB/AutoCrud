@extends('layouts.app')
@section('content')
<div class="container border">    
    <header>
        This is the header
    </header>
    <nav>
        This is the navbar
    </nav>
    <section>
        Helo there!
    </section>
    <section>
        <div class="container border">
            <div class="frame row">
                <div class="border info col-lg-5 d-flex flex-column justify-content-between align-items-stretch">
                    <div class="border one">
                        Item 1
                    </div>
                    <div class="border two d-flex flex-column justify-content-between">
                        <h4>Item 2</h4>
                        <span>Item 2.1</span>
                    </div>
                </div>
                <div class="border img col-lg-7">
                    <img src="{{asset('images/demo.png')}}" alt="" height="300">
                </div>
            </div>
        </div>
    </section>
    {{-- <section>
        <div class="container">
            <div class="frm">
                <form action="{{route('form.store')}}" class="dropzone" id="my-dropzone">
                @csrf

                </form>
                <button id="processQueueBtn">Process Queue</button>
            </div>
            <script>
                // Dropzone configuration
                Dropzone.options.myDropzone = {
                    paramName: "file", // The name that will be used to transfer the file
                    maxFilesize: 2, // MB
                    acceptedFiles: "image/*,application/pdf", // Accept only images & pdfs
                    uploadMultiple: true,
                    addRemoveLinks: true,
                    autoProcessQueue: false,
                    // createImageThumbnails: true,
                    // You can add more configurations as needed

                    init: function () {
                    var myDropzone = this;

                    // Manually process the queue when the button is clicked
                    document.getElementById("processQueueBtn").addEventListener("click", function () {
                        myDropzone.processQueue();
                    });
        }
                };
            </script>
        </div>
    </section> --}}
<section>
    {{-- <img src="{{asset('storage/uploads/gift.jpg')}}" alt="..."> --}}
    <!-- Your HTML -->
<form action="{{ route('form.store') }}" class="dropzone" id="my-dropzone">
    @csrf
    <!-- Your other form fields here -->
</form>

<!-- Display existing files in Dropzone -->
<div id="existingFiles">
    @foreach ($existingFiles as $file)
        <div class="dz-preview dz-processing dz-success dz-complete" data-file-id="{{ $file->id }}">
            <div class="dz-image">
                <img data-dz-thumbnail src="{{ asset('storage/'.$file->path) }}" alt="{{ $file->name }}" width="30px">
            </div>
            <div class="dz-details">
                <div class="dz-filename">
                    <span data-dz-name>{{ $file->name }}</span>
                </div>
            </div>
            <div class="dz-progress">
                <span class="dz-upload" data-dz-uploadprogress></span>
            </div>
            <div class="dz-error-message">
                <span data-dz-errormessage></span>
            </div>
            <div class="dz-success-mark">
                <span>✔</span>
            </div>
            <div class="dz-error-mark">
                <span>✘</span>
            </div>
            <a class="dz-remove" href="javascript:undefined;" data-dz-remove data-file-id="{{ $file->id }}">
                Remove
            </a>
        </div>
    @endforeach
</div>

<script>
    // Dropzone configuration
    Dropzone.options.myDropzone = {
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 2, // MB
        acceptedFiles: "image/*", // Accept only images

        // Initialize Dropzone with existing files
        init: function () {
            var myDropzone = this;

            // Add existing files to Dropzone
            @foreach ($existingFiles as $file)
                var mockFile = { name: '{{ $file->name }}', type: 'image/*' };
                myDropzone.emit("addedfile", mockFile);
                myDropzone.emit("thumbnail", mockFile, '{{ asset('storage/'.$file->path) }}');
                myDropzone.emit("complete", mockFile);
            @endforeach

            // Event listener for removing an existing file
            myDropzone.on("removedfile", function (file) {
                var fileId = file.previewElement.dataset.fileId;

                // Send an AJAX request to your Laravel route for deleting files
                axios.delete('/file/' + fileId)
                    .then(function (response) {
                        console.log('File deleted successfully');
                    })
                    .catch(function (error) {
                        console.error('Error deleting file:', error);
                    });
            });
        }
    };
</script>
</section>



    <footer class="mt-3 custom-footer">
        <div class="row" id="upper">
            <div class="col-3">
                <h3> Prints </h3>
                <ul>
                    <li>All images</li>
                    <li>Categories</li>
                    <li></li>
                    <li></li>
                </ul>
            </div>
            <div class="col-3">
                <h3> Picfee </h3>
                <ul>
                    <li>About us</li>
                    <li>Materials</li>
                    <li>Printlab</li>
                    <li>Blogs</li>
                    <li>Term & Conditions</li>
                    <li>Privacy declaration</li>
                </ul>
            </div>
            <div class="col-3">
                <h3> Image makers </h3>
                <ul>
                    <li>All Image makers</li>
                    <li>Login</li>
                    <li>Frequetly Asked Questions</li>
                    <li>Start of Picfee Shop</li>
                </ul>
            </div>
            <div class="col-3">
                <h3> Customers </h3>
                <ul>
                    <li>Contact</li>
                    <li>Frequetly Asked Questions</li>
                    <li>Commercial</li>
                    <li>Success stories</li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="row" id="lower">
            <div class="col-4">
                <h3> Address </h3>
                <ul>
                    <li>Laan van Zuidhoorn 60</li>
                    <li>2289 DE Rijswijk</li>
                    <li>+085 - 060 8067</li>
                    <li>Chamber of Commerce: 80338348</li>
                    <li>VAT: NL861636405B01</li>
                </ul>
            </div>
            <div class="col-4">
                <h3> Follow Us </h3>
                <ul>
                    <li>Facebook</li>
                    <li>Instagram</li>
                    <li>Tiktok</li>
                    <li>X</li>
                    <li>Pinterest</li>
                    <li>LinkedIn</li>
                    <li>Youtube</li>
                </ul>
            </div>
            <div class="col-4">
                <h3> Sign up for our newsletter </h3>
                <p> Sign up and be the first to receive information about our latest image makers, prints and offers.</p>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Enter your email" aria-label="email" aria-describedby="basic-addon2">
                    <span class="input-group-text" id="basic-addon2">Sign Up</span>
                  </div>
                  
                
            </div>
        </div>
    </footer>
</div>
@endsection
