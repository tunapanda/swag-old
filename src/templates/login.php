<h1>Tunapanda Swag</h1>

Please let us know who you are.<br/><br/>

<?php if ($message) { ?>
	<i><?php echo $message; ?></i><br/><br/>
<?php } ?>

<?php if ($showlogin) { ?>
	<form method="post" action="main/login">
		Username: <input type="text" name="username"/><br/>
		Password: <input type="password" name="password"/><br/>
		<input type="submit" value="Login"/>
	</form>
<?php } ?>

<?php if ($showfacebook) { ?>
	<a href="main/hybridlogin?provider=Facebook" class="zocial facebook">Sign in with Facebook</a>
<?php } ?>