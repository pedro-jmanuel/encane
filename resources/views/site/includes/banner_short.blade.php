
 
        <!-- Page Header Start -->
        <div class="container-fluid page-header py-5">
            <div class="container text-center py-5">
                <h1 class="display-2 text-white mb-4 animated slideInDown">{{ $meta_title ?? '' }}</h1>
                <nav aria-label="breadcrumb animated slideInDown">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="{{route('index')}}">Início</a></li>
                        <li class="breadcrumb-item" aria-current="page">{{ $meta_title ?? '' }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Page Header End -->
