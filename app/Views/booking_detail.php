<div class="card">
  <div class="card-header">Booking Detail (PNR: <?= esc($pnr) ?>)</div>
  <div class="card-body">
    <form method="post" action="/bookings/<?= esc($pnr) ?>/update" class="row g-3">
      <?= csrf_field() ?>
      <div class="col-md-4">
        <label class="form-label">Name</label>
        <input name="contactName" class="form-control" placeholder="optional">
      </div>
      <div class="col-md-4">
        <label class="form-label">Email</label>
        <input type="email" name="contactEmail" class="form-control" placeholder="optional">
      </div>
      <div class="col-md-4">
        <label class="form-label">Phone</label>
        <input name="contactPhone" class="form-control" placeholder="optional">
      </div>
      <div class="col-12">
        <button class="btn btn-primary">Update</button>
        <a class="btn btn-secondary" href="/">Home</a>
      </div>
    </form>
  </div>
</div>
