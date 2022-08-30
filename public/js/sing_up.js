var activities = document.getElementById("role");

activities.addEventListener("change", function () {
    const surnameField = document.getElementById("surname-field");
    const surname = document.getElementById("surname");
    const specialization = document.getElementById("specialization-field");

    if (activities.value === "ordinary") {
        surnameField.style.display = "none";
        surname.required = false;
        specialization.style.display = "none";
    } else if (activities.value === "instructor") {
        surnameField.style.display = "block";
        surname.required = true;
        specialization.style.display = "block";
    }
});
