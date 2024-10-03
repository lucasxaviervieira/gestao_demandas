window.onload = function () {
  changeOkrValue();
  addSectors();
  addProcessSei();
  addDocument();
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
  var sector_counter = 0;
  document
    .getElementById("addInfoButton")
    .addEventListener("click", function () {
      const nameAndIdSender = "sender-agent_" + sector_counter;
      const nameAndIdRecipient = "recipient-agent_" + sector_counter;

      const senderAgent = document.getElementById("sender_agent");
      const recipientAgent = document.getElementById("recipient_agent");

      const senderOption = senderAgent.options[senderAgent.selectedIndex];
      const recipientOption =
        recipientAgent.options[recipientAgent.selectedIndex];

      if (senderOption.value || recipientOption.value) {
        const addedInputsDiv = document.getElementById("addedSectors");

        senderSelect = createSelect(senderOption, nameAndIdSender);
        recipientSelect = createSelect(recipientOption, nameAndIdRecipient);

        addedInputsDiv.appendChild(senderSelect);
        addedInputsDiv.appendChild(recipientSelect);

        sector_counter += 1;
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

function createInput(reference, referenceID) {
  const input = document.createElement("input");
  input.value = reference.value;
  input.id = referenceID;
  input.name = referenceID;
  input.readOnly = true;

  return input;
}

function addProcessSei() {
  var sei_counter = 0;
  document
    .getElementById("addProcessButton")
    .addEventListener("click", function () {
      const seiProcessID = "sei-process_" + sei_counter;
      const processDescriptionID = "process-description_" + sei_counter;

      const seiProcess = document.getElementById("sei-process");
      const processDescription = document.getElementById("process-description");

      if (seiProcess.value) {
        const addedInputsDiv = document.getElementById("addedProcesses");

        const newSeiProcess = createInput(seiProcess, seiProcessID);
        const newProcessDescription = createInput(
          processDescription,
          processDescriptionID
        );

        addedInputsDiv.appendChild(newSeiProcess);
        addedInputsDiv.appendChild(newProcessDescription);

        sei_counter += 1;
      } else {
        alert("Por favor, digite um número de processo SEI.");
      }
    });
}

function addDocument() {
  var doc_counter = 0;
  document
    .getElementById("addDocButton")
    .addEventListener("click", function () {
      const documentID = "document_" + doc_counter;
      const documentDescriptionID = "document-description_" + doc_counter;

      const documentInp = document.getElementById("document");
      const documentDescription = document.getElementById(
        "document-description"
      );

      if (documentInp.value) {
        const addedInputsDiv = document.getElementById("addedDocuments");

        const newDocument = createInput(documentInp, documentID);
        const newDocumentDescription = createInput(
          documentDescription,
          documentDescriptionID
        );

        addedInputsDiv.appendChild(newDocument);
        addedInputsDiv.appendChild(newDocumentDescription);

        doc_counter += 1;
      } else {
        alert("Por favor, digite um número de documento.");
      }
    });
}

function resetForm() {
  document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("create-demand");
    form.reset();
  });
}
