<!DOCTYPE html>
<html lang="en">

<head>
    @extends('layout')
    @section('title', 'Configurations')
    <link rel="stylesheet" href="{{asset('/assets/css/configurations.css')}}">
</head>

<body class="__add-con">
<div class="loader-container">
    <div class="loader">
      <div class="dot-spinner">
        <div class="dot-spinner__dot"></div>
        <div class="dot-spinner__dot"></div>
        <div class="dot-spinner__dot"></div>
        <div class="dot-spinner__dot"></div>
        <div class="dot-spinner__dot"></div>
        <div class="dot-spinner__dot"></div>
        <div class="dot-spinner__dot"></div>
        <div class="dot-spinner__dot"></div>
      </div>
    </div>
  </div>
    @section('header')
    @section('.canvas__')
    @php
    $judges = App\Models\judgemodel::all();
    $categories = App\Models\Categories::all();
    $rounds = App\Models\Rounds::all();
    $infoList = App\Models\configuration_model::all();
    $criterias = App\Models\Criteria::all();
    @endphp
    <main class="d-flex align-items-center justify-content-center flex-column">
        <!-- Button ka modal || Main Page -->
        <section class="mainchild" style="position: relative;">
            <div style="position: absolute; top: 5px; left: 5px;" class="mt-2 ms-2"><button class="canvas-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i class="fa-solid fa-bars"></i></button></div>
            <section class="buttonparent">
                <div class="abs-btn">
                    <button id="customModal" class="create-btn animated heartBeat" onclick="openModal()">Create Event</button>
                    <span class="popover">Click to add Event</span>
                </div>
            </section>
            <!-- Parent Element ka modal || Start -->
            <div id="myModal" class="modal">
                <!-- Content ka Modalllllll -->
                <div class="modal-content">
                    <span class="close" onclick="closeModal()">&times;</span>
                    <section class="modal-in">
                        <span>Add Event</span>
                        <form id="eventForm" action="{{('/add_info')}}" method="POST" autocomplete="off">
                            @csrf
                            <div class="my-2 boxparent">
                                <div class="boxinput">
                                    <input type="time" id="startDate" name="start_time" required>
                                    <label for="startDate">Start Time</label>
                                </div>
                                <div class="boxinput">
                                    <input type="time" id="endDate" name="end_time" required>
                                    <label for="endDate">End Time</label>
                                </div>
                            </div>
                            <div class="boxparent">
                                <div class="boxinput">
                                    <input type="text" id="eventName" name="event_name" placeholder="Event Name" required>
                                </div>
                                <div class="boxinput">
                                    <input type="text" id="venue" name="venue" placeholder="Venue" required>
                                </div>
                            </div>
                            <div class="boxparent">
                                <div class="boxinput">
                                    <label for="date">Date</label>
                                    <input type="date" id="date" name="date" required>
                                </div>
                            </div>
                            <div class="genwrap">
                                <figure class="genparent">
                                    <label>Enter number of Rounds: </label>
                                    <input type="number" id="numInputs" />
                                    <button onclick="rounds()" class="standard-btn"><i class="fa-solid fa-circle-plus me-1"></i>Add Round(s)</button>
                                </figure>
                                <div id="inputContainer">
                                </div>
                            </div>
                            <div class="">
                                <button class="standard-btn" id="submitButton" type="submit">Save</button>
                            </div>
                            <script>
                                function rounds() {
                                    event.preventDefault();
                                    const dInputs = [];
                                    const inputContainer = document.getElementById("inputContainer");
                                    const numInputs = parseInt(document.getElementById("numInputs").value);
                                    inputContainer.innerHTML = "";
                                    for (let i = 0; i < numInputs; i++) {
                                        const input = document.createElement("input");
                                        input.type = "text";
                                        input.id = `round_${i + 1}`;
                                        input.name = "rounds[]";
                                        input.placeholder = "(e.g. Preliminary)";
                                        inputContainer.appendChild(input);
                                        dInputs.push(input.value);
                                    }
                                }
                            </script>
                        </form>
                    </section>
                </div>
            </div>
            @if (session('event'))
            <div id="eventAddedMsg" class="event-alert alert alert-success">
                {{ session('event') }} <i class="fa-solid fa-circle-check"></i>
            </div>
            <script>
                setTimeout(function() {
                    document.getElementById('eventAddedMsg').style.display = 'none';
                }, 2000);
            </script>
            @endif

            @if($eventConfigurations->count() === 0)
            <p class="NED">No event data.</p>
            @else
            @foreach($eventConfigurations as $key => $eventConfiguration)
            <div class="event-content">
                <div class="delparent">
                    <a class="event-x" onclick="deleteEvent()"><span>&times;</span></a>
                    <div class="quote">Delete this event</div>
                </div>
                <script>
                    function deleteEvent() {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Delete this event',
                            text: 'Deleting this event will remove all related event data from the database',
                            showCancelButton: true,
                            confirmButtonText: 'Yes, delete it!',
                            confirmButtonColor: '#d33',
                            cancelButtonText: 'No, cancel!',
                            cancelButtonColor: '#3085d6',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "{{ route('delete_event',['id' => $eventConfiguration->id]) }}";
                            }
                        });
                    }
                </script>
                <div class="event-name">
                    <span class="mb-2">{{ $eventConfiguration->event_name }}</span>
                </div>
                <div class="venue">
                    <span>{{ $eventConfiguration->venue }}</span>
                    <i class="fa-solid fa-location-dot"></i>
                </div>
                <div class="event-date">
                    <span class="start-date">{{ $eventConfiguration->date }}</span>
                    <i class="fa-regular fa-calendar-check me-1"></i>

                </div>
                <div class="event-box">
                    <span class="start-date">{{ $eventConfiguration->start_time }}</span>
                    <span><i class="fa-solid fa-arrow-right mx-3"></i></span>
                    <span class="end-date">{{ $eventConfiguration->end_time }}</span>
                    <i class="fa-solid fa-clock mx-1"></i>
                </div>
                <section class="rounds__">
                    <figure class="d-flex justify-content-center align-items-center flex-column card-round">
                        <div class="cat__p">
                            <span><a href="{{('/categories')}}" class="cat-link me-2">Categories</a></span>
                            <i class="fa-solid fa-hand-point-left"></i>
                        </div>
                        <div class="table-flex d-flex align-items-start gap-3">
                            @foreach ($rounds as $round)
                            @php
                            $count = 1;
                            @endphp
                            <table class="all_tables">
                                <thead>
                                    <tr>
                                        <th colspan="3" class="th-round">{{ $round->rounds }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($round->categories as $category)
                                    <tr>
                                        <td><i>Category {{$count}}</i></td>
                                        <td class="category-hover">{{ $category->category_name }}</td>
                                        <td>{{ $category->category_value }}%</td>
                                    </tr>
                                    @php
                                    $count++;
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            @endforeach
                        </div>
                    </figure>
                    <figure class="d-flex justify-content-center align-items-center flex-column text-center card-criterias">
                        <span><a href="{{('/criterias')}}" class="cat-link">Criterias &rarr;</a></span>
                        <div class="table-flex d-flex align-items-start gap-3">
                            @foreach($categories as $category)
                            <table class="all_tables">
                                <thead>
                                    <tr>
                                        <th colspan="2">{{$category->category_name}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($category->criteria as $criteria)

                                    <tr>
                                        <td>{{$criteria->criteria_name}} {{$criteria->criteria_value}}%</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endforeach
                        </div>
                    </figure>
                </section>
                <section style="width: 100%;" class="jc-wrap d-flex flex-column justify-content-center text-center p-5 my-3">
                    <h3>Judges And Candidates Overview</h3>
                    <div class="jc-section">
                        <table class="all_tables">
                            <thead>
                                <tr style="font-weight: 550;">
                                    <td>#</td>
                                    <td>Judges</td>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $counter = 1;
                                @endphp
                                @foreach ($judges as $judge)
                                <tr>
                                    <td>{{$counter}}</td>
                                    <td>{{$judge->judge_name}}</td>
                                </tr>
                                @php
                                $counter++;
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
                        <table class="all_tables">
                            <thead>
                                <tr style="font-weight: 550;">
                                    <td>Candidate #</td>
                                    <td>Candidates</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($infoList as $getInfo)
                                <tr>
                                    <td>{{$getInfo->candidate_number}}</td>
                                    <td>{{$getInfo->candidate_name}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                </section>
            </div>
            @endforeach
            @endif
            </div>
        </section>


    </main>
    @endsection
    @endsection
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script>
    function showLoader() {
      var loaderContainer = document.querySelector('.loader-container');

      loaderContainer.style.display = 'flex';

      setTimeout(function() {
        loaderContainer.style.display = 'none';
      }, 1000);
    }

    showLoader();
  </script>
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


</body>

</html>