const loginClose = document.querySelector(".login-close");
const signupClose = document.querySelector(".signup-close");
const loginForm = document.querySelector(".login-form");
const signupForm = document.querySelector(".signup-form");
const toggleScrollButton = document.getElementById("toggleScroll");
const navbar = document.querySelector(".navbar");
const language = document.querySelector('.language');
const shoppingCart = document.querySelector('.shopping-cart');

let goingToTop = true;

document.body.addEventListener('click', function(event) {
    if (event.target.id === 'cart-btn') {
        shoppingCart.classList.toggle("active");
        navbar.classList.remove("active");
        loginForm.classList.remove("active");
        signupForm.classList.remove("active");
        language.classList.remove("active");
    }
});

document.addEventListener('DOMContentLoaded', () => {
    const successMessage = "{{ session('success') }}";
    const successModal = document.getElementById('success-modal');
    const closeModal = document.getElementById('close-modal');

    if (successMessage) {
        successModal.style.display = 'block';
    }

    closeModal.onclick = function() {
        successModal.style.display = 'none';
    }

    window.onclick = function(event) {
        if (event.target === successModal) {
            successModal.style.display = 'none';
        }
    }
    
    document.querySelector('#signupnow').onclick = (event) => {
        if (validateSignupForm(event)) {
            signupForm.submit();
        }
    };
});

document.addEventListener('DOMContentLoaded', () => {
    if (document.body.dataset.loginRequired === 'true') {
        loginForm.classList.add('active');
    }

    document.querySelector('#toggler').onclick = () => {
        navbar.classList.toggle('active');
        loginForm.classList.remove('active');
        signupForm.classList.remove('active');
        language.classList.remove('active');
        shoppingCart.classList.remove('active');
    };

    document.querySelector('#language-btn').onclick = () => {
        language.classList.toggle("active");
        navbar.classList.remove("active");
        loginForm.classList.remove("active");
        signupForm.classList.remove("active");
        shoppingCart.classList.remove("active");
    };    

    document.querySelector('#login-btn').onclick = () => {
        resetErrorMessages(loginForm);
        loginForm.classList.add("active");
        navbar.classList.remove("active");
        signupForm.classList.remove("active");
        language.classList.remove("active");
        shoppingCart.classList.remove("active");
    };

    document.querySelector('#login').onclick = () => {
        loginForm.classList.add("active");
        signupForm.classList.remove("active");
        language.classList.remove("active");
        navbar.classList.remove("active");
        resetErrorMessages(loginForm);
    };

    document.querySelector('#loginnow').onclick = (event) => {
        validateLoginForm(event);
    };

    document.querySelector('#signup').onclick = () => {
        resetErrorMessages(signupForm);
        signupForm.classList.add("active");
        loginForm.classList.remove("active");
        language.classList.remove("active");
        navbar.classList.remove("active");
    };

    document.getElementById('loginnow').addEventListener('click', showLoginForm);
    function showLoginForm() {
        loginForm.classList.add('active');
    }

    document.getElementById('signupnow').addEventListener('click', showSignupForm);
    function showSignupForm() {
        signupForm.classList.add('active');
    }

    loginClose.addEventListener('click', closeLoginForm);
    signupClose.addEventListener('click', closeSignupForm);

    toggleScrollButton.onclick = () => {
        if (goingToTop) {
            window.scrollTo({ top: 0, behavior: 'smooth' });
            toggleScrollButton.textContent = "Back to Bottom";
        } else {
            window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
            toggleScrollButton.textContent = "Back to Top";
        }
        goingToTop = !goingToTop;
    };

    // window.onscroll = hideAllForms;
});

function closeLoginForm() {
    loginForm.classList.remove("active");
    resetErrorMessages(loginForm);
}

function closeSignupForm() {
    signupForm.classList.remove("active");
    resetErrorMessages(signupForm);
}

function showLoginForm() {
    signupForm.classList.remove("active");
    loginForm.classList.add("active");
}

function showSignupForm() {
    loginForm.classList.remove("active");
    signupForm.classList.add("active");
}

function hideAllForms() {
    navbar.classList.remove('active');
    loginForm.classList.remove('active');
    signupForm.classList.remove('active');
    language.classList.remove('active');
}

function validateLoginForm(e) {
    const login = document.querySelector('.loginForm');
    const emailInput = document.querySelector('input[name="user_email"]');
    const passwordInput = document.querySelector('input[name="user_password"]');
    const emailError = document.querySelector('.error-message.user_email');
    const passwordError = document.querySelector('.error-message.user_password');

    resetErrorMessages(login);

    let hasError = false;

    if (!emailInput.value) {
        emailError.textContent = 'Email is required.';
        emailError.style.display = 'block';
        hasError = true;
    }
    if (!passwordInput.value) {
        passwordError.textContent = 'Password is required.';
        passwordError.style.display = 'block';
        hasError = true;
    }

    if (hasError) {
        login.classList.add('active');
    } else {
        login.classList.remove('active');
    }
    return !hasError;
}

function validateSignupForm(e) {
    e.preventDefault();
    const signup = document.querySelector('.signupForm');
    const nameInput = document.querySelector('input[name="name"]');
    const emailInput = document.querySelector('input[name="email"]');
    const passwordInput = document.querySelector('input[name="password"]');
    const confirmPasswordInput = document.querySelector('input[name="password_confirmation"]');
    const checkbox = document.querySelector('input[name="terms"]');
    const nameError = document.querySelector('.error-message.name');
    const emailError = document.querySelector('.error-message.email');
    const passwordError = document.querySelector('.error-message.password');
    const confirmPasswordError = document.querySelector('.error-message.password_confirmation');
    const termsError = document.querySelector('.error-message.terms');

    resetErrorMessages(signup);

    let hasError = false;

    if (!nameInput.value) {
        nameError.textContent = 'Username is required.';
        nameError.style.display = 'block';
        hasError = true;
    }
    if (!emailInput.value) {
        emailError.textContent = 'Email is required.';
        emailError.style.display = 'block';
        hasError = true;
    }
    if (!passwordInput.value) {
       passwordError.textContent = 'Password is required.';
        passwordError.style.display = 'block';
        hasError = true;
    }
    if (!checkbox.checked) {
        termsError.textContent = 'You must agree to the terms.';
        termsError.style.display = 'block';
        hasError = true;
    }

    if (hasError) {
        signup.classList.add('active');
    } else {
        signup.classList.remove('active');
    }
    if (!hasError) {
        signup.submit();
    }
    return !hasError;
}

function resetErrorMessages(form) {
    form.querySelectorAll('.error-message').forEach((errorMessage) => {
        errorMessage.textContent = '';
        errorMessage.style.display = 'none';
    });
}

$(document).ready(function () {
    var formFields = $('.input-box');

    formFields.each(function () {
        var field = $(this);
        var input = field.find('select');
        var label = field.find('.select-label'); // Correct class selector

        function checkOptions() {
            console.log('Current value:', input.val()); // Debugging
            if (input.val()) {
                label.addClass('active');
            } else {
                label.removeClass('active');
            }
        }

        // Initial check on page load
        checkOptions();

        // Handle change event
        input.change(function () {
            console.log('Select changed:', input.val()); // Debugging
            checkOptions();
        });

        // Focus and blur events
        input.on("focus", function () {
            label.addClass('active');
        }).on("focusout", function () {
            checkOptions();
        });
    });
});