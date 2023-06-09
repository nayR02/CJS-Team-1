<!DOCTYPE html>
<html lang="en">

<head>
    @extends('layout')
    @section('title', 'Test')
    <link rel="stylesheet" href="/storage/css/test.css">
</head>

<body>
    @section('header')
    @section('.canvas__')
    <main id="formPage">
        <form action="" id="myForm">
            <!-- una -->
            <section class="event_sec form-page mt-3" id="step1">
                <span>Event</span>
                <div class="my-2">
                    <div class="boxinput">
                        <input type="date" id="startDate">
                        <label for="">Start Date</label>
                    </div>
                    <div class="boxinput">
                        <input type="date" id="endDate">
                        <label for="">End Date</label>
                    </div>
                </div>
                <div>
                    <div class="boxinput">
                        <input type="text" id="eventName">
                        <label for="">Event Name</label>
                    </div>
                    <div class="boxinput">
                        <input type="text" id="venue">
                        <label for="">Venue</label>
                    </div>
                </div>
                <div class="form-navigation mt-3 pe-1">
                    <button type="button" id="nextBtn" class="btn btn-primary btn-md" onclick="navigate(1)">Next</button>
                </div>
            </section>
            <!-- duwa -->
            <section class="round_sec form-page">
                <span>Rounds</span>
                <div class="rounds">
                    <div class="add_round">
                        <label for="myNumberInput">Enter number of Rounds:</label>
                        <input type="number" id="myNumberInput" min="1" max="10" step="1" />
                        <button id="generateButton" class="standard-btn" type="submit" onclick="generateFields()">Add Rounds</button>
                    </div>
                    <div id="inputFieldParent">
                        <div id="inputFields">
                        </div>
                    </div>
                </div>
                <div class="form-navigation mt-3 pe-1">
                    <button type="button" id="prevBtn" class="btn btn-secondary btn-md" onclick="navigate(-1)">Previous</button>
                    <button type="button" id="nextBtn" class="btn btn-primary btn-md" onclick="navigate(1)">Next</button>
                </div>
            </section>
            <!-- --- -->
        </form>
    </main>
    @endsection
    @endsection

    <script>
        var currentPage = 0;
        var formPages = document.getElementsByClassName("form-page");
        var prevBtn = document.getElementById("prevBtn");
        var nextBtn = document.getElementById("nextBtn");
        var submitBtn = document.getElementById("submitBtn");

        function showPage(pageIndex) {
            formPages[currentPage].style.display = "none";
            formPages[pageIndex].style.display = "block";
            currentPage = pageIndex;
            prevBtn.disabled = (currentPage === 0);
            nextBtn.disabled = (currentPage === formPages.length - 1);
            submitBtn.style.display = (currentPage === formPages.length - 1) ? "block" : "none";
        }

        function navigate(step) {
            var nextPage = currentPage + step;
            if (nextPage >= 0 && nextPage < formPages.length) {
                showPage(nextPage);
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            showPage(currentPage);
        });
        // ----------------------------------------------------------------
        function generateFields() {
            const numberInput = document.querySelector("#myNumberInput");
            const inputValue = Number(numberInput.value);
            const inputFieldsContainer = document.querySelector("#inputFields");

            event.preventDefault();

            for (let i = 0; i < inputValue; i++) {
                const inputField = document.createElement("input");
                inputField.type = "text";
                inputField.name = `rounds_${i + 1}`;
                inputField.id = `rounds_${i + 1}`;
                inputField.placeholder = "(e.g.Preliminary) Round";
                // ${i + 1}
                inputFieldsContainer.appendChild(inputField);
            }
            numberInput.value = "";

            const button = document.getElementById("generateButton");
            const buttonContainer = document.querySelector("#inputFieldParent");
            button.addEventListener("click", () => {
                const newButton = document.createElement("button");
                newButton.classList.add("stand`ard_btn");
                buttonContainer.appendChild(newButton);
            });
        }
    </script>
</body>

</html>