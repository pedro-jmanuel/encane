<!-- Spinner Start -->
<div id="spinner" class="show position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-grow text-primary" role="status"></div>
</div>
<!-- Spinner End -->

<!-- Topbar Start -->
<div class="container-fluid bg-dark py-2 d-none d-md-flex">
    <div class="container">
        <div class="d-flex justify-content-between topbar">
            <div class="top-info">
                <small class="me-3 text-white-50"><a href="#"><i class="fas fa-map-marker-alt me-2 text-secondary"></i></a>{{$org_activa->endereco}}</small>
                <small class="me-3 text-white-50"><a href="#"><i class="fas fa-envelope me-2 text-secondary"></i></a>{{$org_activa->email}}</small>
            </div>
            <div id="note" class="text-secondary d-none d-xl-flex"><small>Ajudamos a sua empressa a crescer</small></div>
            <div class="top-link">
                <a href="" class="bg-light nav-fill btn btn-sm-square rounded-circle"><i class="fab fa-facebook-f text-primary"></i></a>
                <a href="" class="bg-light nav-fill btn btn-sm-square rounded-circle"><i class="fab fa-twitter text-primary"></i></a>
                <a href="" class="bg-light nav-fill btn btn-sm-square rounded-circle"><i class="fab fa-instagram text-primary"></i></a>
                <a href="" class="bg-light nav-fill btn btn-sm-square rounded-circle me-0"><i class="fab fa-linkedin-in text-primary"></i></a>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->
