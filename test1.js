
// const onInputChanged = event => {

//     let maxLength = parseInt(event.target.getAttribute('ml'));

//     if (event.target.value.length > maxLength) {
//         event.target.classList.add('error');
//     } else {
//         event.target.classList.remove('error');
//     }
// }

// const usernameInput = document.querySelector('input[type="text"][name="username"]');

// usernameInput.addEventListener('input', onInputChanged);

// usernameInput.setAttribute('maxLength', Math.floor(usernameInput.getAttribute('ml') * 1.5));


const submitLoginFormHandler = event => {
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

        if (!data.errors) {
            document.location = "./homepage.html";
        }
    })
};

const loginForm = document.getElementById('login-form');
loginForm.addEventListener('submit', submitLoginFormHandler);

fetch('./session.php')
    .then(response => response.json())
    .then(userData => {
        if (userData) { // user is logged in
            document.getElementById('login-form').classList.add('hidden');
            document.getElementById('logout-button').classList.remove('hidden');
        } else {
            document.getElementById('login-form').classList.remove('hidden');
            document.getElementById('logout-button').classList.add('hidden');
        }
    });

const logoutHandler = event => {
    fetch('./session.php', {
        method: 'DELETE'
    })
    .then(() => {
       document.location.reload();
    });
}

const logoutButton = document.getElementById('logout-button');
logoutButton.addEventListener('click', logoutHandler);