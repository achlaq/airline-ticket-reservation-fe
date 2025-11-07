<div class="card">
  <div class="card-header">Manage Bookings</div>
  <div class="card-body">
    <form hx-get="/admin/bookings/search" hx-target="#list" class="row g-3 mb-3" id="form-admin-search">
      <div class="col-md-2">
        <label class="form-label">PNR</label>
        <input name="pnr" class="form-control" placeholder="ABC123" maxlength="8">
      </div>
      <div class="col-md-2">
        <label class="form-label">Status</label>
        <select name="status" class="form-select">
          <option value="">(Any)</option>
          <option>HOLD</option>
          <option>CONFIRMED</option>
          <option>CANCELLED</option>
        </select>
      </div>
      <div class="col-md-3">
        <label class="form-label">From</label>
        <input type="date" name="from" class="form-control">
      </div>
      <div class="col-md-3">
        <label class="form-label">To</label>
        <input type="date" name="to" class="form-control">
      </div>
      <div class="col-md-2 d-flex align-items-end">
        <button class="btn btn-primary w-100">Search</button>
      </div>
      <input type="hidden" name="page" value="0">
      <input type="hidden" name="size" value="10">
    </form>

    <div id="list">
      <div class="alert alert-secondary">Use the filter above then click Search.</div>
    </div>
  </div>
</div>
