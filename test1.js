
const onInputChanged = event => {

    let maxLength = parseInt(event.target.getAttribute('ml'));

    if (event.target.value.length > maxLength) {
        event.target.classList.add('error');
    } else {
        event.target.classList.remove('error');
    }
}

const usernameInput = document.querySelector('input[type="text"][name="username"]');

usernameInput.addEventListener('input', onInputChanged);

usernameInput.setAttribute('maxLength', Math.floor(usernameInput.getAttribute('ml') * 1.5));


const submitHandler = event => {
    event.preventDefault();
    console.log('Form submitted', event);
};

const submitButton = document.getElementById('login-form');
submitButton.addEventListener('submit', submitHandler);