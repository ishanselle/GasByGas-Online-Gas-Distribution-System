document.getElementById("gasType").addEventListener("change", function () {
    const gasType = this.value;
    const packSelect = document.getElementById("pack");
    packSelect.innerHTML = ""; // Clear existing options

    if (gasType === "Domestic") {
        packSelect.innerHTML += `<option value="">-- Choose Pack --</option>`;
        packSelect.innerHTML += `<option value="GasByGas Regular">GasByGas Regular</option>`;
        packSelect.innerHTML += `<option value="GasByGas Saver">GasByGas Saver</option>`;
        packSelect.innerHTML += `<option value="GasByGas Mini">GasByGas Mini</option>`;
    } else if (gasType === "Industrial") {
        packSelect.innerHTML += `<option value="">-- Choose Pack --</option>`;
        packSelect.innerHTML += `<option value="GasByGas Max">GasByGas Max</option>`;
        packSelect.innerHTML += `<option value="GasByGas Pro">GasByGas Pro</option>`;
    }
});
