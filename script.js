
// Handle form submission
document.getElementById('clearance-form').addEventListener('submit', function (e) {
    e.preventDefault();

    // Collect student information
    const studentName = document.getElementById('student-name').value.trim();
    const studentId = document.getElementById('student-id').value.trim();
    const clearanceStatus = document.getElementById('clearance-status').value;

    if (!studentName || !studentId) {
        alert('Please fill out all student information.');
        return;
    }

    // Collect department clearances
    const departmentClearances = Array.from(document.querySelectorAll('#departments-list tr')).map(row => {
        const department = row.children[1].textContent.trim();
        const itemsLost = row.children[2].querySelector('input').value.trim();
        const costOfItems = row.children[3].querySelector('input').value.trim();
        const signature = row.children[4].querySelector('input').value.trim();

        return {
            department,
            itemsLost: itemsLost || 'None',
            costOfItems: parseFloat(costOfItems) || 0,
            signature: signature || 'N/A'
        };
    });

    const formData = {
        studentName,
        studentId,
        clearanceStatus,
        departmentClearances
    };

    // Submit form data
    fetch('/api/submit-clearance', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(formData)
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Clearance submitted successfully.');
                document.getElementById('clearance-form').reset(); // Reset the form
            } else {
                alert(data.message || 'An error occurred while submitting clearance.');
            }
        })
        .catch(error => {
            console.error('Error submitting clearance:', error);
            alert('Failed to submit clearance. Please try again.');
        });
});

// Real-time input validation (optional)
document.addEventListener('input', (e) => {
    if (e.target.name === 'costOfItems' && e.target.value < 0) {
        alert('Cost of items cannot be negative.');
        e.target.value = '';
    }
});
document.getElementById('payment-form').addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = new FormData(this);

    fetch('stk_push.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            alert(`Response: ${JSON.stringify(data)}`);
        })
        .catch(error => console.error('Error:', error));
});
