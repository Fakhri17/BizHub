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
const NPWP = document.getElementById("npwp");
NPWP.oninput = (e) => {
    e.target.value = autoFormatNPWP(e.target.value);
};

function autoFormatNPWP(NPWPString) {
    try {
        var cleaned = ("" + NPWPString).replace(/\D/g, "");
        var match = cleaned.match(
            /(\d{0,2})?(\d{0,3})?(\d{0,3})?(\d{0,1})?(\d{0,3})?(\d{0,3})$/
        );
        return [
            match[1],
            match[2] ? "." : "",
            match[2],
            match[3] ? "." : "",
            match[3],
            match[4] ? "." : "",
            match[4],
            match[5] ? "-" : "",
            match[5],
            match[6] ? "." : "",
            match[6],
        ].join("");
    } catch (err) {
        return "";
    }
}
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
            const fieldNames = {
                username: "Username",
                name: "Name",
                email: "Email",
                password: "Password",
                phone_number: "Phone number",
                address: "Address",
            };

            if (!this.form[field]) {
                this.errors[field] = `${fieldNames[field]} is required`;
            } else if (field === "username") {
                if (this.form[field].length < 6) {
                    this.errors[
                        field
                    ] = `${fieldNames[field]} minimal 6 karakter`;
                } else if (/\s/.test(this.form[field])) {
                    this.errors[
                        field
                    ] = `${fieldNames[field]} tidak boleh mengandung spasi`;
                } else if (
                    this.form[field].toLowerCase() !== this.form[field]
                ) {
                    this.errors[
                        field
                    ] = `${fieldNames[field]} harus huruf kecil semua`;
                } else {
                    this.errors[field] = "";
                }
            } else if (
                field === "email" &&
                !this.validateEmail(this.form[field])
            ) {
                this.errors[field] = "Email tidak valid";
            } else if (field === "password" && this.form[field].length < 6) {
                this.errors[field] = `${fieldNames[field]} minimal 6 karakter`;
            } else if (field === "phone_number") {
                const phoneNumber = this.form[field];
                const phoneNumberRegex = /^\d+$/;
                if (!phoneNumberRegex.test(phoneNumber)) {
                    this.errors[field] = "Phone number must be numeric";
                } else if (phoneNumber.length < 11 || phoneNumber.length > 15) {
                    this.errors[field] =
                        "Phone number must be between 11 and 15 digits";
                } else {
                    this.errors[field] = "";
                }
            } else {
                this.errors[field] = "";
            }
        },
        validateForm() {
            const fields = Object.keys(this.form);
            fields.forEach((field) => this.validateField(field));
            return Object.values(this.errors).every((val) => val === "");
        },
        submit(event) {
            this.errors = {};
            this.submitSuccess = false;
            this.submitError = false;
            this.validateForm();
            if (Object.values(this.errors).some((error) => error !== "")) {
                event.preventDefault();
            } else {
                this.$refs.form.submit();
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
            const fieldNames = {
                username: "Username",
                name: "Name",
                email: "Email",
                password: "Password",
                phone_number: "Phone number",
                address: "Address",
                npwp: "NPWP",
            };

            if (!this.form[field]) {
                this.errors[field] = `${fieldNames[field]} is required`;
            } else if (field === "username") {
                if (this.form[field].length < 6) {
                    this.errors[
                        field
                    ] = `${fieldNames[field]} minimal 6 karakter`;
                } else if (/\s/.test(this.form[field])) {
                    this.errors[
                        field
                    ] = `${fieldNames[field]} tidak boleh mengandung spasi`;
                } else if (
                    this.form[field].toLowerCase() !== this.form[field]
                ) {
                    this.errors[
                        field
                    ] = `${fieldNames[field]} harus huruf kecil semua`;
                } else {
                    this.errors[field] = "";
                }
            } else if (
                field === "email" &&
                !this.validateEmail(this.form[field])
            ) {
                this.errors[field] = "Email tidak valid";
            } else if (field === "password" && this.form[field].length < 6) {
                this.errors[field] = `${fieldNames[field]} minimal 6 karakter`;
            } else if (field === "phone_number") {
                const phoneNumber = this.form[field];
                const phoneNumberRegex = /^\d+$/;
                if (!phoneNumberRegex.test(phoneNumber)) {
                    this.errors[field] = "Phone number must be numeric";
                } else if (phoneNumber.length < 11 || phoneNumber.length > 15) {
                    this.errors[field] =
                        "Phone number must be between 11 and 15 digits";
                } else {
                    this.errors[field] = "";
                }
            } else {
                this.errors[field] = "";
            }
        },
        validateForm() {
            const fields = Object.keys(this.form);
            fields.forEach((field) => this.validateField(field));
            return Object.values(this.errors).every((val) => val === "");
        },
        submit(event) {
            this.errors = {};
            this.submitSuccess = false;
            this.submitError = false;
            this.validateForm();
            if (Object.values(this.errors).some((error) => error !== "")) {
                event.preventDefault();
            } else {
                this.$refs.form.submit();
            }
        },
    };
}
