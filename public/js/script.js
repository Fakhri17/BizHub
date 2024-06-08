// document
//     .getElementById("togglePassword")
//     .addEventListener("click", function () {
//         // Toggle the type attribute
//         const passwordField = document.getElementById("password");
//         const type =
//             passwordField.getAttribute("type") === "password"
//                 ? "text"
//                 : "password";
//         passwordField.setAttribute("type", type);

//         // Toggle the eye / eye slash icon
//         this.classList.toggle("fa-eye");
//         this.classList.toggle("fa-eye-slash");
//     });

function formValidationKonsumen() {
    return {
        form: {
            username: "",
            name: "",
            email: "",
            password: "",
            phone_number: "",
            address: "",
        },
        errors: {
            username: "",
            name: "",
            email: "",
            password: "",
            phone_number: "",
            address: "",
        },
        submitSuccess: false,
        submitError: false,
        validateEmail(email) {
            const re =
                /^(([^<>()\[\]\.,;:\s@"]+(\.[^<>()\[\]\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(String(email).toLowerCase());
        },
        validateField(field) {
            if (field === "username") {
                if (!this.form.username) {
                    this.errors.username = "Username is required";
                } else if (this.form.username.length < 6) {
                    this.errors.username = "Username minimal 6 karakter";
                } else {
                    this.errors.username = "";
                }
            }

            if (field === "name") {
                if (!this.form.name) {
                    this.errors.name = "Name is required";
                } else {
                    this.errors.name = "";
                }
            }

            if (field === "email") {
                if (!this.form.email) {
                    this.errors.email = "Email is required";
                } else if (!this.validateEmail(this.form.email)) {
                    this.errors.email = "Email tidak valid";
                } else {
                    this.errors.email = "";
                }
            }

            if (field === "password") {
                if (!this.form.password) {
                    this.errors.password = "Password is required";
                } else if (this.form.password.length < 6) {
                    this.errors.password = "Password minimal 6 karakter";
                } else {
                    this.errors.password = "";
                }
            }

            if (field === "phone_number") {
                if (!this.form.phone_number) {
                    this.errors.phone_number = "Phone number is required";
                } else {
                    this.errors.phone_number = "";
                }
            }

            if (field === "address") {
                if (!this.form.address) {
                    this.errors.address = "Address is required";
                } else {
                    this.errors.address = "";
                }
            }
        },
        validateForm() {
            this.validateField("username");
            this.validateField("name");
            this.validateField("email");
            this.validateField("password");
            this.validateField("phone_number");
            this.validateField("address");
            return Object.values(this.errors).every((val) => val === "");
        },
        submit(event) {
            this.errors = {}; // Clear previous errors
            this.submitSuccess = false;
            this.submitError = false;
            this.validateForm();
            if (Object.values(this.errors).some((error) => error !== "")) {
                // If there are any errors, prevent form submission
                // this.submitError = true;
                event.preventDefault();
            } else {
                // this.submitSuccess = true;
                // Optionally, submit the form using `this.$refs.form.submit()`
                this.$refs.form.submit(); // Submit the form if no errors
                // console.log("Form submitted successfully", this.form);
            }
        },
    };
}

function formValidationUMKM() {
    return {
        form: {
            username: "",
            name: "",
            email: "",
            password: "",
            phone_number: "",
            address: "",
            npwp: "",
        },
        errors: {
            username: "",
            name: "",
            email: "",
            password: "",
            phone_number: "",
            address: "",
            npwp: "",
        },
        validateEmail(email) {
            const re =
                /^(([^<>()\[\]\.,;:\s@"]+(\.[^<>()\[\]\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(String(email).toLowerCase());
        },
        validateField(field) {
            if (field === "username") {
                if (!this.form.username) {
                    this.errors.username = "Username is required";
                } else if (this.form.username.length < 6) {
                    this.errors.username = "Username minimal 6 karakter";
                } else {
                    this.errors.username = "";
                }
            }

            if (field === "name") {
                if (!this.form.name) {
                    this.errors.name = "Name is required";
                } else {
                    this.errors.name = "";
                }
            }

            if (field === "email") {
                if (!this.form.email) {
                    this.errors.email = "Email is required";
                } else if (!this.validateEmail(this.form.email)) {
                    this.errors.email = "Email tidak valid";
                } else {
                    this.errors.email = "";
                }
            }

            if (field === "password") {
                if (!this.form.password) {
                    this.errors.password = "Password is required";
                } else if (this.form.password.length < 6) {
                    this.errors.password = "Password minimal 6 karakter";
                } else {
                    this.errors.password = "";
                }
            }

            if (field === "phone_number") {
                if (!this.form.phone_number) {
                    this.errors.phone_number = "Phone number is required";
                } else {
                    this.errors.phone_number = "";
                }
            }

            if (field === "address") {
                if (!this.form.address) {
                    this.errors.address = "Address is required";
                } else {
                    this.errors.address = "";
                }
            }
            if (field === "npwp") {
                if (!this.form.npwp) {
                    this.errors.npwp = "NPWP is required";
                } else {
                    this.errors.npwp = "";
                }
            }
        },
        validateForm() {
            this.validateField("username");
            this.validateField("name");
            this.validateField("email");
            this.validateField("password");
            this.validateField("phone_number");
            this.validateField("address");
            this.validateField("npwp");
            return Object.values(this.errors).every((val) => val === "");
        },
        submit(event) {
            this.errors = {}; // Clear previous errors
            this.submitSuccess = false;
            this.submitError = false;
            this.validateForm();
            if (Object.values(this.errors).some((error) => error !== "")) {
                // If there are any errors, prevent form submission
                // this.submitError = true;
                event.preventDefault();
            } else {
                // this.submitSuccess = true;
                // Optionally, submit the form using `this.$refs.form.submit()`
                this.$refs.form.submit(); // Submit the form if no errors
                // console.log("Form submitted successfully", this.form);
            }
        },
    };
}
