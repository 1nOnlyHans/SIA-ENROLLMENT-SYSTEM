<?php
// Includes
include "../includes/header.php";
include "../includes/StaffNavbar.php";
include "../class/Dbh.php";

// Create DB connection
$dbh = new Dbh();
$pdo = $dbh->Connect();

try {
    // Fetch all sections with possible subjects
    $stmt = $pdo->prepare("
        SELECT 
    sec.id AS section_id,
    sec.section AS section_name,
    sch.*,
    subj.subject_code,
    subj.subject_name
FROM schedules sch
JOIN sections sec 
    ON sch.section_id = sec.id
JOIN subjects subj 
    ON sch.subject_id = subj.id
ORDER BY sch.section_id, subj.subject_code;

    ");
    $stmt->execute();
    $sections = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Ensure all sections are in the array, even with no subjects
    $groupedSections = [];
    foreach ($sections as $row) {
        if (!isset($groupedSections[$row['section_name']])) {
            $groupedSections[$row['section_name']] = [];
        }
        if (!empty($row['subject_code'])) {
            $groupedSections[$row['section_name']][] = [
                'subject_code' => $row['subject_code'],
                'subject_name' => $row['subject_name'],
                'type' => $row['type'],
                'days' => $row['days'],
                'start' => $row['start_time'],
                'end' => $row['end_time'],
                'room' => $row['room'],
                'instructor' => $row['instructor'],
                'current_enrolled' => $row['current_enrolled'],
                'maximum_slot' => $row['maximum_slot'],
            ];
        }
    }
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}

?>
<div class="d-flex">
    <?php include "../includes/StaffSidebar.php"; ?>
    <div class="flex-grow-1">
        <div class="container mt-4">
            <h1 class="mb-4 text-center">📚 Sections and Subjects</h1>
            <div class="row">
                <?php foreach ($groupedSections as $sectionName => $subjects): ?>
                    <div class="col-12">
                        <div class="card mb-4 shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h4 class="mb-0"><?php echo htmlspecialchars($sectionName); ?></h4>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-responsive table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width: 20%">Subject Code</th>
                                            <th>Subject Name</th>
                                            <th>Type</th>
                                            <th>Days</th>
                                            <th>Start</th>
                                            <th>End</th>
                                            <th>Room</th>
                                            <th>Instructor</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($subjects)): ?>
                                            <?php foreach ($subjects as $subject): ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($subject['subject_code']); ?></td>
                                                    <td><?php echo htmlspecialchars($subject['subject_name']); ?></td>
                                                    <td><?php echo htmlspecialchars($subject['type']); ?></td>
                                                    <td><?php echo htmlspecialchars($subject['days']); ?></td>
                                                    <td><?php echo date("g:i A", strtotime($subject['end'])); ?></td>
                                                    <td><?php echo date("g:i A", strtotime($subject['start'])); ?></td>
                                                    <td><?php echo htmlspecialchars($subject['room']); ?></td>
                                                    <td><?php echo htmlspecialchars($subject['instructor']); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="2" class="text-center text-muted">No subjects assigned</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justfify-content-center">
                                    <button type="button" class="btn btn-primary">Enroll</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>