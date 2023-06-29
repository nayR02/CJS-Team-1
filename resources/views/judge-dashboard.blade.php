<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('/assets/css/judge.css')}}">
    <title>Judge Dashboard</title>
</head>

<body>
    @php
    $judges = App\Models\judgemodel::all();
    $categories = App\Models\Categories::all();
    $rounds = App\Models\Rounds::all();
    $infoList = App\Models\configuration_model::all();
    $criterias = App\Models\Criteria::all();
    @endphp
    <main class="main-sec">
        <section class="box1">
            <figure class="imgcrd">
                <img class="logo" src="/assets/images/logomain.png" alt="">
            </figure>
            <button class="logout"><a href="{{route('judge-logout')}}">Logout</a></button>
            <div class="footer">
                <hr>
                <p>Computerized Judging System</p>
            </div>
        </section>
        <section class="box2">
            <button class="circle" id="customModal" onclick="openModal()">?</button>
            <!--  -->
            <figure id="myModal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal()">&times;</span>
                    <div class="modal-in">

                    </div>

                </div>
            </figure>
            <script>
                function openModal() {
                    var modal = document.getElementById("myModal");
                    var modalContent = document.querySelector(".modal-content");
                    modal.style.display = "block";
                    void modalContent.offsetWidth;
                    modalContent.style.opacity = 1;
                }

                function closeModal() {
                    var modal = document.getElementById("myModal");
                    var modalContent = document.querySelector(".modal-content");
                    modalContent.style.opacity = 0;
                    setTimeout(function() {
                        modal.style.display = "none";
                    }, 300);
                }
            </script>
            @foreach ($rounds as $round)
            <figure class="table-fig">
                <h3 class="round-name">{{$round->rounds}}</h3>
                @php
                $count = 1;
                @endphp
                @foreach ($round->categories as $category)
                <form id="save-scores-form" method="POST">
                    @csrf
                    <div class="cat-name">
                        <span><i>Category {{$count}}</i></span>
                        <legend><strong>{{$category->category_name}} {{$category->category_value}}%</strong></legend>
                    </div>
                    <table class="tevol">
                        <thead>
                            <tr>
                                <th>Candidate #</th>
                                <th>Candidate Name</th>
                                @foreach($category->criteria as $criteria)
                                <th>{{$criteria->criteria_name}} {{$criteria->criteria_value}}%</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($infoList as $getInfo)
                            <tr>
                                <td>{{$getInfo->candidate_number}}</td>
                                <td>{{$getInfo->candidate_name}}</td>
                                @foreach ($category->criteria as $criteria)
                                <td><input type="number" min="75" max="100" name="score[{{$getInfo->id}}][{{$criteria->id}}][{{$category->id}}]"></td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @php
                    $count++;
                    @endphp
                    @endforeach
                    <div class="tbl-btn">
                        <button type="submit" onclick="swalTest()">Submit</button>
                    </div>
                </form>
            </figure>
            @endforeach
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function swalTest() {
            Swal.fire({
                position: 'center',
                icon: 'success',
                text: 'You can view your submitted scores on results panel',
                title: 'Ratings Submitted',
                showConfirmButton: false,
                timer: 1600,
                heightAuto: false
            })
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#save-scores-form').submit(function(event) {
            event.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: "{{ route('save.scores') }}",
                type: "POST",
                data: formData,
                success: function(response) {
                    $('#save-scores-form')[0].reset();
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    alert("Error");
                }
            });
        });
    </script>
</body>

</html>