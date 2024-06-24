<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <link rel="stylesheet" href="style_Assignment2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>
<body>
    <div class="container">
        <header>Registration Form</header>
        <div class="progress-bar">
            <div class="step">
                <p>Name</p>
                <div class="bullet">
                    <span>1</span>
                </div>
                <div class="check fas fa-check"></div>
            </div>
            <div class="step">
                <p>Contact</p>
                <div class="bullet">
                    <span>2</span>
                </div>
                <div class="check fas fa-check"></div>
            </div>
            <div class="step">
                <p>Birth</p>
                <div class="bullet">
                    <span>3</span>
                </div>
                <div class="check fas fa-check"></div>
            </div>
            <div class="step">
                <p>Submit</p>
                <div class="bullet">
                    <span>4</span>
                </div>
                <div class="check fas fa-check"></div>
            </div>
        </div>
        <div class="form-outer">
            <form id="registration-form" onsubmit="submitRegistrationForm(event)">
                <div class="page slide-page">
                    <div class="title">Basic Info:</div>
                    <div class="field">
                        <div class="label">First Name</div>
                        <input type="text" name="first_name" id="first_name" pattern="[A-Za-z\s]+" required>
                    </div>
                    <div class="field">
                        <div class="label">Last Name</div>
                        <input type="text" name="last_name" id="last_name" pattern="[A-Za-z\s]+" required>
                    </div>
                    <div class="field">
                        <button class="firstNext next">Next</button>
                    </div>
                    <div><a href="index_Admin_Assignment2.html">Register as Admin</a></div>
                </div>
                <div class="page">
                    <div class="title">Contact Info:</div>
                    <div class="field">
                        <div class="label">Email Address</div>
                        <input type="email" name="email" id="email" required>
                    </div>
                    <div class="field">
                        <div class="label">Phone Number</div>
                        <input type="text" name="phone_number" id="phone_number" required>
                    </div>
                    <div class="field btns">
                        <button class="prev-1 prev">Previous</button>
                        <button class="next-1 next">Next</button>
                    </div>
                </div>
                <div class="page">
                    <div class="title">Date of Birth:</div>
                    <div class="field">
                        <div class="label">Date</div>
                        <input type="date" name="date_of_birth" id="date_of_birth" required>
                    </div>
                    <div class="field">
                        <div class="label">Gender</div>
                        <select name="gender" id="gender" required>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="field btns">
                        <button class="prev-2 prev">Previous</button>
                        <button class="next-2 next">Next</button>
                    </div>
                </div>
                <div class="page">
                    <div class="title">Login Details:</div>
                    <div class="field">
                        <div class="label">Username</div>
                        <input type="text" name="username" id="username" required>
                    </div>
                    <div class="field">
                        <div class="label">Password</div>
                        <div class="password-toggle">
                            <input type="password" name="password" id="password" required 
                                   pattern="(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*]).{6,}" 
                                   title="Password must be at least 6 characters long, contain one uppercase letter, one number, and one special character.">
                            <span class="toggle-password" onclick="togglePasswordVisibility(this)">Show</span>
                        </div>
                    </div>
                    <div class="field btns">
                        <button class="prev-3 prev">Previous</button>
                        <button class="submit" type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="script_public.js"></script>
    <script>
        function validateForm() {
            const password = document.getElementById('password').value;
            const passwordPattern = /^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*]).{6,}$/;
            
            if (!passwordPattern.test(password)) {
                alert('Password must be at least 6 characters long, contain one uppercase letter, one number, and one special character.');
                return false;
            }
            
            return true;
        }

        function submitRegistrationForm(event) {
            event.preventDefault();
            const form = document.getElementById('registration-form');
            const formData = new FormData(form);

            fetch('register_process.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    localStorage.setItem('user', JSON.stringify(data.user));
                    window.location.href = 'checkout_public.php';
                } else {
                    alert('Registration failed. Please try again.');
                }
            });
        }
        
        function togglePasswordVisibility(element) {
            const passwordInput = document.getElementById('password');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                element.textContent = 'Hide';
            } else {
                passwordInput.type = 'password';
                element.textContent = 'Show';
            }
        }
    </script>
</body>
</html>
