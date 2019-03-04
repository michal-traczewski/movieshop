<nav class="navbar navbar-inverse navbar-fixed-top">
    <div id="navbar-inner">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Buy Movies Online</a>
            </div>
            <ul class="nav navbar-nav">
                <?php if (!isset($nav_selection)): ?>
                    <?php $nav_selection = ''; ?>
                <?php endif ?>
                <li class="<?= $nav_selection == 'home' ? 'active' : '' ?>"><a href="/">Home</a></li>
                @if (Auth::check())
                    <li class="<?= $nav_selection == 'myorders' ? 'active' : '' ?>"><a href="/myorders">My orders</a></li>
                    <li class="<?= $nav_selection == 'cart' ? 'active' : '' ?> "><a href="/myorders/cart">My cart</a></li>
                    <li class="<?= $nav_selection == 'profile' ? 'active' : '' ?> "><a href="/profile">Edit profile</a></li>
                    <li class="<?= $nav_selection == 'logout' ? 'active' : '' ?> "><a href="/logout">Log out</a></li>
                @else
                    <li class="<?= $nav_selection == 'login' ? 'active' : '' ?> "><a href="/login">Log in</a></li>
                    <li class="<?= $nav_selection == 'register' ? 'active' : '' ?> "><a href="/register">Register</a></li>
                @endif
            </ul>
            <form class="navbar-form navbar-right" action="" method="GET">
                <input type="text" class="form-control" placeholder="Search" name="searchPhrase" value="<?=$searchPhrase?>">
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
    </div>
</nav>
