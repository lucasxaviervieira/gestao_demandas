window.onload = function () {
  changeOkrValue();
  addSectors();
  resetForm();
};

function changeOkrValue() {
  const select = document.getElementById("activity");
  select.addEventListener("change", () => {
    const selectedValue = select.value;
    const selectedText = select.options[selectedValue - 1].text;

    const div = document.getElementById("hidden-okr");

    if (selectedText == "OKR") {
      div.style.display = "block";
    } else {
      div.style.display = "none";
    }
  });
}

function addSectors() {
  var counter = 0;
  document
    .getElementById("addInfoButton")
    .addEventListener("click", function () {
      const nameAndIdSender = "sender-agent_" + counter;
      const nameAndIdRecipient = "recipient-agent_" + counter;

      const senderAgent = document.getElementById("sender_agent");
      const recipientAgent = document.getElementById("recipient_agent");

      const senderOption = senderAgent.options[senderAgent.selectedIndex];
      const recipientOption =
        recipientAgent.options[recipientAgent.selectedIndex];

      console.log(senderAgent.options[senderAgent.selectedIndex]);
      console.log(recipientAgent.options[recipientAgent.selectedIndex]);

      if (senderOption.value || recipientOption.value) {
        const addedInputsDiv = document.getElementById("addedInputs");

        senderSelect = createSelect(senderOption, nameAndIdSender);
        recipientSelect = createSelect(recipientOption, nameAndIdRecipient);

        addedInputsDiv.appendChild(senderSelect);
        addedInputsDiv.appendChild(recipientSelect);

        counter += 1;
      } else {
        alert("Por favor, selecione um dos setores.");
      }
    });
}

function createSelect(optionSelected, nameAndId) {
  const select = document.createElement("select");
  const option = document.createElement("option");

  option.value = optionSelected.value;

  option.textContent = optionSelected.textContent;

  option.selected = true;

  select.id = nameAndId;

  select.name = nameAndId;

  select.classList.add("no-arrow");

  select.appendChild(option);

  return select;
}

function resetForm() {
  document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("create-demand");
    form.reset();
  });
}
