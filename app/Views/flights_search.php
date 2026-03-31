<div class="row justify-content-center">
    <div class="col-md-10 col-lg-8">
        <div class="text-center mb-4">
            <h1 class="display-4">Find Your Next Adventure</h1>
            <p class="lead">Search for domestic and international flights at the best prices.</p>
        </div>

        <div class="card shadow-sm" style="border-radius: 1rem;">
            <div class="card-body p-4 p-md-5">
                <h5 class="card-title mb-4">Search Flights</h5>
                <form id="form-search" 
                      hx-get="/flights/search" 
                      hx-target="#results" 
                      hx-indicator="#spinner"
                      class="row g-3">

                    <div class="col-12 col-md-6">
                        <label for="origin" class="form-label">From</label>
                        <div class="input-group">
                            <span class="input-group-text">🛫</span>
                            <input id="origin" name="origin" class="form-control" placeholder="e.g., CGK" required>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="dest" class="form-label">To</label>
                        <div class="input-group">
                             <span class="input-group-text">🛬</span>
                            <input id="dest" name="dest" class="form-control" placeholder="e.g., DPS" required>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="date" class="form-label">Departure Date</label>
                        <input id="date" type="date" name="date" class="form-control" required>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label d-none d-md-block">&nbsp;</label> <!-- Placeholder label for alignment -->
                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            <span class="spinner-border spinner-border-sm htmx-indicator" id="spinner" role="status" aria-hidden="true"></span>
                            Search Flights
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="results" class="mt-4">
    <!-- Search results will be loaded here by HTMX -->
</div>
