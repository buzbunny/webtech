<!DOCTYPE html>
<html>
<head>
    <title>Login and Sign-up</title>
    <!-- SweetAlert library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="login_style.css" />
</head>
<body>
    <div class="cotn_principal">
        <div class="cont_centrar">
            <div class="cont_login">
                <div class="cont_info_log_sign_up">
                    <div class="col_md_login">
                        <div class="cont_ba_opcitiy">
                            <h2>LOGIN</h2>  
                            <p>Already have an account?</p> 
                            <button class="btn_login" onclick="change_to_login()">LOGIN</button>
                        </div>
                    </div>
                    <div class="col_md_sign_up">
                        <div class="cont_ba_opcitiy">
                            <h2>SIGN UP</h2>
                            <p>Don't have an account?</p>
                            <button class="btn_sign_up" onclick="change_to_sign_up()">SIGN UP</button>
                        </div>
                    </div>
                </div>
                <div class="cont_back_info">
                    <div class="cont_img_back_grey">
                        <img src="https://images.unsplash.com/42/U7Fc1sy5SCUDIu4tlJY3_NY_by_PhilippHenzler_philmotion.de.jpg?ixlib=rb-0.3.5&q=50&fm=jpg&crop=entropy&s=7686972873678f32efaf2cd79671673d" alt="" />
                    </div>
                </div>
                <div class="cont_forms">
                    <div class="cont_img_back_">
                        <img src="https://images.unsplash.com/42/U7Fc1sy5SCUDIu4tlJY3_NY_by_PhilippHenzler_philmotion.de.jpg?ixlib=rb-0.3.5&q=50&fm=jpg&crop=entropy&s=7686972873678f32efaf2cd79671673d" alt="" />
                    </div>
                    <form id="loginForm" onsubmit="return validateLoginForm()" method="post" action="../login_submit.php">
                        <div class="cont_form_login">
                            <a href="#" onclick="hidden_login_and_sign_up()"><i class="material-icons">&#xE5C4;</i></a>
                            <h2>LOGIN</h2>
                            <input type="text" class="form-control" name="email" id="loginEmail" placeholder="Email" required />
                            <input type="password" class="form-control" name="password" id="loginPassword" placeholder="Password (min. 8 characters)" required />
                            <button type="submit" class="btn_login">LOGIN</button>
                        </div>
                    </form>
                    <form id="signupForm" onsubmit="return validateSignupForm()" method="post" action="../user_registration_script.php">
                        <div class="cont_form_sign_up">
                            <a href="#" onclick="hidden_login_and_sign_up()"><i class="material-icons">&#xE5C4;</i></a>
                            <h2>SIGN UP</h2>
                            <input type="text" class="form-control" name="email" id="signupEmail" placeholder="Email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" />
                            <input type="text" class="form-control" name="name" id="signupName" placeholder="User" required />
                            <input type="password" class="form-control" name="password" id="signupPassword" placeholder="Password (min. 8 characters)" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" />
                            <input type="password" class="form-control" name="confirmpassword" id="signupConfirmPassword" placeholder="Confirm Password" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" />
                            <input type="tel" class="form-control" name="contact" id="signupContact" placeholder="Contact" required />
                            <input type="text" class="form-control" name="city" id="signupCity" placeholder="City" required />
                            <input type="text" class="form-control" name="address" id="signupAddress" placeholder="Address" required />
                            <button type="submit" class="btn_sign_up">SIGN UP</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="login_script.js"></script>
</body>
</html>
