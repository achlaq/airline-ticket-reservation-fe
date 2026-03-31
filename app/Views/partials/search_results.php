<?php if (!empty($error)): ?>
    <div class="alert alert-danger shadow-sm"><?= esc($error) ?></div>
<?php endif; ?>

<?php if (empty($flights)): ?>
    <div class="text-center p-5 bg-light rounded-3">
        <h4>No Flights Found</h4>
        <p class="text-muted">Please try a different search criterion.</p>
    </div>
<?php else: ?>
    <h3 class="mb-4">Available Flights</h3>
    <?php foreach ($flights as $f): ?>
        <div class="card shadow-sm mb-3" style="border-radius: 0.75rem;">
            <div class="card-body p-4">
                <div class="row align-items-center g-3">
                    
                    <div class="col-12 col-md-3">
                        <div class="d-flex flex-column">
                            <small class="text-muted">Flight No</small>
                            <span class="fw-bold"><?= esc($f['flightNo']) ?></span>
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-4">
                        <div class="d-flex align-items-center justify-content-center">
                            <div class="text-center">
                                <small class="text-muted">Departure</small>
                                <div class="fw-bold fs-5"><?= esc(substr($f['depTime'], 0, 5)) ?></div>
                                <div class="fs-4 fw-bold"><?= esc($f['origin']) ?></div>
                            </div>
                            <div class="mx-3 text-muted">→</div>
                            <div class="text-center">
                                <small class="text-muted">Arrival</small>
                                <div class="fw-bold fs-5"><?= esc(substr($f['arrTime'], 0, 5)) ?></div>
                                <div class="fs-4 fw-bold"><?= esc($f['dest']) ?></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-2 text-md-center">
                        <div class="d-flex flex-column">
                            <small class="text-muted">Seats Left</small>
                            <span class="fw-bold"><?= esc($f['seatsLeft']) ?></span>
                        </div>
                    </div>

                    <div class="col-12 col-md-3 text-md-end">
                        <div class="d-flex flex-column">
                            <small class="text-muted">Price per person</small>
                            <span class="fw-bold fs-5 text-primary">
                                Rp <?= number_format((float)($f['price'] ?? 0), 0, ',', '.') ?>
                            </span>
                            <a class="btn btn-success mt-2" href="/bookings/new/<?= esc($f['id']) ?>">
                                Select Flight
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
