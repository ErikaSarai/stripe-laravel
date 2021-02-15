<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/album/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
  </head>
  <body>
    
  <header>
  <div class="collapse bg-dark" id="navbarHeader">
    <div class="container">
      <div class="row">
        <div class="col-sm-8 col-md-7 py-4">
          <h4 class="text-white">About</h4>
          <p class="text-muted">Add some information about the album below, the author, or any other background context. Make it a few sentences long so folks can pick up some informative tidbits. Then, link them off to some social networking sites or contact information.</p>
        </div>
        <div class="col-sm-4 offset-md-1 py-4">
          <h4 class="text-white">Contact</h4>
          <ul class="list-unstyled">
            <li><a href="https://getbootstrap.com/docs/4.3/examples/album/#" class="text-white">Follow on Twitter</a></li>
            <li><a href="https://getbootstrap.com/docs/4.3/examples/album/#" class="text-white">Like on Facebook</a></li>
            <li><a href="https://getbootstrap.com/docs/4.3/examples/album/#" class="text-white">Email me</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container d-flex justify-content-between">
      <a href="https://getbootstrap.com/docs/4.3/examples/album/#" class="navbar-brand d-flex align-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="mr-2" viewBox="0 0 24 24" focusable="false"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
        <strong>Laravel Stripe</strong>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </div>
</header>

<main role="main">


  <div class="album py-5 bg-light">
    <div class="container">

      <div class="row">
      <div class="col-md-12">
        <h1>Productos</h1>
      </div>

        @foreach($product as $item)
        {{-- {{dd($item)}} --}}
            <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>{{ $item->name }}</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">{{ $item->name }}</text></svg>
                <div class="card-body">
                <p class="card-text">Descripcion del producto: <b>{{ $item->description }}</b></p>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                    <a href="" class="btn btn-sm btn-outline-secondary pay" data-prod="{{ $item->id }}">Comprar</a>
                    </div>
                </div>
                </div>
            </div>
            </div>
        @endforeach
      </div>
    </div>
  </div>
</main>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>

  <script type="text/javascript">

   (function(){

    // Create an instance of the Stripe object with your publishable API key
    var stripe = Stripe    ("pk_test_51IF2tuHGNaMt5HmwCL5czoE2qyP9fx3bBh6jFnL6gfroAyNRqV9CENVeeLAPPT29Yf9wLLkqDc0evXAJJHRpIqB700xC5ewrdW");
    var checkoutButton = document.getElementById("checkout-button");
    $(".pay").click(function(e) {
      stripe.redirectToCheckout({
        items: [{prod: $(this).data('prod'), quantity: 1}],


        success_url => 'https://your-website.com/success',
        cancel_url => 'https://your-website.com/cancel',
 
      })
        .then(function (response) {
          return response.json();
        })
        .then(function (session) {
          return stripe.redirectToCheckout({ sessionId: session.id });
        })
        .then(function (result) {
          // If redirectToCheckout fails due to a browser or network
          // error, you should display the localized error message to your
          // customer using error.message.
          if (result.error) {
            alert(result.error.message);
          }
        })
        .catch(function (error) {
          console.error("Error:", error);
        });
        });
      });
    });

   
  </script>
</x-app-layout>
