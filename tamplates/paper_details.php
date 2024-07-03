<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paper Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
        }

        .container {
            width: 80%;
            max-width: 600px;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            padding: 10px 20px;
            margin: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: #fff;
        }

        .btn-accept {
            background-color: #2ecc71;
        }

        .btn-reject {
            background-color: #e74c3c;
        }

        .btn-back {
            background-color: #3498db;
        }
        .bold-input {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Paper Details</h2>
        <button class="btn-back" onclick="goBack()">Back</button>
        <input type="text" id="title" class="bold-input" readonly>
        <textarea id="description" readonly></textarea>
        <button class="btn-accept" onclick="updateStatus('accepted')">Accept</button>
        <button class="btn-reject" onclick="updateStatus('rejected')">Reject</button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', fetchPaperDetails);

        function fetchPaperDetails() {
            const urlParams = new URLSearchParams(window.location.search);
            const id = urlParams.get('id');

            fetch(`fetch_paper_details.php?id=${id}`)
                .then(response => response.json())
                .then(paper => {
                    document.getElementById('title').value = paper.title;
                    document.getElementById('description').value = paper.description;
                })
                .catch(error => console.error('Error fetching paper details:', error));
        }

        function updateStatus(status) {
            const urlParams = new URLSearchParams(window.location.search);
            const id = urlParams.get('id');

            fetch(`update_paper_status.php`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ id, status }),
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    alert(`Paper status updated to ${status}`);
                    window.location.href = 'admin_dashboard.html';
                } else {
                    alert('Error updating paper status');
                }
            })
            .catch(error => console.error('Error updating paper status:', error));
        }

        function goBack() {
            window.location.href = 'admin_dashboard.html';
        }
    </script>
</body>
</html>
