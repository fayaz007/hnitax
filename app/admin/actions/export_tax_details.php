<?php
require '../vendor/autoload.php'; // Include PhpSpreadsheet autoload file
require '../../config/database.php'; // Include your database connection here

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;

// Fetch user_id and tax_year from the GET request
$user_id = isset($_GET['user_id']) ? (int)$_GET['user_id'] : 0;
$tax_year = isset($_GET['tax_year']) ? $_GET['tax_year'] : '';

if (empty($user_id) || empty($tax_year)) {
    die("Invalid user ID or tax year.");
}

// Define queries for each section
$queries = [
    'Personal Information' => "SELECT * FROM personal_information WHERE user_id = $user_id AND tax_year = '$tax_year'",
    'Spouse Information' => "SELECT * FROM spouse_information WHERE user_id = $user_id AND tax_year = '$tax_year'",
    'Contact Information' => "SELECT * FROM contact_information WHERE user_id = $user_id AND tax_year = '$tax_year'",
    'Dependents' => "SELECT * FROM dependents WHERE user_id = $user_id AND tax_year = '$tax_year'",
    'Insurance Details' => "SELECT * FROM insurance_details WHERE user_id = $user_id AND tax_year = '$tax_year'",
    'Tax Estimates' => "SELECT * FROM tax_estimates WHERE user_id = $user_id AND tax_year = '$tax_year'",
    'Residency Details' => "SELECT * FROM residency_details WHERE user_id = $user_id AND tax_year = '$tax_year'",
    'Employment Details' => "SELECT * FROM employment_details WHERE user_id = $user_id AND tax_year = '$tax_year'",
    'Other Income' => "SELECT * FROM other_income WHERE user_id = $user_id AND tax_year = '$tax_year'",
    'Deductions' => "SELECT * FROM deductions WHERE user_id = $user_id AND tax_year = '$tax_year'",
    'Adjustments to Income' => "SELECT * FROM adjustments_to_income WHERE user_id = $user_id AND tax_year = '$tax_year'",
    'FBAR Details' => "SELECT * FROM fbar WHERE user_id = $user_id AND tax_year = '$tax_year'",
    'Business Income' => "SELECT * FROM business_income WHERE user_id = $user_id AND tax_year = '$tax_year'",
    'Referrals' => "SELECT * FROM referrals WHERE user_id = $user_id",
];

// Initialize data array to store query results
$data = [];
foreach ($queries as $section => $query) {
    $result = $conn->query($query);
    if ($result && $result->num_rows > 0) {
        $data[$section] = $result->fetch_all(MYSQLI_ASSOC); // Fetch all rows as associative array
    } else {
        $data[$section] = null;
    }
}

// Create a new Spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Tax Filing Details');

// Style for table headings
$headingStyle = [
    'font' => ['bold' => true, 'color' => ['rgb' => '#000000']],
    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'CCCCCC']],
];

// Write data to the spreadsheet
$row = 1;
foreach ($data as $section => $records) {
    $sheet->setCellValue("A$row", $section); // Write section name
    $sheet->mergeCells("A$row:B$row"); // Merge cells for section name
    $sheet->getStyle("A$row")->applyFromArray([
        'font' => ['bold' => true],
        'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'FFA500']],
    ]);
    $row++;

    if ($records) {
        // Write table headings in bold and orange
        $col = 'A';
        foreach (array_keys($records[0]) as $heading) {
            $sheet->setCellValue("$col$row", $heading);
            $sheet->getStyle("$col$row")->applyFromArray($headingStyle);
            $col++;
        }
        $row++;

        // Write table data
        foreach ($records as $record) {
            $col = 'A';
            foreach ($record as $value) {
                $sheet->setCellValue("$col$row", $value);
                $col++;
            }
            $row++;
        }
    } else {
        $sheet->setCellValue("A$row", 'No data available');
        $row++;
    }
    $row++; // Add an empty row between sections
}

// Set HTTP headers for file download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Tax_Filing_Details_' . $user_id . '_' . $tax_year . '.xlsx"');
header('Cache-Control: max-age=0');

// Write the spreadsheet to output
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>
