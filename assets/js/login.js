const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');
const showpBtn = document.querySelector('.sign-up-btn');
// const hideBtn1 = document.querySelector('.close-btnX1');
// const hideBtn2 = document.querySelector('.close-btnX2');


// mo sign in

showpBtn.addEventListener("click", () =>{
    document.body.classList.toggle("show-popup");
});

hideBtn1.addEventListener("click", () => {
    document.body.classList.remove("show-popup");
});

hideBtn2.addEventListener("click", () => {
    document.body.classList.remove("show-popup");
});


// chuyen sign up voi sign in
registerBtn.addEventListener('click', () => {
    container.classList.add("active");
});

loginBtn.addEventListener('click', () => {
    container.classList.remove("active");
});