<nav class=" navbar  sticky-top shadow navbar-expand-lg navbar-light bg-light ">
        <div class=" container d-flex flex-row justify-content-between ">
            <div >
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a href= "home.php"><button class='btn btn-outline-dark btn-sm border-0'type="button" >All</button></a>
                </li>
                <li class="nav-item">
                    <a href= "home.php?Senior='Senior'"><button class='btn btn-outline-dark btn-sm border-0'type="button" >Senior</button></a>
                </li>
            </ul>
            </div>
            <div class="h2 text-dark">Pet Adoption</div>
            <div>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a href= "update.php?id=<?php echo $_SESSION['user'] ?>"><button class='btn btn-outline-dark btn-sm border-0'type="button" >Profile</button></a>
                </li>
                <li class="nav-item">
                    <a href= "logout.php?logout"><button class='btn btn-outline-dark btn-sm border-0'type="button" >Sign Out</button></a>
                </li>
            </ul>
            
            </div>
        </div>
</nav>