<div class="title">
    <h3>Register</h3>
</div>
<div class="form_row">
    <div class="form_label">
        <label for="username">Your username</label>
    </div>
    <div class="form_field">
        <input type="text" name="username" required class="box" id="username" onfocusout = "validateUsername()"/>
        <span class="helper-text"></span>
        <span><?php echo $usernamephpErr ?></span>
    </div>
</div>

            
<div class="form_row">
    <div class="form_label ">
        <label for="password">Your password</label>
    </div>
    <div class="form_field">
        <input type="password" name="password" required class="box" id="password" onfocusout = "validatePassword()"/>
        <span class="helper-text"></span>
        <span><?php echo $passwordphpErr ?></span>
    </div>
</div>

<div class="form_row">
    <div class="form_label">
        <label for="c_password">Confirm your password</label>
    </div>
    <div class="form_field">
        <input type="password" name="c_password" required class="box" id="c_password" onfocusout = "validateConfirmPassword()"/>
        <span class="helper-text"></span>
        <span><?php echo $c_passwordphpErr ?></span>
    </div>
</div>

<div class="form_row">
    <div class="form_label">
        <label for="image">Your profile picture</label>
    </div>
    <div class="form_field">
        <input type="file" name="image" id="image" required class="box"/>
    </div>
</div>