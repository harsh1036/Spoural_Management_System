<?php
include('../includes/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['event_id'])) {
    $event_id = $_POST['event_id'];

    $sql = "SELECT min_participants, max_participants FROM events WHERE id = :event_id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':event_id', $event_id, PDO::PARAM_INT);
    $query->execute();
    $event = $query->fetch(PDO::FETCH_ASSOC);

    // Debugging Output
    error_log("Event ID: $event_id, Min: " . $event['min_participants'] . ", Max: " . $event['max_participants']);

    if ($event) {
        echo json_encode([
            "success" => true,
            "minParticipants" => (int) $event['min_participants'],
            "maxParticipants" => (int) $event['max_participants']
        ]);
    } else {
        echo json_encode(["success" => false]);
    }
}
?>
