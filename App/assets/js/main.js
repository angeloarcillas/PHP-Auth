document.querySelector("#menu").addEventListener("click", function () {
  document.querySelector("main").style.transform = "translateX(15rem)";
  document.querySelector(".main--nav").style.transform = "translateX(0)";
  document.querySelector("#menu").style.display = "none";
});

document.querySelector(".close").addEventListener("click", function () {
  document.querySelector("main").style.transform = "translateX(0)";
  document.querySelector(".main--nav").style.transform = "translateX(-15rem)";
  document.querySelector("#menu").style.display = "block";
});
