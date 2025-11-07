<?php
  $content    = $data['content'] ?? [];
  $page       = $data['number'] ?? 0;
  $size       = $data['size'] ?? ($q['size'] ?? 10);
  $totalPages = $data['totalPages'] ?? 0;
?>

<?php if (empty($content)): ?>
  <div class="alert alert-warning mb-0">No bookings found.</div>
<?php else: ?>
  <div class="table-responsive">
    <table class="table table-striped align-middle">
      <thead>
        <tr>
          <th>PNR</th><th>Status</th><th>Contact</th><th>Phone</th><th>Total</th><th>Created</th><th>Aksi</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($content as $row): ?>
        <?php
          $pnr      = $row['pnr'];
          $pnrDisp  = esc($pnr);
          $pnrUrl   = rawurlencode($pnr); // aman untuk dimasukkan ke URL
          // Buat ID aman untuk collapse (hindari '/', spasi, dll.)
          $collapseId = 'edit-' . preg_replace('/[^A-Za-z0-9_-]/', '-', $pnr);
        ?>
        <tr>
          <td><a href="/bookings/<?= $pnrUrl ?>"><?= $pnrDisp ?></a></td>
          <td>
            <span class="badge bg-<?= $row['status']==='CANCELLED'?'secondary':($row['status']==='CONFIRMED'?'success':'warning') ?>">
              <?= esc($row['status']) ?>
            </span>
          </td>
          <td><?= esc($row['contactName'] ?? '-') ?></td>
          <td><?= esc($row['contactPhone'] ?? '-') ?></td>
          <td>Rp <?= number_format((float)($row['totalAmount'] ?? 0), 0, ',', '.') ?></td>
          <td><?= esc($row['createdAt'] ?? '') ?></td>
          <td class="d-flex gap-2">
            <!-- Edit contact (toggle collapse) -->
            <button class="btn btn-sm btn-outline-primary" type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#<?= $collapseId ?>"
                    aria-controls="<?= $collapseId ?>"
                    aria-expanded="false">Edit</button>

            <form method="post"
                  action="/admin/bookings/<?= $pnrUrl ?>/cancel"
                  onsubmit="return confirm('Cancel <?= $pnrDisp ?>?')">
              <?= csrf_field() ?>
              <button class="btn btn-sm btn-outline-danger" <?= $row['status']==='CANCELLED'?'disabled':'' ?>>Cancel</button>
            </form>
          </td>
        </tr>

        <tr>
          <td colspan="7">
            <!-- Pindahkan .collapse ke DIV di dalam TD -->
            <div id="<?= $collapseId ?>" class="collapse">
              <form class="row g-2" method="post" action="/admin/bookings/<?= $pnrUrl ?>/update">
                <?= csrf_field() ?>
                <div class="col-md-3">
                  <input class="form-control" name="contactName"  placeholder="Name"  value="<?= esc($row['contactName'] ?? '') ?>">
                </div>
                <div class="col-md-3">
                  <input class="form-control" name="contactEmail" placeholder="Email" value="<?= esc($row['contactEmail'] ?? '') ?>">
                </div>
                <div class="col-md-3">
                  <input class="form-control" name="contactPhone" placeholder="Phone" value="<?= esc($row['contactPhone'] ?? '') ?>">
                </div>
                <div class="col-md-3">
                  <button class="btn btn-primary">Save</button>
                </div>
              </form>
            </div>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <!-- Pagination -->
  <nav class="d-flex justify-content-between align-items-center mt-2">
    <div>Page <?= $page+1 ?>/<?= max(1,$totalPages) ?></div>
    <div class="btn-group">
      <button class="btn btn-outline-secondary"
              hx-get="/admin/bookings/search"
              hx-target="#list"
              hx-include="#form-admin-search"
              hx-vals='{"page":"<?= max(0,$page-1) ?>"}'
              <?= $page<=0?'disabled':'' ?>>« Prev</button>
      <button class="btn btn-outline-secondary"
              hx-get="/admin/bookings/search"
              hx-target="#list"
              hx-include="#form-admin-search"
              hx-vals='{"page":"<?= min($totalPages-1,$page+1) ?>"}'
              <?= ($page >= $totalPages-1)?'disabled':'' ?>>Next »</button>
    </div>
  </nav>
<?php endif; ?>
