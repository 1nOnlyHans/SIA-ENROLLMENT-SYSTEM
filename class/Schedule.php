<?php
require_once "Dbh.php";

class Schedule extends Dbh
{
    private $db;

    public function __construct()
    {
        $this->db = $this->Connect();
    }

    public function createSched($section_id, $subject_id, $type, $instructor, $days, $start, $end, $room)
    {
        try {
            $stmt = $this->db->prepare("
            INSERT INTO schedules 
            (section_id, subject_id, type, instructor, days, start_time, end_time, room) 
            VALUES 
            (:section_id, :subject_id, :type, :instructor, :days, :start_time, :end_time, :room)
        ");
            $stmt->execute([
                ':section_id' => $section_id,
                ':subject_id' => $subject_id,
                ':type'       => $type,
                ':instructor' => $instructor,
                ':days'       => $days,
                ':start_time' => $start,
                ':end_time'   => $end,
                ':room'       => $room
            ]);

            if ($stmt->rowCount() > 0) {
                return [
                    "status" => "success",
                    "message" => "Subject Schedule Created"
                ];
            } else {
                return [
                    "status" => "error",
                    "message" => "Failed to create subject"
                ];
            }
        } catch (PDOException $e) {
            return [
                "status" => "error",
                "message" => "Database Error: " . $e->getMessage()
            ];
        }
    }
}
