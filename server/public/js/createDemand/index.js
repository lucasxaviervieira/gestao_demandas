window.onload = function () {
  changeOkrDisplay();
  addSectors();
  addProcessSei();
  addDocument();
  resetForm();
};

function changeOkrDisplay() {
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

        const sectorContainer = document.createElement("div");
        sectorContainer.classList.add("sector-container");
        sectorContainer.id = "sector-container_" + sector_counter;

        const senderSelect = createSelect(senderOption, nameAndIdSender);
        const recipientSelect = createSelect(
          recipientOption,
          nameAndIdRecipient
        );

        const deleteButton = document.createElement("button");
        deleteButton.innerText = "Deletar";
        deleteButton.classList.add("delete-button");
        deleteButton.addEventListener("click", function () {
          addedInputsDiv.removeChild(sectorContainer);
        });

        sectorContainer.appendChild(senderSelect);
        sectorContainer.appendChild(recipientSelect);
        sectorContainer.appendChild(deleteButton);

        addedInputsDiv.appendChild(sectorContainer);

        sector_counter += 1;
      } else {
        alert("Por favor, selecione um dos setores.");
      }
    });
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

        const processContainer = document.createElement("div");
        processContainer.classList.add("process-container");
        processContainer.id = "process-container_" + sei_counter;

        const newSeiProcess = createInput(seiProcess, seiProcessID);
        const newProcessDescription = createInput(
          processDescription,
          processDescriptionID
        );

        const deleteButton = document.createElement("button");
        deleteButton.innerText = "Deletar";
        deleteButton.classList.add("delete-button");

        deleteButton.addEventListener("click", function () {
          addedInputsDiv.removeChild(processContainer);
        });

        processContainer.appendChild(newSeiProcess);
        processContainer.appendChild(newProcessDescription);
        processContainer.appendChild(deleteButton);

        addedInputsDiv.appendChild(processContainer);

        sei_counter += 1;

        seiProcess.value = "";
        processDescription.value = "";
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

        const documentContainer = document.createElement("div");
        documentContainer.classList.add("document-container");
        documentContainer.id = "doc-container_" + doc_counter;

        const newDocument = createInput(documentInp, documentID);
        const newDocumentDescription = createInput(
          documentDescription,
          documentDescriptionID
        );

        const deleteButton = document.createElement("button");
        deleteButton.innerText = "Deletar";
        deleteButton.classList.add("delete-button");
        deleteButton.addEventListener("click", function () {
          addedInputsDiv.removeChild(documentContainer);
        });

        documentContainer.appendChild(newDocument);
        documentContainer.appendChild(newDocumentDescription);
        documentContainer.appendChild(deleteButton);

        addedInputsDiv.appendChild(documentContainer);

        doc_counter += 1;

        documentInp.value = "";
        documentDescription.value = "";
      } else {
        alert("Por favor, digite um número de documento.");
      }
    });
}

function createSelect(optionSelected, nameAndId) {
  const select = document.createElement("select");
  const option = document.createElement("option");

  option.value = optionSelected.value;
  option.textContent = optionSelected.textContent;
  option.selected = true;

  select.appendChild(option);
  select.id = nameAndId;
  select.name = nameAndId;
  select.classList.add("no-arrow");
  select.setAttribute("form", "create-demand");

  return select;
}

function createInput(reference, referenceID) {
  const input = document.createElement("input");
  input.value = reference.value;
  input.id = referenceID;
  input.name = referenceID;
  input.readOnly = true;
  input.setAttribute("form", "create-demand");

  return input;
}

function resetForm() {
  document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("create-demand");
    form.reset();
  });
}
