<template>
    <section>
        <div class="container">
            <h2>Lista Posts</h2>

            <div class="row row-cols-3">
                <div class="col">
                    <div class="card" style="width: 18rem">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">
                                Some quick example text to build on the card
                                title and make up the bulk of the card's
                                content.
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
import Axios from "axios";

export default {
    name: "Posts",
    data() {
        return {
            posts: [],
        };
    },
    mounted() {
        Axios.get("http://127.0.0.1:8000/api/posts").then((response) => {
            this.posts = response.data.results;
        });
    },
};
</script>
