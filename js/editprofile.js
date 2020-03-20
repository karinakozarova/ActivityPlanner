function visualizeError(elementID)
{
    let element = document.getElementById(elementId);
    element.classList.remove("hidden");
}

function hideError(elementID)
{
    let element = document.getElementById(elementId);
    element.classList.add("hidden");
}


function validateEmail(email) {
    let re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function validateForm() {
    alert("I work");
    let inputs, index;
    inputs = document.getElementsByTagName('input');
    for (index = 0; index < inputs.length; ++index) {
        if (inputs[index].value === "") {
            vizualiseError('populatedFieldsError');
            inputs[index].style.borderColor = "#c20e0e";
            return false;
        }
    }
    hideError('populatedFieldsError');

    let email = document.getElementById('email');
    // check email is valid
    if (!validateEmail(email.value)) {
        visualizeError('validMailError');
        email.style.borderColor = "#c20e0e";
        return false;
    } else {
        hideError('validMailError');
        email.style.borderColor = "#999999";
    }
    return true;
}

fuction test()
{
    alert("Working?");
    return false;
}
