<!DOCTYPE html>
<html lang="en">

<head>
    @extends('layout')
    @section('title', 'Configurations')
    <link rel="stylesheet" href="/storage/css/configurations.css">
</head>

<body class="__add-con">
    @section('header')
    @section('.canvas__')
    <main class="d-flex align-items-center justify-content-center flex-column">
        <div class="section_wrap">
            <section class="event_sec mt-3" id="step1">
                <span>Event</span>
                <form action="{{('add_info') }}" method="POST">
                    @csrf
                    <div class="my-2 boxparent">
                        <div class="boxinput">
                            <input type="date" id="startDate" name="start_date" required>
                            <label for="">Start Date</label>
                        </div>
                        <div class="boxinput">
                            <input type="date" id="endDate" name="end_date" required>
                            <label for="">End Date</label>
                        </div>
                    </div>
                    <div class="boxparent">
                        <div class="boxinput">
                            <input type="text" id="eventName" name="event_name" required>
                            <label for="eventName">Event Name</label>
                        </div>
                        <div class="boxinput">
                            <input type="text" id="venue" name="venue" required>
                            <label for="">Venue</label>
                        </div>
                    </div>
                    <div class="rounds mt-3">
                        <div class="add_round">
                            <label for="myNumberInput">Enter number of Rounds:</label>
                            <input type="number" id="myNumberInput" min="1" max="10" step="1" />
                            <button id="generateButton" class="standard-btn" type="button" onclick="generateFields()">Add Rounds</button>
                        </div>
                        <div id="inputFieldParent">
                            <div id="inputFields">
                            </div>
                        </div>
                    </div>
                    <div class="buttonparent">
                        <button class="standard-btn" type="submit">Add</button>
                    </div>
                </form>

            </section>
        </div>`
    </main>

    @endsection
    @endsection
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script>
        function generateFields() {
            const numberInput = document.querySelector("#myNumberInput");
            const inputValue = Number(numberInput.value);
            const inputFieldsContainer = document.querySelector("#inputFields");

            event.preventDefault();

            const inputs = [];

            for (let i = 0; i < inputValue; i++) {
                const inputField = document.createElement("input");
                inputField.type = "text";
                inputField.setAttribute("required", "true");
                inputField.name = `rounds_${i + 1}`;
                inputField.id = `rounds_${i + 1}`;
                inputField.placeholder = "(e.g. Preliminary) Round";

                // Append the input field to the container
                inputFieldsContainer.appendChild(inputField);

                // Push the input field to the inputs array
                inputs.push(inputField.value);
            }

            numberInput.value = "";

            // Send the data to the server via AJAX
            fetch('/store-fields', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        inputs: inputs
                    })
                })
                .then(response => response.json())
                .then(data => {
                    // Handle the response from the server if needed
                    console.log(data);
                })
                .catch(error => {
                    // Handle any errors that occurred during the request
                    console.error(error);
                });
        }
    </script>


</body>

</html>