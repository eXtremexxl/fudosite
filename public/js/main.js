const menuBtn = document.getElementById("menu-btn");
const navLinks = document.getElementById("nav-links");
const menuBtnIcon = menuBtn.querySelector("i");

menuBtn.addEventListener("click", (e) => {
  navLinks.classList.toggle("open");

  const isOpen = navLinks.classList.contains("open");
  menuBtnIcon.setAttribute("class", isOpen ? "ri-close-line" : "ri-menu-line");
});

navLinks.addEventListener("click", (e) => {
  navLinks.classList.remove("open");
  menuBtnIcon.setAttribute("class", "ri-menu-line");
});

const scrollRevealOption = {
  distance: "50px",
  origin: "bottom",
  duration: 1000,
};

ScrollReveal().reveal(".header__image img", {
  ...scrollRevealOption,
  origin: "right",
});
ScrollReveal().reveal(".header__tag", {
  ...scrollRevealOption,
  delay: 500,
});
ScrollReveal().reveal(".header__content h1", {
  ...scrollRevealOption,
  delay: 1000,
});
ScrollReveal().reveal(".header__content .section__description", {
  ...scrollRevealOption,
  delay: 1500,
});
ScrollReveal().reveal(".header__btns", {
  ...scrollRevealOption,
  delay: 2000,
});

ScrollReveal().reveal(".service__card", {
  ...scrollRevealOption,
  interval: 500,
});

const swiper = new Swiper(".swiper", {
  slidesPerView: "auto",
  spaceBetween: 10,
});

ScrollReveal().reveal(".client__image img", {
  ...scrollRevealOption,
  origin: "left",
});
ScrollReveal().reveal(".client__content .section__subheader", {
  ...scrollRevealOption,
  delay: 500,
});
ScrollReveal().reveal(".client__content .section__header", {
  ...scrollRevealOption,
  delay: 1000,
});
ScrollReveal().reveal(".client__content .section__description", {
  ...scrollRevealOption,
  delay: 1500,
});
ScrollReveal().reveal(".client__details", {
  ...scrollRevealOption,
  delay: 2000,
});
ScrollReveal().reveal(".client__rating", {
  ...scrollRevealOption,
  delay: 2500,
});


const quotes = [
  { text: "Еда — это не просто топливо, это эмоции, искусство и вдохновение.", author: "Гай Савой" },
  { text: "Великий ресторан — это театр, в котором кухня — сцена.", author: "Чарли Троттер" },
  { text: "Гостеприимство — это когда тебя ожидают, даже если ты пришел без приглашения.", author: "У. Э. Б. Дюбуа" },
  { text: "Лучший способ сделать людей счастливыми — это вкусная еда и тёплый приём.", author: "Джоан Харрис" },
  { text: "Еда объединяет людей лучше любых слов.", author: "Жак Пепен" },
  { text: "Когда ты делаешь что-то с любовью, это всегда чувствуется… особенно в еде.", author: "Томас Келлер" },
  { text: "Настоящий шеф — это не тот, кто просто готовит, а тот, кто создаёт воспоминания.", author: "Ферран Адриа" },
  { text: "Вкусная еда и хорошая беседа — идеальный рецепт счастья.", author: "Джулия Чайлд" }
];


let index = 0;
const quoteText = document.getElementById("quote");
const quoteAuthor = document.getElementById("author");

function changeQuote() {
  // Исчезновение с плавной анимацией
  quoteText.style.opacity = "0";
  quoteAuthor.style.opacity = "0";

  setTimeout(() => {
      // Обновляем цитату после полного исчезновения
      index = (index + 1) % quotes.length;
      quoteText.textContent = quotes[index].text;
      quoteAuthor.textContent = quotes[index].author;

      // Плавное появление
      quoteText.style.opacity = "1";
      quoteAuthor.style.opacity = "1";
  }, 500); // Ждем 0.5 секунды перед сменой текста
}

// Запускаем смену цитат каждые 5 секунд
setInterval(changeQuote, 5000);


