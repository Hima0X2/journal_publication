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
            min-height: 100vh;
            background-color: #f0f0f0;
        }

        .container {
            width: 90%;
            max-width: 800px;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            text-align: left;
            margin-top: 30px;
            box-sizing: border-box;
        }

        .container h2 {
            margin-bottom: 20px;
            color: #333;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }

        .paper-detail {
            margin-bottom: 20px;
        }

        .paper-detail h3 {
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        .paper-detail p {
            margin: 0;
            color: #777;
        }

        .btn-container {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
        }

        button {
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
            outline: none;
        }

        .btn-back {
            background-color: #3498db;
            color: #fff;
        }

        .btn-accept {
            background-color: #2ecc71;
            color: #fff;
        }

        .btn-reject {
            background-color: #e74c3c;
            color: #fff;
        }

        .btn-back .btn-accept .btn-reject{
            transform: scale(1.1);
        }
        button:hover {
            opacity: 0.9;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            button {
                padding: 10px 20px;
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Paper Details</h2>

        <div class="paper-detail">
            <h3>Title:</h3>
            <p id="title" class="bold-input"></p>
        </div>

        <div class="paper-detail">
            <h3>Keywords:</h3>
            <p id="keywords"></p>
        </div>

        <div class="paper-detail">
            <h3>Abstract:</h3>
            <p id="abstract"></p>
        </div>

        <div class="paper-detail">
            <h3>Description:</h3>
            <p id="description"></p>
        </div>

        <div class="btn-container">
            <button class="btn-back" onclick="goBack()">Back</button>
            <button class="btn-accept" onclick="updateStatus('accepted')">Accept</button>
            <button class="btn-reject" onclick="updateStatus('rejected')">Reject</button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', fetchPaperDetails);

        function fetchPaperDetails() {
            const urlParams = new URLSearchParams(window.location.search);
            const id = urlParams.get('id');

            fetch(`fetch_paper_details.php?id=${id}`)
                .then(response => response.json())
                .then(paper => {
                    document.getElementById('title').textContent = paper.title;
                    document.getElementById('keywords').textContent = paper.keywords;
                    document.getElementById('abstract').textContent = paper.abstract;
                    document.getElementById('description').textContent = paper.description;
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
