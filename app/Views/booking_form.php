<div class="row g-4">
    
    <!-- Main Form Column -->
    <div class="col-lg-8">
        <h1 class="mb-4">Complete Your Booking</h1>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger shadow-sm"><?= esc($error) ?></div>
        <?php endif; ?>

        <form method="post" action="/bookings" id="form-booking">
            <?= csrf_field() ?>
            <input type="hidden" name="flightId" value="<?= esc($flightId) ?>">

            <!-- Contact Details Card -->
            <div class="card shadow-sm mb-4" style="border-radius: 1rem;">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Contact Details</h5>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="contactName" class="form-label">Full Name</label>
                            <input id="contactName" name="contactName" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="contactEmail" class="form-label">Email</label>
                            <input id="contactEmail" type="email" name="contactEmail" class="form-control" placeholder="For e-ticket" required>
                        </div>
                        <div class="col-md-6">
                            <label for="contactPhone" class="form-label">Phone</label>
                            <input id="contactPhone" name="contactPhone" class="form-control" placeholder="To receive updates" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Passenger Details Card -->
            <div class="card shadow-sm" style="border-radius: 1rem;">
                <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                    <h5 class="mb-0">Passenger(s)</h5>
                    <button type="button" class="btn btn-sm btn-light text-primary fw-bold" id="btn-add-pax">+ Add Passenger</button>
                </div>
                <div id="pax-list" class="card-body p-4">
                    <div class="pax-item bg-light border rounded p-3 mb-3 position-relative">
                        <button type="button" class="btn-close btn-del position-absolute top-0 end-0 m-2" aria-label="Close"></button>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Full Name</label>
                                <input data-key="fullName" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">ID / Passport No.</label>
                                <input data-key="docNo" class="form-control" placeholder="Required for check-in">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Passenger Type</label>
                                <select data-key="paxType" class="form-select" required>
                                    <option value="ADT" selected>Adult (ADT)</option>
                                    <option value="CHD">Child (CHD)</option>
                                    <option value="INF">Infant (INF)</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" data-key="birthDate" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-success btn-lg">Confirm and Save Booking</button>
                <a class="btn btn-secondary btn-lg" href="/">Cancel</a>
            </div>
        </form>
    </div>

    <!-- Right Summary Column -->
    <div class="col-lg-4">
        <?php if (!empty($flight)): ?>
        <div class="card shadow-sm sticky-top" style="top: 20px; border-radius: 1rem;">
            <div class="card-header bg-dark text-white"><h5 class="mb-0">Flight Summary</h5></div>
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="text-center">
                        <div class="fs-3 fw-bold"><?= esc($flight['origin']) ?></div>
                        <small class="text-muted"><?= esc(substr($flight['depTime'], 0, 5)) ?></small>
                    </div>
                    <div class="text-primary">→</div>
                    <div class="text-center">
                        <div class="fs-3 fw-bold"><?= esc($flight['dest']) ?></div>
                        <small class="text-muted"><?= esc(substr($flight['arrTime'], 0, 5)) ?></small>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <span>Flight Number</span>
                    <span class="fw-bold"><?= esc($flight['flightNo']) ?></span>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <span>Price / person</span>
                    <span class="fw-bold text-primary">Rp <?= number_format((float)($flight['price'] ?? 0), 0, ',', '.') ?></span>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>


<!-- Template for passenger items -->
<template id="pax-item-template">
    <div class="pax-item bg-light border rounded p-3 mb-3 position-relative">
        <button type="button" class="btn-close btn-del position-absolute top-0 end-0 m-2" aria-label="Close"></button>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Full Name</label>
                <input data-key="fullName" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">ID / Passport No.</label>
                <input data-key="docNo" class="form-control" placeholder="Required for check-in">
            </div>
            <div class="col-md-6">
                <label class="form-label">Passenger Type</label>
                <select data-key="paxType" class="form-select" required>
                    <option value="ADT" selected>Adult (ADT)</option>
                    <option value="CHD">Child (CHD)</option>
                    <option value="INF">Infant (INF)</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Date of Birth</label>
                <input type="date" data-key="birthDate" class="form-control">
            </div>
        </div>
    </div>
</template>
