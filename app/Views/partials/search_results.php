<?php if (!empty($error)): ?>
  <div class="alert alert-danger"><?= esc($error) ?></div>
<?php endif; ?>

<?php if (empty($flights)): ?>
  <div class="alert alert-secondary">No flights found.</div>
<?php else: ?>
  <div class="card">
    <div class="card-header">Results</div>
    <div class="table-responsive">
      <table class="table table-striped mb-0">
        <thead>
          <tr>
            <th>Flight</th><th>Route</th><th>Dep</th><th>Arr</th><th>Price</th><th>Seat Left</th><th></th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($flights as $f): ?>
          <tr>
            <td><?= esc($f['flightNo']) ?></td>
            <td><?= esc($f['origin']) ?> → <?= esc($f['dest']) ?></td>
            <td><?= esc($f['depTime']) ?></td>
            <td><?= esc($f['arrTime']) ?></td>
            <td>Rp <?= number_format((float)($f['price'] ?? 0), 0, ',', '.') ?></td>
            <td><?= esc($f['seatsLeft']) ?></td>
            <td>
              <a class="btn btn-sm btn-success" href="/bookings/new/<?= esc($f['id']) ?>">Select</a>
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
<?php endif; ?>
