document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("payment-form").addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent default form submission

        const phone = document.getElementById("phone").value;
        const amount = document.getElementById("amount").value;

        if (!phone || !amount) {
            alert("Please enter your phone number and amount.");
            return;
        }

        // Send request to backend for MPESA processing
        fetch("process_payment.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ phone, amount })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Payment request sent. Check your phone to complete the transaction.");
                } else {
                    alert("Payment failed: " + data.error);
                }
            })
            .catch(error => console.error("Error:", error));
    });
});
document.addEventListener("DOMContentLoaded", function () {
    const mpesaRadio = document.getElementById("mpesa");
    const bankRadio = document.getElementById("bank-transfer");

    const mpesaSubform = document.getElementById("mpesa-subform");
    const bankSubform = document.getElementById("bank-subform");

    document.querySelectorAll('input[name="payment-method"]').forEach((radio) => {
        radio.addEventListener("change", function () {
            mpesaSubform.style.display = mpesaRadio.checked ? "block" : "none";
            bankSubform.style.display = bankRadio.checked ? "block" : "none";
        });
    });
});
