let error = false;

/**
 * LOGIN FORM
 */
function loginForm() {
  event.preventDefault();

  let inputs = {
    email: document.forms["login"]["email"],
    password: document.forms["login"]["password"],
  };

  error = false;
  validateEmail(inputs.email);
  validatePassword(inputs.password);

  if (!error) {
    document.forms["login"].submit();
  }
}

/**
 * REGISTER FORM
 */
function registerForm() {
  event.preventDefault();
  let inputs = {
    email: document.forms["register"]["email"],
    password: document.forms["register"]["password"],
    confirmPassword: document.forms["register"]["password_confirmation"],
  };

  error = false;
  validateEmail(inputs.email);
  validatePassword(inputs.password);

  if (inputs.password.value !== inputs.confirmPassword.value) {
    setErrorFor(inputs.confirmPassword, "Password and Confirm password didnt match");
    error = true;
  }

  if (!error) {
    document.forms["register"].submit();
  }
}

/**
 * VALIDATION
 */
function validateEmail(email) {
  if (email.value == "") {
    return setErrorFor(email, "Email is required");
  }

  if (email.value.length < 12) {
    return setErrorFor(email, "Min of 12 letters");
  }

  if (email.value.length > 55) {
    return setErrorFor(email, "Max of 55 letters");
  }

  if (!emailIsValid(email.value)) {
    return setErrorFor(email, "Invalid email");
  } else {
    email.classList.remove("border-red-400");
    email.parentNode.querySelector("p").innerHTML = "";
  }

  function emailIsValid(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
  }
}

function validatePassword(password) {
  if (password.value == "") {
    return setErrorFor(password, "Password is required");
  }

  if (password.value.length < 8) {
    return setErrorFor(password, "Min of 8 characters");
  }

  if (password.value.length > 255) {
    return setErrorFor(password, "Max of 255 characters");
  } else {
    password.classList.remove("border-red-400");
    password.parentNode.querySelector("p").innerHTML = "";
  }
}

function setErrorFor(input, message) {
  input.classList.add("border-red-400");
  input.parentNode.querySelector("p").innerHTML = message;
  error = true;
}
