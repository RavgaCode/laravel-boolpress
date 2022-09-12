<template>
    <section>
        <div class="container">
            <a href="/admin">Sezione Privata</a>
            <h1>Ciao sono stampato con VueJs</h1>
            <Posts />
        </div>
    </section>
</template>

<script>
import Posts from "../components/Posts.vue";

export default {
    name: "App",
    components: {
        Posts,
    },
};
</script>
