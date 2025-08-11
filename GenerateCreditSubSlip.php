<?php
require_once "./Helpers/InputHandler.php";
require_once "./class/Evaluation.php";
require_once __DIR__ . '/vendor/autoload.php';

$action = new Evaluation();

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $applicant_id = InputHandler::sanitize_int($_GET['applicant_id'] ?? '');

    $creditedSubjects = $action->getCreditedSubjectsByApplicantId($applicant_id);

    if ($creditedSubjects['status'] === "success") {
        $html = ''; // Initialize the variable

        $html .= '
            <div>
                <h1>Student Information</h1>
                <p><strong>Full Name:</strong> ' . htmlspecialchars($creditedSubjects['data'][0]['firstname'] . ' ' . $creditedSubjects['data'][0]['lastname']) . '</p>
                <p><strong>Course:</strong> ' . htmlspecialchars($creditedSubjects['data'][0]['course_code']) . '</p>
            </div>
        ';

        $html .= '
            <div style="position: absolute; left:0; right: 0; top: 0; bottom: 0;">
                <img src="./assets/ncst-logo.png"
                        style="width: 210mm; height: 297mm; margin: 0; opacity: 0.1;" />
            </div>
        ';

        // Compact table styling
        $html .= '
            <div style="
                margin: 15px auto;
                background: #ffffff;
                border-radius: 6px;
                overflow: hidden;
                box-shadow: 0 1px 6px rgba(0,0,0,0.1);
                max-width: 500px;
                width: 100%;
            ">
                <div style="
                    background: linear-gradient(135deg, #2c5aa0 0%, #1e3d72 100%);
                    color: white;
                    padding: 10px 15px;
                    font-weight: bold;
                    font-size: 14px;
                    text-align: center;
                    letter-spacing: 0.5px;
                ">
                    CREDITED SUBJECTS
                </div>
                
                <table style="
                    width: 100%;
                    border-collapse: collapse;
                    font-family: \'Segoe UI\', Tahoma, Geneva, Verdana, sans-serif;
                    font-size: 11px;
                    background: #ffffff;
                ">';

        // Compact table header
        $html .= '
            <thead>
                <tr style="background: #f8f9fa; border-bottom: 1px solid #dee2e6;">
                    <th style="
                        padding: 8px 10px;
                        text-align: left;
                        font-weight: 600;
                        color: #495057;
                        border-right: 1px solid #dee2e6;
                        width: 25%;
                        font-size: 10px;
                    ">Code</th>
                    <th style="
                        padding: 8px 10px;
                        text-align: left;
                        font-weight: 600;
                        color: #495057;
                        border-right: 1px solid #dee2e6;
                        width: 60%;
                        font-size: 10px;
                    ">Subject Name</th>
                    <th style="
                        padding: 8px 10px;
                        text-align: center;
                        font-weight: 600;
                        color: #495057;
                        width: 15%;
                        font-size: 10px;
                    ">Units</th>
                </tr>
            </thead>
            <tbody>';

        // Compact table rows with alternating colors
        $rowCount = 0;
        foreach ($creditedSubjects['data'] as $subject) {
            $rowColor = ($rowCount % 2 == 0) ? '#ffffff' : '#f8f9fa';
            $html .= '
                <tr style="
                    background-color: ' . $rowColor . ';
                    border-bottom: 1px solid #dee2e6;
                ">
                    <td style="
                        padding: 6px 10px;
                        border-right: 1px solid #dee2e6;
                        color: #495057;
                        font-weight: 500;
                        font-family: monospace;
                        font-size: 10px;
                    ">' . htmlspecialchars(strtoupper($subject['subject_code'])) . '</td>
                    <td style="
                        padding: 6px 10px;
                        border-right: 1px solid #dee2e6;
                        color: #212529;
                        line-height: 1.2;
                        font-size: 10px;
                    ">' . htmlspecialchars(ucwords(strtolower($subject['subject_name']))) . '</td>
                    <td style="
                        padding: 6px 10px;
                        text-align: center;
                        color: #495057;
                        font-weight: 600;
                        font-size: 11px;
                    ">' . htmlspecialchars($subject['total_units']) . '</td>
                </tr>
            ';
            $rowCount++;
        }

        // Compact table footer with total units
        $totalUnits = array_sum(array_column($creditedSubjects['data'], 'total_units'));
        $html .= '
            </tbody>
            <tfoot>
                <tr style="
                    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
                    color: white;
                    font-weight: bold;
                    border-top: 1px solid #28a745;
                ">
                    <td colspan="2" style="
                        padding: 8px 10px;
                        text-align: right;
                        font-size: 11px;
                        letter-spacing: 0.3px;
                    ">TOTAL UNITS:</td>
                    <td style="
                        padding: 8px 10px;
                        text-align: center;
                        font-size: 12px;
                        font-weight: bold;
                    ">' . $totalUnits . '</td>
                </tr>
            </tfoot>
        </table>
        </div>';

        // Compact footer note
        $html .= '
        <div style="
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #e9ecef;
            border-radius: 4px;
            background: #f8f9fa;
            text-align: center;
            font-size: 9px;
            color: #6c757d;
            font-style: italic;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        ">
            <p style="margin: 2px 0;">Date: ' . date('F j, Y, g:i a') . '</p>
            <p style="margin: 2px 0;">Present the slip to the evaluator to enlist the correct subjects.</p>
        </div>';

        $mpdf = new \Mpdf\Mpdf([
            'format' => 'A4',
            'margin_left' => 15,
            'margin_right' => 15,
            'margin_top' => 15,
            'margin_bottom' => 15
        ]);

        $mpdf->WriteHTML($html);
        $mpdf->Output("Credit_subject_slip.pdf", "D");
    }
    header("Location: ../pages/RegistrarSubjectCrediting.php");
}
