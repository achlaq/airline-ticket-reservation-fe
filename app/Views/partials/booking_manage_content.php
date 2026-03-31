<?php
// This view is loaded via AJAX. It receives the $booking object.
?>
<div class="card shadow-sm" style="border-radius: 1rem;">
    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Booking Reference (PNR)</h5>
        <span class="fs-4 fw-bold"><?= esc($booking['pnr']) ?></span>
    </div>
    <div class="card-body p-4">
        
        <div class="row border-bottom pb-3 mb-3">
            <div class="col-md-6">
                <small class="text-muted">Status</small>
                <p class="fw-bold fs-5 text-success"><?= esc(ucfirst(strtolower($booking['status']))) ?></p>
            </div>
            <div class="col-md-6 text-md-end">
                <small class="text-muted">Total Amount</small>
                <p class="fw-bold fs-5 text-primary">Rp <?= number_format((float)($booking['totalAmount'] ?? 0), 0, ',', '.') ?></p>
            </div>
        </div>

        <!-- Flight Details -->
        <?php if (!empty($booking['flight'])): ?>
        <h6 class="text-muted">Flight Details</h6>
        <?php $flight = $booking['flight']; ?>
        <div class="d-flex align-items-center justify-content-between p-3 bg-light rounded-3 mb-3">
            <div class="text-center">
                <div class="fs-4 fw-bold"><?= esc($flight['origin']) ?></div>
                <small><?= esc(substr($flight['depTime'], 0, 5)) ?></small>
            </div>
            <div class="text-center">
                <small class="text-muted"><?= esc($flight['flightNo']) ?></small>
                <div class="mx-3 text-primary">→</div>
            </div>
            <div class="text-center">
                <div class="fs-4 fw-bold"><?= esc($flight['dest']) ?></div>
                <small><?= esc(substr($flight['arrTime'], 0, 5)) ?></small>
            </div>
        </div>
        <?php endif; ?>

        <!-- Passenger Details -->
        <?php if (!empty($booking['passengers'])): ?>
        <h6 class="text-muted">Passengers</h6>
        <ul class="list-group mb-4">
            <?php foreach($booking['passengers'] as $pax): ?>
                <li class="list-group-item d-flex justify-content-between">
                    <span><?= esc($pax['fullName']) ?></span>
                    <span class="badge bg-secondary"><?= esc($pax['paxType']) ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>

        <!-- Contact Details (Update Form) -->
        <h6 class="text-muted">Update Contact Person</h6>
        <form method="post" action="/bookings/<?= esc($booking['pnr']) ?>/update" class="p-3 border rounded">
            <?= csrf_field() ?>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Name</label>
                    <input name="contactName" class="form-control" value="<?= esc($booking['contactName'] ?? '') ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="contactEmail" class="form-control" value="<?= esc($booking['contactEmail'] ?? '') ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Phone</label>
                    <input name="contactPhone" class="form-control" value="<?= esc($booking['contactPhone'] ?? '') ?>">
                </div>
                <div class="col-md-6 d-flex align-items-end">
                    <button class="btn btn-primary w-100">Update Contact</button>
                </div>
            </div>
        </form>

    </div>
    <div class="card-footer d-flex justify-content-between">
        <div>
            <a class="btn btn-secondary" href="/">New Search</a>
        </div>
        <div>
            <!-- Cancel Booking Form -->
            <form method="post" action="/bookings/<?= esc($booking['pnr']) ?>/cancel" class="d-inline" onsubmit="return confirm('Are you sure you want to cancel this booking? This action cannot be undone.')">
                <?= csrf_field() ?>
                <button class="btn btn-danger">Cancel Booking</button>
            </form>
        </div>
    </div>
</div>
