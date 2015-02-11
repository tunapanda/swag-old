<form method="post" action="main/login">
	<?php if ($message) { ?>
		<i><?php echo $message; ?></i><br/>
	<?php } ?>
	Username: <input type="text" name="username"/><br/>
	Password: <input type="password" name="password"/><br/>
	<input type="submit" value="Login"/>
</form>