<?php 
    include 'config.php';
?>
<style>
    /* Header Styling */
    header {
        background-color: #f8f9fa;
        padding: 20px 0;
        text-align: center;
        border-bottom: 2px solid #ddd;
    }

    header h1 {
        font-size: 28px;
        font-weight: bold;
        color: #333;
        margin: 0;
    }

    nav {
        margin-top: 10px;
    }

    nav a {
        text-decoration: none;
        color: #007bff;
        margin: 0 15px;
        font-weight: 500;
    }

    nav a:hover {
        text-decoration: underline;
    }
</style>
<header>
    <h1>LitHub Books</h1>
    <nav>
        <a href="<?php echo BASE_URL ?>/index.php">Home</a> |
        <a href="<?php echo BASE_URL ?>/profile.php">Profile</a> |
        <a href="<?php echo BASE_URL ?>/cart.php">Cart</a> |
        <?php 
            if(!isset($_SESSION['user_id'])) {            
                echo "<a href='" . BASE_URL . "/login.php'>Login</a> | <a href='" . BASE_URL . "/register.php'>Register</a>";
            } else {                
                echo "<a href='" . BASE_URL . "/admin/index.php'>Admin</a> | ";
                echo "<a href='" . BASE_URL . "/logout.php'>Logout</a>";
            }
        ?>        
    </nav>
</header>