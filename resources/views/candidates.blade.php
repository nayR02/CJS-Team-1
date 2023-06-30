<!DOCTYPE html>
<html lang="en">

<head>
    @extends('layout')
    @section('title', 'Candidates')
    <link rel="stylesheet" href="{{asset('/assets/css/candidates.css')}}">
    </style>
</head>

<body class="__candidates-">
    @section('header')
    @endsection
    @section('.canvas__')

    <main>
        <section>
            <div class="d-flex justify-content-start mb-3"><button class="canvas-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i class="fa-solid fa-bars"></i></button></div>
            <!-- Button trigger modal -->
            <button type="button" class="standard-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Add Candidates
            </button>
            @if (session('message'))
            <div id="flashMessage" class="alert alert-danger">
                {{ session('message') }}<i class="fa-solid fa-trash"></i>
            </div>
            <script>
                const flashMessage = document.getElementById('flashMessage');

                setTimeout(() => {
                    flashMessage.style.display = 'none';
                }, 1500);
            </script>
            @endif
            @if (session('candidate'))
            <div id="candidateAdded" class="event-alert alert alert-success">
                <p>
                    {{session ('candidate')}}
                    <i class="fa-solid fa-circle-check"></i>
                </p>
            </div>
            <script>
                setTimeout(function() {
                    document.getElementById('candidateAdded').style.display = 'none';
                }, 1500);
            </script>
            @endif
            <table class="all_tables">
                <thead>
                    <tr>
                        <td>Avatar</td>
                        <td>Candidate Number</td>
                        <td>Candidate Name</td>
                        <td>Municipality</td>
                        <td>Age</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($infoList as $getInfo)
                    <tr>
                        <td><img class="candidate-img" src="{{ asset('../../assets/images/' . $getInfo->profile) }}" alt="Image" onclick="displayImage(this)"></td>
                        <td>{{$getInfo->candidate_number}}</td>
                        <td>{{$getInfo->candidate_name}}</td>
                        <td>{{$getInfo->municipality}}</td>
                        <td>{{$getInfo->age}}</td>
                        <td>
                            <a href="{{route('delete_info',['id' => $getInfo->id])}}"><button class="btn btn-danger">Delete</button></a>
                        </td>
                    </tr>
                    <script>
                        function displayImage(imgElement) {
                            var container = $('<div class="enlarged-image-container"></div>');
                            var enlargedImg = $('<img class="enlarged-image" src="' + imgElement.src + '" alt="Enlarged Image">');
                            enlargedImg.css({
                                width: '20rem',
                                opacity: 0,
                                transform: 'scale(0.9)',
                                transition: 'opacity 0.4s, transform 0.4s',
                                boxShadow: '0px 0px 20px rgb(0 0 0 / 0.3)'
                            });
                            var closeButton = $('<button class="close-button">&times;</button>');
                            closeButton.on('click', function() {
                                container.addclassList('x-btn');
                                container.css({
                                    opacity: 0,
                                    transform: 'scale(0.9)',
                                });
                                setTimeout(function() {
                                    container.remove();
                                }, 400);
                            });
                            container.append(enlargedImg);
                            container.append(closeButton);
                            $('body').append(container);
                            container.css({
                                position: 'fixed',
                                top: '50%',
                                left: '50%',
                                transform: 'translate(-50%, -50%)'
                            });
                            setTimeout(function() {
                                enlargedImg.css({
                                    opacity: 1,
                                    transform: 'scale(1)'
                                });
                            }, 10);
                            container.on('click', function(event) {
                                container.css({
                                    opacity: 0,
                                    transform: 'scale(0.9)'
                                });
                                setTimeout(function() {
                                    container.remove();
                                }, 400);
                            });
                        }
                    </script>
                    @endforeach
                </tbody>
            </table>
            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Candidate</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="imageUploadForm" class="modal-body" action="{{('candidates')}}" method="POST" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <div class="boxparent one">
                                <div>
                                    <input type="number" id="candidateNumber" name="candidate_number">
                                    <label for="candidateNumber">Candidate Number</label>
                                </div>
                                <div>
                                    <input type="text" id="candidateName" name="candidate_name">
                                    <label for="candidateNumber">Candidate Name</label>
                                </div>
                            </div>
                            <div class="boxparent two">
                                <div>
                                    <input type="text" id="municipality" name="municipality">
                                    <label for="municipality">Municipality</label>
                                </div>
                                <div>
                                    <input type="number" id="age" name="age">
                                    <label for="age">Age</label>
                                </div>
                            </div>
                            <div class="boxparent three">
                                <div>
                                    <input type="file" id="imageInput" name="avatar">
                                </div>
                                <div id="previewContainer">

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="standard-btn">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
        </section>
    </main>
    @endsection
    <script>
        $(document).ready(function() {
            $('#imageUploadForm').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        console.log(data);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            });
        });
    </script>
</body>

</html>