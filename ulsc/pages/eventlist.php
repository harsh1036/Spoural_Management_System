<?php
include('../includes/config.php');

$query = "SELECT e.id, e.event_name, e.event_type, 
                 (SELECT COUNT(*) FROM participants p WHERE p.event_id = e.id) AS participant_count
          FROM events e";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event List</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .event-header { 
            font-size: 20px; 
            font-weight: bold; 
            margin-top: 20px; 
            cursor: pointer; 
        }
        .no-participants { background-color: #ffcccc; } /* Highlight events with no participants */
        table { width: 100%; border-collapse: collapse; margin-top: 10px; display: none; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>

<h2>Event List</h2>

<?php while ($row = $result->fetch_assoc()): ?>
    <div class="event-header <?= $row['participant_count'] == 0 ? 'no-participants' : '' ?>" onclick="toggleTable(<?= $row['id'] ?>)">
        <?= htmlspecialchars($row['event_name']) ?> (<?= htmlspecialchars($row['event_type']) ?>) [+]
    </div>
    <table id="participants-table-<?= $row['id'] ?>">
        <thead>
            <tr>
                <th>Student ID</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $event_id = $row['id'];
            $participantQuery = "SELECT student_id FROM participants WHERE event_id = $event_id";
            $participantResult = $conn->query($participantQuery);

            if ($participantResult->num_rows > 0) {
                while ($participant = $participantResult->fetch_assoc()) {
                    echo "<tr><td>" . htmlspecialchars($participant['student_id']) . "</td></tr>";
                }
            } else {
                echo "<tr><td>No participants yet.</td></tr>";
            }
            ?>
        </tbody>
    </table>
<?php endwhile; ?>

<script>
function toggleTable(eventId) {
    let table = $("#participants-table-" + eventId);
    let header = $(".event-header[onclick='toggleTable(" + eventId + ")']");

    if (table.is(":visible")) {
        table.slideUp();
        header.html(header.html().replace("[-]", "[+]"));
    } else {
        table.slideDown();
        header.html(header.html().replace("[+]", "[-]"));
    }
}
</script>

</body>
</html>

<?php $conn->close(); ?>
