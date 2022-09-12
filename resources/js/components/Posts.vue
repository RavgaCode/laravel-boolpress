<template>
    <section>
        <div class="container">
            <h2>Lista Posts</h2>

            <div class="row row-cols-3">
                <div v-for="post in posts" :key="post.id" class="col">
                    <div class="card" style="width: 18rem">
                        <div class="card-body">
                            <h5 class="card-title">{{ post.title }}</h5>
                            <p class="card-text">
                                {{ truncateText(post.content) }}
                            </p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: "Posts",
    data() {
        return {
            posts: [],
        };
    },
    methods: {
        truncateText(text) {
            if (text.length > 75) {
                return text.slice(0, 75) + "...";
            }

            return text;
        },
        getPosts() {
            axios.get("http://127.0.0.1:8000/api/posts").then((response) => {
                this.posts = response.data.results;
            });
        },
    },
    mounted() {
        this.getPosts();
    },
};
</script>
