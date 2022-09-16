<template>
    <section>
        <h2>Contattaci</h2>

        <div v-if="success" class="alert alert-success" role="alert">
            Grazie per averci contattato!
        </div>

        <form @submit.prevent="sendMessage()">
            <!-- //non mi serve la classe action nè il name nell'input, in quanto siamo in una single page application e la pagina non si deve refreshare -->
            <div class="mb-3">
                <label for="user-name" class="form-label">Nome</label>
                <input
                    v-model="userName"
                    type="text"
                    class="form-control"
                    id="user-name"
                />
                <div v-if="errors.name">
                    <div
                        v-for="(error, index) in errors.name"
                        :key="index"
                        class="alert alert-danger"
                        role="alert"
                    >
                        {{ error }}
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="user-email" class="form-label">Email</label>
                <input
                    v-model="userEmail"
                    type="email"
                    class="form-control"
                    id="user-email"
                />
                <div v-if="errors.email">
                    <div
                        v-for="(error, index) in errors.email"
                        :key="index"
                        class="alert alert-danger"
                        role="alert"
                    >
                        {{ error }}
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="user-message" class="form-label">Messaggio</label>
                <textarea
                    v-model="userMessage"
                    class="form-control"
                    id="user-message"
                    rows="10"
                ></textarea>
                <div v-if="errors.message">
                    <div
                        v-for="(error, index) in errors.message"
                        :key="index"
                        class="alert alert-danger"
                        role="alert"
                    >
                        {{ error }}
                    </div>
                </div>
            </div>
            <input type="submit" class="btn btn-primary" />
        </form>
    </section>
</template>

<script>
export default {
    name: "ContactPage",
    data() {
        return {
            userName: "",
            userEmail: "",
            userMessage: "",
            success: false,
            errors: {},
        };
    },
    methods: {
        sendMessage() {
            axios
                .post("/api/leads", {
                    //Siccome uso il metodo POST non serve creare l'oggetto params, ma inserisco i dati direttamente
                    name: this.userName,
                    email: this.userEmail,
                    message: this.userMessage,
                })
                .then((response) => {
                    if (response.data.success) {
                        this.success = true;

                        // Svuoto i campi
                        this.userName = "";
                        this.userEmail = "";
                        this.userMessage = "";
                    } else {
                        this.errors = response.data.errors;
                    }
                });
        },
    },
};
</script>
