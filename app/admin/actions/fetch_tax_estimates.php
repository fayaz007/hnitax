<?php
require '../../config/database.php';

// Get user_id and tax_year from GET parameters
$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : null;
$tax_year = isset($_GET['tax_year']) ? $_GET['tax_year'] : null;

// Validate required parameters
if (!$user_id || !$tax_year) {
    echo "<tr><td colspan='8'>User ID or Tax Year is missing.</td></tr>";
    exit;
}

// Prepare SQL query to fetch tax estimates for the given user_id and tax_year
$query = "SELECT estimate_id, user_id, tax_year, federal_refund, state_refund, city_refund, 
                 (federal_refund + state_refund + city_refund) AS total 
          FROM tax_estimates 
          WHERE user_id = ? AND tax_year = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('ii', $user_id, $tax_year);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Apply 'bg-danger' class if the value is negative, 'bg-success-light' if positive
        $federalClass = $row['federal_refund'] < 0 ? 'bg-danger text-white' : 'bg-success-light';
        $stateClass = $row['state_refund'] < 0 ? 'bg-danger text-white' : 'bg-success-light';
        $cityClass = $row['city_refund'] < 0 ? 'bg-danger text-white' : 'bg-success-light';
        $totalClass = $row['total'] < 0 ? 'bg-danger text-white' : 'bg-success-light';

        echo "<tr>
                <td>{$row['estimate_id']}</td>
                <td>{$row['user_id']}</td>
                <td>{$row['tax_year']}</td>
                <td class='{$federalClass}'>$" . htmlspecialchars(number_format($row['federal_refund'], 2)) . "</td>
                <td class='{$stateClass}'>$" . htmlspecialchars(number_format($row['state_refund'], 2)) . "</td>
                <td class='{$cityClass}'>$" . htmlspecialchars(number_format($row['city_refund'], 2)) . "</td>
                <td class='{$totalClass}'>$" . htmlspecialchars(number_format($row['total'], 2)) . "</td>
                <td>
                    <button class='btn btn-sm btn-outline-primary edit-tax-estimate' data-id='{$row['estimate_id']}' data-federal='{$row['federal_refund']}' data-state='{$row['state_refund']}' data-city='{$row['city_refund']}'>
                        <i class='fas fa-edit'></i>
                    </button>
                    <button class='btn btn-sm btn-outline-danger delete-tax-estimate' data-id='{$row['estimate_id']}'>
                        <i class='fas fa-trash'></i>
                    </button>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='8'>No tax estimates found.</td></tr>";
}

$stmt->close();
$conn->close();
?>
