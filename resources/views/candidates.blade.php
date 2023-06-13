<!DOCTYPE html>
<html lang="en">

<head>
    @extends('layout')
    @section('title', 'Candidates')
    <link rel="stylesheet" href="{{asset('/assets/css/candidates.css')}}">
    </style>
</head>

<body>
    @section('header')
    @endsection
    @section('.canvas__')

    <main>
        <section>
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
                        <td><img src="{{ asset('storage/' . $getInfo->image_path) }}" alt="Image"> </td>
                        <td>{{$getInfo->candidate_number}}</td>
                        <td>{{$getInfo->candidate_name}}</td>
                        <td>{{$getInfo->municipality}}</td>
                        <td>{{$getInfo->age}}</td>
                        <td>
                            <a href="{{route('delete_info',['id' => $getInfo->id])}}"><button class="btn btn-danger">Delete</button></a>
                        </td>
                    </tr>
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
                        <form class="modal-body" action="{{('candidates')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="boxparent one">
                                <div>
                                    <input type="text" id="candidateNumber" name="candidate_number">
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
                                    <input type="text" id="age" name="age">
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
        // JavaScript code here
        // ...

        // Get references to the input element and the preview container
        const imageInput = document.getElementById('imageInput');
        const previewContainer = document.getElementById('previewContainer');

        // Add event listener to the file input
        imageInput.addEventListener('change', function(event) {
            const file = event.target.files[0]; // Get the selected file

            // Check if a file is selected
            if (file) {
                const reader = new FileReader(); // Create a FileReader object

                // Set up the FileReader onload event
                reader.onload = function() {
                    const image = document.createElement('img'); // Create an image element
                    image.src = reader.result; // Set the source of the image to the data URL
                    previewContainer.innerHTML = ''; // Clear the preview container
                    previewContainer.appendChild(image); // Append the image to the preview container
                };

                // Read the selected file as a data URL
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>