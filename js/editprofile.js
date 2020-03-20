function visualizeError(elementId) {
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

function validateImage(image) {
    var filePath = image.value;
    if(filePath != "")
    {
        let fileExt = filePath.substring(filePath.lastIndexOf('.') + 1).toLowerCase();
        if(image.files && image.files[0])
        {
            if(fileExt == "jpg" || fileExt == "jpeg" || fileExt == "png")
            {
                let fileSize = image.files[0].size;
                if(fileSize > 512000)
                {
                    visualizeError('imageUploadError');
                    document.getElementById('uploadErrorMessage').innerHTML = "Maximum file size is 500kb";
                    return false;
                }
                else
                {
                    document.getElementById('settings-profilepic').src = window.URL.createObjectURL(image.files[0])
                    return true;
                }
            }
            else
            {
                visualizeError('imageUploadError');
                document.getElementById('uploadErrorMessage').innerHTML = "Your profile picture needs to be of file type jpg, jpeg or png";
                return false;
            }
        }
    }
    hideError('imageUploadError');
    return true;
}

function validateForm() {
    let inputs, index;
    inputs = document.getElementsByTagName('input');
    for (index = 0; index < inputs.length; ++index) {
        if (inputs[index].value === "" && inputs[index].type != "file") {
            visualizeError('populatedFieldsError');
            inputs[index].style.borderColor = "#c20e0e";
            inputs[index].style.borderWidth = "2px";
            inputs[index].focus();
            return false;
        }
        else {
            inputs[index].style.borderWidth = "1px";
            inputs[index].style.borderColor = "#999999";
        }
    }
    hideError('populatedFieldsError');

    let email = document.getElementById('email');
    // check email is valid
    if (!validateEmail(email.value)) {
        visualizeError('validMailError');
        email.style.borderColor = "#c20e0e";
        email.style.borderWidth = "2px";
        return false;
    } else {
        hideError('validMailError');
        email.style.borderColor = "#999999";
        email.style.borderWidth = "1px";
    }
    alert("Settings saved successfully");
    return true;
}

function validateFileUpload()
{
    let file = document.getElementById('profilepic');
    if(validateImage(file))
    {
        hideError('imageUploadError');
        return true;
    }
    else return false;
}
