<div class="card">
  <div class="card-header">Booking Confirmed</div>
  <div class="card-body">
    <p><strong>PNR:</strong> <?= esc($booking['pnr']) ?></p>
    <p><strong>Status:</strong> <?= esc($booking['status']) ?></p>
    <p><strong>Total:</strong> Rp <?= number_format((float)($booking['totalAmount'] ?? 0), 0, ',', '.') ?></p>

    <form method="post" action="/bookings/<?= esc($booking['pnr']) ?>/cancel" class="d-inline">
      <?= csrf_field() ?>
      <button class="btn btn-danger" onclick="return confirm('Cancel this booking?')">Cancel Booking</button>
    </form>
    <a class="btn btn-outline-primary" href="/bookings/<?= esc($booking['pnr']) ?>">Modify</a>
    <a class="btn btn-secondary" href="/">Home</a>
  </div>
</div>
