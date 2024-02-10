const userMenuButton = document.getElementById("user-menu-button");
const menu = document.getElementById("user-menu");
userMenuButton.addEventListener("click", () => {
    menu.classList.toggle("hidden");
    if (menu.classList.contains("hidden")) {
        menu.classList.add("transition", "ease-out", "duration-100");
        menu.classList.add("transform", "opacity-0", "scale-95");
        menu.classList.remove("transform", "opacity-100", "scale-100");
    } else {
        menu.classList.add("transition", "ease-in", "duration-75");
        menu.classList.add("transform", "opacity-100", "scale-100");
        menu.classList.remove("transform", "opacity-0", "scale-95");
    }
});

const closeButton = document.getElementById("close-button");
const openButton = document.getElementById("open-button");
const offCanvasMenu = document.getElementById("off-canvas-menu");
const offCanvasMenuOverlay = document.getElementById("off-canvas-menu-overlay");
closeButton.addEventListener("click", () => {
    offCanvasMenu.classList.toggle("hidden");
    offCanvasMenu.classList.remove("flex");
    offCanvasMenuOverlay.classList.add(
        "transition",
        "ease-in-out",
        "duration-300"
    );
    offCanvasMenuOverlay.classList.add("opacity-0");
    offCanvasMenuOverlay.classList.remove("opacity-100");
});
openButton.addEventListener("click", () => {
    offCanvasMenu.classList.toggle("hidden");
    offCanvasMenu.classList.add("flex");
    offCanvasMenuOverlay.classList.add(
        "transition",
        "ease-in-out",
        "duration-300"
    );
    offCanvasMenuOverlay.classList.add("opacity-100");
    offCanvasMenuOverlay.classList.remove("opacity-0");
});

const successMessage = document.getElementById("success-message");
const errorMessage = document.getElementById("error-message");
setTimeout(() => {
    successMessage.classList.add("hidden");
    errorMessage.classList.add("hidden");
}, 4000);

function changeAvatar(event) {
    let avatar = document.getElementById("profile-avatar");
    let avatarPlaceholder = document.getElementById(
        "profile-avatar-placeholder"
    );
    // let newAvatar = document.getElementById("new-avatar");
    avatarPlaceholder.classList.add("hidden");
    avatar.src = URL.createObjectURL(event.target.files[0]);
    avatar.classList.remove("hidden");
    // newAvatar.classList.remove("hidden");
    // newAvatar.src = URL.createObjectURL(event.target.files[0]);
}
