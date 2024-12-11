<?php
require '../vendor/autoload.php'; // Include PhpSpreadsheet autoloader
require '../../config/database.php'; // Include database connection

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;

// Create a new Spreadsheet
$spreadsheet = new Spreadsheet();

// Define tables to fetch and their respective queries
$tables = [
    'Personal Information' => "SELECT * FROM personal_information",
    'Spouse Information' => "SELECT * FROM spouse_information",
    'Contact Information' => "SELECT * FROM contact_information",
    'Dependents' => "SELECT * FROM dependents",
    'Insurance Details' => "SELECT * FROM insurance_details",
    'Tax Estimates' => "SELECT * FROM tax_estimates",
    'Residency Details' => "SELECT * FROM residency_details",
    'Employment Details' => "SELECT * FROM employment_details",
    'Other Income' => "SELECT * FROM other_income",
    'Deductions' => "SELECT * FROM deductions",
    'Adjustments to Income' => "SELECT * FROM adjustments_to_income",
    'FBAR' => "SELECT * FROM fbar",
    'Business Income' => "SELECT * FROM business_income",
    'Referrals' => "SELECT * FROM referrals"
];

// Style for the header
$headerStyle = [
    'font' => ['bold' => true, 'color' => ['rgb' => '000000']], 
    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'FFA500']] // Orange background
];

$sheetIndex = 0; // Initialize sheet index

foreach ($tables as $sheetTitle => $query) {
    // Fetch data for the current table
    $result = $conn->query($query);
    if (!$result || $result->num_rows === 0) {
        continue; // Skip if query fails or no data is returned
    }

    // Create a new sheet for each table
    if ($sheetIndex > 0) {
        $spreadsheet->createSheet();
    }
    $sheet = $spreadsheet->setActiveSheetIndex($sheetIndex);

    // Set the sheet title (limit to 31 characters and remove invalid characters)
    $sheet->setTitle(substr(preg_replace('/[\\/?*:[]"<>|]/', '', $sheetTitle), 0, 31));

    // Fetch and set headers
    $headers = array_keys($result->fetch_assoc());
    $result->data_seek(0); // Reset result pointer after fetching headers
    $col = 'A'; // Start column for headers
    foreach ($headers as $header) {
        $sheet->setCellValue("$col" . '1', $header); // Place headers in the first row
        $sheet->getStyle("$col" . '1')->applyFromArray($headerStyle); // Apply header styles
        $col++; // Move to the next column
    }

    // Populate rows with data
    $row = 2; // Start from the second row for data
    while ($data = $result->fetch_assoc()) {
        $col = 'A'; // Reset column to A for each row
        foreach ($data as $value) {
            $sheet->setCellValue("$col$row", $value); // Populate the cell
            $col++; // Move to the next column
        }
        $row++; // Move to the next row
    }

    $sheetIndex++; // Move to the next sheet
}

// Set the first sheet as active
$spreadsheet->setActiveSheetIndex(0);

// Set HTTP headers for download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Client_All_Details.xlsx"');
header('Cache-Control: max-age=0');

// Write the file
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>
