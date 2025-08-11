<?php

require_once "../Helpers/InputHandler.php";
require_once "../class/Section.php";
require_once "../class/Schedule.php";

$db = new Dbh;
$conn = $db->Connect();

$actionType = InputHandler::sanitize_string($_REQUEST['actionType']);

$sectionAction = new Section;
$scheduleAction = new Schedule;

$requestMethod = $_SERVER['REQUEST_METHOD'];

$response = [
    "status" => "error",
    "message" => "Invalid action or method"
];

$response = [
    "status" => "error",
    "message" => "Invalid action or method"
];

switch ($actionType) {
    case "Test":
        if ($requestMethod === "POST") {
            try {
                // 🔹 Start transaction
                $conn->beginTransaction();

                $course_id    = InputHandler::sanitize_int($_POST['course_id']);
                $year_level   = InputHandler::sanitize_int($_POST['year_lvl']);
                $section_code = InputHandler::sanitize_string($_POST['section_code']);
                $section_type = InputHandler::sanitize_string($_POST['section_type']);

                // 1. Create section
                $sectionResult = $sectionAction->createSection($course_id, $year_level, $section_code, $section_type);
                $section_id = $sectionResult['section_id'];

                // 2. Get posted schedule data
                $subject_ids   = $_POST['subject_id'];
                $subject_types = $_POST['subject_type'];
                $instructors   = $_POST['instructor'];
                $start_times   = $_POST['start_time'];
                $end_times     = $_POST['end_time'];
                $rooms         = $_POST['room'];
                $daysArray     = $_POST['day'];

                // 3. Loop through subjects to insert schedules
                foreach ($subject_ids as $index => $subject_id) {
                    $type       = $subject_types[$index];
                    $instructor = $instructors[$index];
                    $start      = $start_times[$index];
                    $end        = $end_times[$index];
                    $room       = $rooms[$index];

                    $selectedDays = isset($daysArray[$subject_id][$type])
                        ? implode(',', $daysArray[$subject_id][$type])
                        : '';

                    // Validate time format
                    $startObj = DateTime::createFromFormat('H:i', $start);
                    $endObj   = DateTime::createFromFormat('H:i', $end);

                    if (!$startObj || !$endObj) {
                        throw new Exception("Invalid time format for subject {$subject_id}");
                    }
                    if ($startObj >= $endObj) {
                        throw new Exception("Start time must be earlier than end time for subject {$subject_id}");
                    }

                    // Insert schedule
                    $scheduleAction->createSched(
                        $section_id,
                        $subject_id,
                        $type,
                        $instructor,
                        $selectedDays,
                        $start,
                        $end,
                        $room
                    );
                }

                // 4. Commit if all good
                $conn->commit();

                $response = [
                    "status" => "success",
                    "message" => "Section and schedules saved successfully"
                ];
            } catch (Exception $e) {
                // Rollback on any error
                $conn->rollBack();
                $response = [
                    "status" => "error",
                    "message" => $e->getMessage()
                ];
            }
        }
        break;
    default:
        $response = [
            "status" => "error",
            "message" => "Unknown action: $actionType"
        ];
        break;
}

echo json_encode($response);
