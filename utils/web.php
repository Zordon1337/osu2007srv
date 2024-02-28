<?php
function DrawNavbar($server_name)
{
    session_start();
    include_once('db.php');
    $username = $_SESSION['username'];
    echo "
    <div id='navbar'>
    <div id='navbar-content'>
    <p>$server_name</p>
        <a href='/'>
            <button id='searchButton'>Home</button>
        </a>
        <a href='/leaderboard.php'>
            <button id='searchButton'>Leaderboard</button>
        </a>
        <a href='/register.php'>
            <button id='searchButton'>Register</button>
        </a>
        ";
        if(!CheckIfLoggedIn())
        {
            echo "
            <a href='/login.php'>
            <button id='searchButton'>Login</button>
            </a>";
        } else {
            
            
            echo "
            <a href='/logout.php'>
            <button id='searchButton'>Log out</button>
            </a>";
            echo "<a href='/profile-settings.php' style='text-align: right;'>$username</a>";
        }
        echo "
    </div>
    </div>
    ";
}
?>