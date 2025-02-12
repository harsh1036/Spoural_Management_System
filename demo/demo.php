<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }
        select, input {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
        }
        .student-entry {
            display: flex;
            gap: 10px;
        }
        .student-entry input {
            flex: 1;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            margin-top: 15px;
            width: 100%;
        }
    </style>
</head>
<body>

    <h2>Event Registration</h2>

    <form action="submit.php" method="POST">
        <label for="eventSelect">Select Event:</label>
        <select id="eventSelect" name="event">
            <option value="">Select Event</option>
            <option value="event1">Event 1</option>
            <option value="event2">Event 2</option>
            <option value="event3">Event 3</option>
        </select>

        <div id="studentsContainer"></div>

        <button type="submit">Submit</button>
    </form>

    <script>
        document.getElementById("eventSelect").addEventListener("change", function () {
            let container = document.getElementById("studentsContainer");
            container.innerHTML = ""; // Clear previous inputs

            if (this.value) {
                for (let i = 1; i <= 10; i++) {
                    let studentDiv = document.createElement("div");
                    studentDiv.className = "student-entry";

                    let idInput = document.createElement("input");
                    idInput.type = "text";
                    idInput.name = "student_id[]";
                    idInput.placeholder = "Student ID " + i;
                    idInput.required = true;

                    let nameInput = document.createElement("input");
                    nameInput.type = "text";
                    nameInput.name = "student_name[]";
                    nameInput.placeholder = "Student Name " + i;
                    nameInput.required = true;

                    studentDiv.appendChild(idInput);
                    studentDiv.appendChild(nameInput);
                    container.appendChild(studentDiv);
                }
            }
        });
    </script>

</body>
</html>
