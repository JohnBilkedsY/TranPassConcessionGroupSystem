<?php
require_once('config.php');
require_once('tcpdf/tcpdf.php'); // Adjust the path accordingly

// Retrieve group_id from URL parameter
if(isset($_GET['group_id'])) {
    $groupId = $_GET['group_id'];
} else {
    // Handle the case where group_id is not provided
    echo "Group ID is not provided.";
    exit();
}

// Language settings
$l = array();
$l['a_meta_charset'] = 'UTF-8';
$l['a_meta_dir'] = 'ltr';
$l['a_meta_language'] = 'en';
$l['w_page'] = 'page';

// Create a new PDF instance
$pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('User and Group Information');
$pdf->SetSubject('User and Group Information');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// Set default header data
$pdf->SetHeaderData('', 0, 'Fare-Friendly student pass organiser', '');

// Set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// Set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// Set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Set some language-dependent strings
$pdf->setLanguageArray($l);

// Add a page
$pdf->AddPage();

// Set font
$pdf->SetFont('helvetica', '', 12);

// SQL query to fetch user and group data
$sql = "SELECT u.*, g.*, s1.station_name AS source_name, s2.station_name AS destination_name, f.fare, g.approveddate
        FROM users u
        INNER JOIN group_table g ON u.group_id = g.group_id
        INNER JOIN station s1 ON g.source_id = s1.station_id
        INNER JOIN station s2 ON g.destination_id = s2.station_id
        INNER JOIN fare f ON g.fare_id = f.fare_id
        WHERE g.group_id = $groupId";

$result = $conn->query($sql);

// Table header
$html = '<table border="1">
            <tr>
                <th>S.No.</th>
                <th>Name</th>
                <th>Age</th>
                <th>Source</th>
                <th>Destination</th>
                <th>Fare</th>
            </tr>';

// Table rows
if ($result && $result->num_rows > 0) {
    $counter = 1;
    while ($row = $result->fetch_assoc()) {
        $userAge = date_diff(date_create($row['dob']), date_create('today'))->y; // Calculate age from date of birth
        $approvedText = isset($row['approveddate']) ? 'Approved Date: ' . $row['approveddate'] : 'Group Not Approved';
        $html .= '<tr>
                    <td>' . $counter . '</td>
                    <td>' . $row['stud_name'] . '</td>
                    <td>' . $userAge . '</td>
                    <td>' . $row['source_name'] . '</td>
                    <td>' . $row['destination_name'] . '</td>
                    <td>' . $row['fare'] . '</td>
                  </tr>';
        $counter++;
    }
} else {
    $html .= '<tr><td colspan="6">No records found</td></tr>';
}

$html .= '</table>';

$html .='<p>The Application is valid only for 14 days</p>';

// Write HTML content to PDF
$pdf->writeHTML($html, true, false, true, false, '');
$text='signature';
$pdf->Text(20, 175, $text);
// Add image and approved date
$signatureImage = 'accept.jpeg'; // Path to your image file
if (file_exists($signatureImage)) {
    $pdf->Image($signatureImage, 250, 140, 30, 30, 'JPEG', '', 'R', true, 150, '', false, false, 1, false, false, false);

    // Add approved date
    $pdf->Text(230, 175, $approvedText);
} else {
    echo 'Image not found';
}

// Close and output PDF document
$pdf->Output('Group_information.pdf', 'I');

// Close connection
$conn->close();
?>
