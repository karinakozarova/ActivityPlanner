function vizualiseError(elementId) {
    let element = document.getElementById(elementId);
    element.classList.remove("hidden");
}

function hideError(elementId) {
    let element = document.getElementById(elementId);
    element.classList.add("hidden");
}

function validateEmail(email) {
    let re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function validateForm() {
    // check all fields are populated
    let inputs, index;
    inputs = document.getElementsByTagName('input');
    for (index = 0; index < inputs.length; ++index) {
        if (inputs[index].value === "") {
            vizualiseError('populatedFieldsError');
            return false;
        }
    }
    hideError('populatedFieldsError');

    // check passwords match
    let password1 = document.getElementById('password');
    let password2 = document.getElementById('confirmPassword');

    if (password1.value !== password2.value) {
        vizualiseError('passwordsMatchError');
        return false;
    } else {
        hideError('passwordsMatchError');
    }

    let username = document.getElementById('username');
    if (String(password1.value).indexOf(username.value) !== -1)
    {
        vizualiseError('passwordUsernameError');
        return false;
    } else {
        hideError('passwordUsernameError')
    }

    let email = document.getElementById('email');
    // check email is valid
    if (!validateEmail(email.value)) {
        vizualiseError('validMailError');
        return false;
    } else {
        hideError('validMailError');
    }

    return true;
}
