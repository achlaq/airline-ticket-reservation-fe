<div class="row justify-content-center">
    <div class="col-md-10 col-lg-8">
        <h1 class="mb-4">Manage Your Booking</h1>
        
        <div hx-get="/bookings/ajax_details/<?= esc($pnr) ?>" 
             hx-trigger="load" 
             hx-indicator="#loading-spinner">
            
            <!-- Loading Spinner -->
            <div id="loading-spinner" class="text-center p-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-2">Loading booking details...</p>
            </div>

            <!-- Booking details will be loaded here -->
        </div>
    </div>
</div>
