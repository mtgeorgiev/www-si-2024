
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

    fetch(event.target.getAttribute('action'), {
        method: 'POST',
        body: new FormData(event.target)
    })
    .then(response => response.json())
    .then(data => {
        let errorContainer = document.getElementById('form-error');
        errorContainer.innerHTML = ''; // clear possible past errors

        data.errors.forEach(error => {
            let errorElement = document.createElement('div');
            errorElement.innerText = error;
            errorContainer.appendChild(errorElement);
        });
    })
};

const submitButton = document.getElementById('login-form');
submitButton.addEventListener('submit', submitHandler);

fetch('./session.php')
    .then(response => response.json())
    .then(userData => {
        if (userData) {
            console.log(`User ${userData.name} is loggged in`);
        } else {
            console.warn('Никой не е логнат, бе!');
        }
    });
