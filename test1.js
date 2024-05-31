
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

const login = {
    submitLoginFormHandler: event => {
        event.preventDefault();
    
        fetch(event.target.getAttribute('action'), {
            method: 'POST',
            body: new FormData(event.target)
        })
        .then(response => response.json())
        .then(this.loginOnSuccess)
    },
    loginOnSuccess: data => {

        // if (data) {
        //     let user = new User(data);
        //     document.body.appendChild(user.getInfoDiv());
        // }
        

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
    },
    loginForm: document.getElementById('login-form'),
};

login.loginForm.addEventListener('submit', login.submitLoginFormHandler);

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

class User {

    // constructor(id, name, registeredOn) {
    //     this.id = id;
    //     this.name = name;
    //     this.registeredOn = registeredOn;
    // }

    constructor({id, name, registeredOn}) {
        this.id = id;
        this.name = name;
        this.registeredOn = registeredOn;
    }

    getInfoDiv() {
        let userElement = document.createElement('div');
        userElement.innerHTML = `Hello, ${this.name}. You were registered on ${this.registeredOn}`;
        return userElement;
    }

    getDaysAfterRegistration() {
        let registeredOn = new Date(this.registeredOn);
        let today = new Date();
        let difference = today - registeredOn;
        return Math.floor(difference / (1000 * 60 * 60 * 24));
    }
}
