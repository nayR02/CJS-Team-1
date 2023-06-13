<!-- <!DOCTYPE html>
<html lang="en">

<head>
    @extends('layout')
    @section('title', 'Categories')
    <link rel="stylesheet" href="/storage/css/categories.scss">
</head>

<body>
    @section('header')
    @section('.canvas__')
    <main>
        <section class="__cat">
            <form action="{{route('dynamic_inputs')}}" method="POST" id="categoryForm">
                @csrf
                <div>
                    <input type="number" id="numInputs" placeholder="Generate Rounds" />
                    <button onclick="rounds()" class="standard-btn"><i class="fa-solid fa-circle-plus"></i></button>
                    <div id="inputContainer">
                    </div>
                    <button type="submit" onclick="xRefresh()" class="standard-btn">Save</button>
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
                            input.name = "rounds[]";
                            input.placeholder = "Rounds (e.g. Preliminary)";
                            inputContainer.appendChild(input);
                            dInputs.push(input.value);
                        }
                    }
                </script>
            </form>
            
    </main>
    </section>
    @endsection
    @endsection
    @vite(['resources/scss/categories.scss']);
</body>

</html> -->