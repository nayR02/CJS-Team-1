<!DOCTYPE html>
<html lang="en">

<head>
    @extends('layout')
    @section('title', 'Configurations')
    <link rel="stylesheet" href="{{asset('/assets/css/configurations.css')}}">
</head>

<body class="__add-con">
    @section('header')
    @section('.canvas__')
    <main class="d-flex align-items-center justify-content-center flex-column">
        <!-- Button ka modal || Main Page -->
        <section class="mainchild">
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
                        <form id="eventForm" action="{{('/add_info')}}" method="POST">
                            @csrf
                            <div class="my-2 boxparent">
                                <div class="boxinput">
                                    <input type="date" id="startDate" name="start_date" required>
                                    <label for="startDate">Start Date</label>
                                </div>
                                <div class="boxinput">
                                    <input type="date" id="endDate" name="end_date" required>
                                    <label for="endDate">End Date</label>
                                </div>
                            </div>
                            <div class="boxparent">
                                <div class="boxinput">
                                    <input type="text" id="eventName" name="event_name" required>
                                    <label for="eventName">Event Name</label>
                                </div>
                                <div class="boxinput">
                                    <input type="text" id="venue" name="venue" required>
                                    <label for="venue">Venue</label>
                                </div>
                            </div>
                            <div class="genwrap">
                                <figure class="genparent">
                                    <label>Enter number of Rounds: </label>
                                    <input type="number" id="numInputs"/>
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
                    <a class="event-x" href="{{ route('delete_event',['id' => $eventConfiguration->id]) }}"><span>&times;</span></a>
                    <div class="quote">Delete this event</div>
                </div>
                <span class="event-name mb-2"><i class="fa-regular fa-calendar-check me-1"></i>{{ $eventConfiguration->event_name }}</span>
                <span class="venue"><i class="fa-solid fa-location-dot"></i> {{ $eventConfiguration->venue }}</span>
                <div class="event-box my-2"><i class="fa-solid fa-clock mx-1"></i>
                    <span class="start-date">{{ $eventConfiguration->start_date }}</span>
                    <span><i class="fa-solid fa-arrow-right mx-3"></i></span>
                    <span class="end-date">{{ $eventConfiguration->end_date }}</span>
                </div>
                <section class="rounds__">
                    <span>Categories & Criteria</span>
                    <table class="all_tables">
                        <thead>
                            <tr>
                                @foreach ($rounds as $roundKey => $round)
                                @isset($round)
                                <td>{{ $round->rounds }}</td>
                                @endisset
                                @endforeach
                            </tr>
                        </thead>
                    </table>
                </section>
            </div>
            @endforeach
            @endif


        </section>


    </main>

    @endsection
    @endsection
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
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