<!-- Amaclone -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand ml-2" href="frontShop.php">AMACLONE.co.uk</a>
</nav>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <!-- Shop by Department -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Shop by Department
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="books.php">Books</a>
          <a class="dropdown-item" href="magazines.php">Magazines</a>
          <a class="dropdown-item" href="comics.php">Comics</a>
        </div>
      </li>
    </ul>
<!-- Searchbar -->
    <form class="form-inline my-2 my-lg-0 mx-auto w-50" method="get"  action='shop.php'>
      <input class="form-control mr-sm-2 w-75" type="search" name="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
    </form>


      <!-- Sign in -->

        <div class="d-flex justify-content-end">

          <ul class="navbar-nav mr-auto px-2">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Sign in / Log out
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="registration.php">Sign Up</a>
              <a class="dropdown-item" href="login.php">Sign In</a>
              <a class="dropdown-item" href="logout.php">Log Out</a>
            </div>
          </li>



      <!-- Orders -->

          <li class="nav-item px-4 text-white" >
            <a class="nav-link text-white" href="orders.php" id="orders">Orders</a>
          </li>

      <!-- Basket -->

          <li class="nav-item dropdown px-2 text-white" id="basket">
            <a class="nav-link dropdown-toggle text-white" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="basket">
              <i class="fa fa-shopping-cart text-white" aria-hidden="true" id="basket"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink" id="cart">
              <a class="dropdown-item" href="cart.php">My Cart</a>
              <a class="dropdown-item" href="checkout.php">Go to Checkout</a>
            </div>
          </li>

      </ul>
  </div>
</div>
</nav>
