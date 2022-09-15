<template>
    <section>
        <div v-if="post">
            <!-- metto l'if per prevenire un errore qualora leggesse null per lentezza di connessione. In questo modo il div compare solo quando la chiamata è avvenuta con successo -->

            <h2>{{ post.title }}</h2>
            <img
                class="img-fluid"
                v-if="post.cover"
                :src="post.cover"
                :alt="post.title"
            />
            <div v-if="post.category">Categoria: {{ post.category.name }}</div>
            <p>{{ post.content }}</p>
            <div v-if="post.tags.length > 0">
                Tags:
                <span v-for="(tag, index) in post.tags" :key="index"
                    >{{ tag.name }}
                    <span v-if="index != post.tags.length - 1">, </span>
                </span>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: "SinglePost",
    data() {
        return {
            post: null,
        };
    },
    mounted() {
        axios.get("/api/posts/" + this.$route.params.slug).then((response) => {
            this.post = response.data.results;
        });
    },
};
</script>
