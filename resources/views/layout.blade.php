<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 11 Shopping cart with Stripe payment gateway</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-sm-12 col-12">
          <div class="dropdown">

              <button id="dLabel" class="btn btn-primary" type="button" data-bs-toggle="dropdown">
                  <i class="fa-solid fa-cart-shopping"></i> Cart <span class="badge bg-danger"> {{ count((array) session('cart')) }} </span>
              </button>

              <div class="dropdown-menu" aria-labelledby="dLabel">
                <div class="row total-header-section">
                  @php $total = 0 @endphp
                  @foreach((array) session('cart') as $id => $details)
                    @php $total += $details['price'] * $details['quantity'] @endphp
                  @endforeach
                   <div class="col-lg-12 col-sm-12 col-12 total-section text-right">
                      <p>Total: <span class="text-success">${{ $total }}</span></p>
                    </div>
                </div>
                @if(session('cart'))
                  @foreach(session('cart') as $id => $details)
                <div class="row cart-detail">
                  <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                    <img src="{{ asset('img') }}/{{ $details['photo'] }}"/>
                  </div>
                  <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                    <p>Product 1</p>
                    <span class="price text-success"> ${{ $details['price'] }} </span><span class="count">Quantity: {{ $details['quantity'] }} </span>
                  </div>
                </div>
                  @endforeach
                @endif
              <div class="row">
                <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                  <a href="{{ route('cart') }}" class="btn btn-primary btn-block">View all</a>
                </div>
              </div>
              </div>
            </div>
        </div>
      </div>
    </div>
    <br/>
    <div class="container">

      @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
      @endif

        @yield('content')
    </div>

    @yield('scripts')
  </body>
</html>