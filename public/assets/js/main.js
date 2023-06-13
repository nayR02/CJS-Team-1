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
        inputFieldsContainer.appendChild(inputField);
    }
    numberInput.value = "";

}
