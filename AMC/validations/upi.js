function validateUPI(upi) {
    const upiPattern = /^[a-zA-Z0-9_.-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    return upiPattern.test(upi);
}

function validation() {
    const upiEl = document.getElementById("upi-text");
    const upi = upiEl.value;
    if (validateUPI(upi)) {
        alert("UPI is valid");
    } else {
        alert("UPI is not valid");
    }
}
