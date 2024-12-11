<?php
$referrals_query = "SELECT * FROM referrals WHERE user_id = ? AND tax_year = ?";
$stmt = $conn->prepare($referrals_query);
$stmt->bind_param('is', $user_id, $tax_year);
$stmt->execute();
$referrals_result = $stmt->get_result();

// Fetch referrals into an array
$referrals = [];
while ($row = $referrals_result->fetch_assoc()) {
    $referrals[] = $row;
}
?>

<!-- Referrals Section -->
<div class="card mb-3 curve-card card-dark">
    <div class="card-header curve-card">
        <h3 class="card-title"><i class="fas fa-user-plus"></i> Referrals</h3>
    </div>
    <div class="card-body">
        <?php if (count($referrals) > 0): ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-sm">
                    <thead class="-dark">
                        <tr>
                            <th>#</th>
                            <th>Referral Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Referral Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($referrals as $index => $referral): ?>
                            <tr>
                                <td><?= $index + 1; ?></td>
                                <td><?= htmlspecialchars($referral['referral_name']); ?></td>
                                <td><?= htmlspecialchars($referral['phone']); ?></td>
                                <td><?= htmlspecialchars($referral['email']); ?></td>
                                <td><?= htmlspecialchars($referral['created_at']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p>No referrals found for this year.</p>
        <?php endif; ?>
    </div>
</div>