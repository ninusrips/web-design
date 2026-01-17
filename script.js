const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');
const feedbackBtn = document.getElementById('feedbackBtn');
const closeFeedback = document.getElementById('closeFeedback');
const feedbackSection = document.getElementById('feedbackSection');
const feedbackLink = document.getElementById('feedbackLink'); // Link in footer or somewhere

signUpButton.addEventListener('click', () => {
    container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
    container.classList.remove("right-panel-active");
});

// Feedback Toggle
if(feedbackBtn) {
    feedbackBtn.addEventListener('click', (e) => {
        e.preventDefault();
        feedbackSection.classList.add('active');
    });
}

if(closeFeedback) {
    closeFeedback.addEventListener('click', () => {
        feedbackSection.classList.remove('active');
    });
}
