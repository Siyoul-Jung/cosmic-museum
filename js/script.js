document.addEventListener("DOMContentLoaded", () => {
  const navLinks = document.querySelectorAll("nav a");
  navLinks.forEach(link => {
    link.addEventListener("mouseover", () => link.style.color = "#ffffff");
    link.addEventListener("mouseout", () => link.style.color = "#ffd369");
  });
});
