<?php if(isset($_SESSION['login']) && $_SESSION['login'] !== '') { ?>
<p>You are already logged in as <strong><?= htmlspecialchars((string) $_SESSION['login'], ENT_QUOTES, 'UTF-8') ?></strong>.</p>
<p><a href="logout">Logout</a> to sign in with another account.</p>
<?php } else { ?>
<form action = "login2" method = "post">
      <fieldset>
        <legend>Login</legend>
        <br>
        <input type="text" name="username" placeholder="Username" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <input type="submit" name="login" value="Login">
        <br>&nbsp;
      </fieldset>
    </form>
    <h3>Register for login!</h3>
    <form action = "register" method = "post">
      <fieldset>
        <legend>Registration</legend>
        <br>
        <input type="text" name="firstname" placeholder="First name" required><br><br>
        <input type="text" name="lastname" placeholder="Last name" required><br><br>
        <input type="text" name="username" placeholder="Username" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <input type="submit" name="registration" value="Registration">
        <br>&nbsp;
      </fieldset>
    </form>
<?php } ?>
