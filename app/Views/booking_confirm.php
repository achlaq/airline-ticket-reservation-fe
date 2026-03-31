<div class="row justify-content-center">
    <div class="col-md-10 col-lg-8">

        <div class="text-center mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-check-circle-fill text-success" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </svg>
            <h1 class="display-4 mt-2">Booking Confirmed!</h1>
            <p class="lead">Your e-ticket has been generated. Please keep a copy of your booking reference (PNR).</p>
        </div>

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
                <?php $flight = $booking['flight']; // Assuming flight details are nested ?>
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
                <ul class="list-group mb-3">
                    <?php foreach($booking['passengers'] as $pax): ?>
                        <li class="list-group-item d-flex justify-content-between">
                            <span><?= esc($pax['fullName']) ?></span>
                            <span class="badge bg-secondary"><?= esc($pax['paxType']) ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>

                <!-- Contact Details -->
                <?php if (!empty($booking['contactName'])): ?>
                <h6 class="text-muted">Contact Person</h6>
                <ul class="list-group">
                    <li class="list-group-item"><?= esc($booking['contactName']) ?></li>
                    <li class="list-group-item"><?= esc($booking['contactEmail']) ?></li>
                    <li class="list-group-item"><?= esc($booking['contactPhone']) ?></li>
                </ul>
                <?php endif; ?>

            </div>
            <div class="card-footer d-flex justify-content-end gap-2">
                <a class="btn btn-secondary" href="/">New Search</a>
                <a class="btn btn-outline-primary" href="/bookings/<?= esc($booking['pnr']) ?>">Manage Booking</a>
                <button class="btn btn-outline-secondary" onclick="window.print()">Print Ticket</button>
            </div>
        </div>
    </div>
</div>
