<nav class="navbar navbar-expand-lg navbar-light nav-style">
    <a class="navbar-brand text-white" href="{{url('/')}}">
            <img src="{{ URL::to('images/botlokwa.png') }}" alt="Botlokwa Health Care" width="30" height="30"
                title="Botlokwa Health Care"> Botlokwa Health Care
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav"> <!-- mr-auto removed -->
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Supplements
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('getAllSupplements') }}">All Supplements</a>
                        <?php $supplements = \App\SupplementCategory::all(); ?>
                        @foreach ($supplements as $supplement)
                            <a class="dropdown-item" href="{{ route('getSupplementCategory', ['id' => $supplement->supplement_category_id]) }}">{{ $supplement->supplement_category_name }}</a>
                        @endforeach
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Services
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <?php $services = \App\Service::all(); ?>
                        @foreach ($services as $service)
                            <a class="dropdown-item" href="{{ route('getService', ['id' => $service->id]) }}">{{ $service->service_name }}</a>
                        @endforeach
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ url('/about')}}">About Botlokwa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ url('/contact')}}">Contact</a>
                </li>

            <form class="form-inline my-2 my-lg-0" method="POST" action="{{ route('getSearchSupplements') }}">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search supplements.."
                        aria-label="Search" name="searchSupplement">
                    <button class="btn btn-outline-success my-2 my-sm-0 text-white" type="submit">Search</button>
                    {{ csrf_field() }}
                </form>
            </ul>

            <!-- right nav -->
            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item"><a href="#">
                    <a href="{{ route('getCart')}}" class="nav-link text-white">
                    <i class="fa fa-shopping-cart text-white"></i> Cart <span class="badge badge-danger"> {{ Session::has('cart') ? Session::get('cart')->totalQty : '0' }} </span></a></li>
                    </a>
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}" class="nav-link text-white">Login</a></li>
                        <li><a href="{{ url('/register') }}" class="nav-link text-white">Register</a></li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->last_name }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{ route('getAppointment')}}">Appointment</a>
                                <a class="dropdown-item" href="{{ route('getCart')}}">Cart</a>
                                <a class="dropdown-item" href="{{ route('getProfile')}}">Profile</a>
                                <a class="dropdown-item" href="#">Update Profile</a>
                                <a class="dropdown-item" href="#">Wishlist</a>
                                <a class="dropdown-item" href="{{ route('getLogout')}}">Logout</a>
                            </div>
                        </li>
                    @endif
            </ul>
            <!-- end of right nav -->
        </div>
    </nav>