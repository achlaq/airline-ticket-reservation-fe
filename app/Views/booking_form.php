<div class="card">
  <div class="card-header">New Booking</div>
  <div class="card-body">
    <?php if (!empty($error)): ?>
      <div class="alert alert-danger"><?= esc($error) ?></div>
    <?php endif; ?>

    <?php if (!empty($flight)): ?>
      <div class="mb-3">
        <strong><?= esc($flight['flightNo'] ?? '') ?></strong> |
        <?= esc($flight['origin'] ?? '') ?> → <?= esc($flight['dest'] ?? '') ?> |
        <?= esc($flight['depTime'] ?? '') ?> – <?= esc($flight['arrTime'] ?? '') ?>
      </div>
    <?php endif; ?>

    <form method="post" action="/bookings" id="form-booking">
      <?= csrf_field() ?>
      <input type="hidden" name="flightId" value="<?= esc($flightId) ?>">

      <h6>Contact</h6>
      <div class="row g-3">
        <div class="col-md-4">
          <label class="form-label">Name</label>
          <input name="contactName" class="form-control" required>
        </div>
        <div class="col-md-4">
          <label class="form-label">Email</label>
          <input type="email" name="contactEmail" class="form-control">
        </div>
        <div class="col-md-4">
          <label class="form-label">Phone</label>
          <input name="contactPhone" class="form-control" required>
        </div>
      </div>

      <hr>
      <div class="d-flex justify-content-between align-items-center">
        <h6 class="mb-0">Passengers</h6>
        <button class="btn btn-sm btn-outline-primary" id="btn-add-pax">+ Add Passenger</button>
      </div>

      <div id="pax-list" class="mt-2">
        <div class="pax-item row g-3 border rounded p-2 mb-2">
          <div class="col-md-6">
            <label class="form-label">Full name</label>
            <input data-key="fullName" class="form-control" required>
          </div>
          <div class="col-md-2">
            <label class="form-label">Type</label>
            <select data-key="paxType" class="form-select" required>
              <option value="ADT">ADT</option><option value="CHD">CHD</option><option value="INF">INF</option>
            </select>
          </div>
          <div class="col-md-2">
            <label class="form-label">Birth date</label>
            <input type="date" data-key="birthDate" class="form-control">
          </div>
          <div class="col-md-2">
            <label class="form-label">Doc No</label>
            <input data-key="docNo" class="form-control" placeholder="KTP/PASSPORT">
          </div>
          <div class="col-12 d-flex justify-content-end">
            <button class="btn btn-sm btn-outline-danger btn-del">Remove</button>
          </div>
        </div>
      </div>

      <template id="pax-item-template">
        <div class="pax-item row g-3 border rounded p-2 mb-2">
          <div class="col-md-6">
            <label class="form-label">Full name</label>
            <input data-key="fullName" class="form-control" required>
          </div>
          <div class="col-md-2">
            <label class="form-label">Type</label>
            <select data-key="paxType" class="form-select" required>
              <option value="ADT">ADT</option><option value="CHD">CHD</option><option value="INF">INF</option>
            </select>
          </div>
          <div class="col-md-2">
            <label class="form-label">Birth date</label>
            <input type="date" data-key="birthDate" class="form-control">
          </div>
          <div class="col-md-2">
            <label class="form-label">Doc No</label>
            <input data-key="docNo" class="form-control">
          </div>
          <div class="col-12 d-flex justify-content-end">
            <button class="btn btn-sm btn-outline-danger btn-del">Remove</button>
          </div>
        </div>
      </template>

      <div class="mt-3 d-flex gap-2">
        <button class="btn btn-primary">Save Booking</button>
        <a class="btn btn-secondary" href="/">Back</a>
      </div>
    </form>
  </div>
</div>
