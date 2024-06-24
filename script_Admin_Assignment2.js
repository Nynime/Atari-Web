const slidePage = document.querySelector(".slide-page");
const nextBtnFirst = document.querySelector(".firstNext");
const prevBtnSec = document.querySelector(".prev-1");
const nextBtnSec = document.querySelector(".next-1");
const prevBtnThird = document.querySelector(".prev-2");
const nextBtnThird = document.querySelector(".next-2");
const prevBtnFourth = document.querySelector(".prev-3");
const submitBtn = document.querySelector(".submit");
const progressText = document.querySelectorAll(".step p");
const progressCheck = document.querySelectorAll(".step .check");
const bullet = document.querySelectorAll(".step .bullet");
let current = 1;

function validateEmail(email) {
  const input = document.createElement('input');
  input.type = 'email';
  input.value = email;
  return input.checkValidity();
}

function validatePage() {
  const currentPage = document.querySelector(`.page:nth-child(${current})`);
  const inputs = currentPage.querySelectorAll('input[required], select[required]');
  for (let input of inputs) {
    if (!input.value.trim()) {
      console.log("Validation failed on input:", input);
      return false;
    }
    if (input.type === 'email' && !validateEmail(input.value.trim())) {
      console.log("Invalid email format:", input);
      return false;
    }
  }
  return true;
}

function updateUI(step) {
  console.log(`Updating UI to step ${step}`);
  bullet[current - 1].classList.add("active");
  progressCheck[current - 1].classList.add("active");
  progressText[current - 1].classList.add("active");
}

function handleNext(event) {
  event.preventDefault();
  console.log(`Next button clicked on step ${current}`);
  if (validatePage()) {
    slidePage.style.marginLeft = `-${25 * current}%`;
    updateUI(current + 1);
    current += 1;
  } else {
    alert("Please fill in all required fields with valid information.");
  }
}

function handlePrevious(event) {
  event.preventDefault();
  console.log(`Previous button clicked on step ${current}`);
  slidePage.style.marginLeft = `-${25 * (current - 2)}%`;
  bullet[current - 2].classList.remove("active");
  progressCheck[current - 2].classList.remove("active");
  progressText[current - 2].classList.remove("active");
  current -= 1;
}

nextBtnFirst.addEventListener("click", handleNext);
nextBtnSec.addEventListener("click", handleNext);
nextBtnThird.addEventListener("click", handleNext);

prevBtnSec.addEventListener("click", handlePrevious);
prevBtnThird.addEventListener("click", handlePrevious);
prevBtnFourth.addEventListener("click", handlePrevious);

submitBtn.addEventListener("click", function(event){
  event.preventDefault();
  console.log("Submit button clicked");
  if (validatePage()) {
    updateUI(5);
    const formData = new FormData(document.querySelector('form'));
    fetch('register_admin.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.text())
    .then(data => {
      console.log("Response from server:", data);
      if (data.trim() === "success") {
        alert("Your Form Successfully Signed up");
        window.location.href = "A1-Dashboard-Admin.html";
      } else {
        alert("There was an error with the submission. Please try again. Server response: " + data);
      }
    })
    .catch(error => {
      console.error('Error:', error);
      alert("There was an error with the submission. Please try again.");
    });
  } else {
    alert("Please fill in all required fields.");
  }
});

document.addEventListener("keydown", function(event) {
  if (event.key === "Enter") {
    event.preventDefault();
    if (current === 4) {
      submitBtn.click();
    } else {
      const nextBtn = document.querySelector(`.page:nth-child(${current}) .next`);
      if (nextBtn) {
        nextBtn.click();
      }
    }
  }
});
