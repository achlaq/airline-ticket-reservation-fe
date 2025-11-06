<div class="card">
  <div class="card-header">Search Flight</div>
  <div class="card-body">
    <form id="form-search" hx-get="/flights/search" hx-target="#results" class="row g-3">
      <div class="col-md-3">
        <label class="form-label">From</label>
        <input name="origin" class="form-control" placeholder="CGK" required>
      </div>
      <div class="col-md-3">
        <label class="form-label">To</label>
        <input name="dest" class="form-control" placeholder="DPS" required>
      </div>
      <div class="col-md-3">
        <label class="form-label">Date</label>
        <input type="date" name="date" class="form-control" required>
      </div>
      <div class="col-md-3 d-flex align-items-end">
        <button class="btn btn-primary w-100">Search</button>
      </div>
    </form>
  </div>
</div>

<div id="results" class="mt-3"></div>
