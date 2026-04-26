document.addEventListener("DOMContentLoaded", function () {
    // Delete functionality
    document.querySelectorAll(".delete-btn").forEach(button => {
        button.addEventListener("click", function () {
            let id = this.dataset.id;
            let type = this.dataset.type;
            if (confirm("Are you sure you want to delete this record?")) {
                fetch("delete.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: `id=${id}&type=${type}`
                })
                    .then(response => response.text())
                    .then(data => {
                        if (data === "success") {
                            alert("Record deleted successfully");
                            location.reload();
                        } else {
                            alert("Error deleting record");
                        }
                    });
            }
        });
    });

    // Edit functionality
    document.querySelectorAll(".edit-btn").forEach(button => {
        button.addEventListener("click", function () {
            let id = this.dataset.id;
            let name = prompt("Enter new name:", this.dataset.name);
            let email = prompt("Enter new email:", this.dataset.email);

            if (name && email) {
                fetch("edit.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: `id=${id}&name=${name}&email=${email}`
                })
                    .then(response => response.text())
                    .then(data => {
                        if (data === "success") {
                            alert("Updated successfully");
                            location.reload();
                        } else {
                            alert("Error updating record");
                        }
                    });
            }
        });
    });

    // View functionality
    document.querySelectorAll(".view-btn").forEach(button => {
        button.addEventListener("click", function () {
            let id = this.dataset.id;
            let type = this.dataset.type;
            window.location.href = `view.php?id=${id}&type=${type}`;
        });
    });
});
