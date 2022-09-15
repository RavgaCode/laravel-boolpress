<template>
    <section>
        <div class="container">
            <h2>Lista Posts</h2>

            <div class="row row-cols-3">
                <div v-for="post in posts" :key="post.id" class="col">
                    <div class="card" style="width: 18rem">
                        <div class="card-body">
                            <img :src="post.cover" :alt="post.title" />
                            <h5 class="card-title">{{ post.title }}</h5>
                            <p class="card-text">
                                {{ truncateText(post.content) }}
                            </p>
                            <router-link
                                class="btn btn-primary"
                                :to="{
                                    name: 'single-post',
                                    params: { slug: post.slug },
                                }"
                                >Leggi tutto</router-link
                            >
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pagination Nav -->
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <!-- Previous button -->
                    <li
                        class="page-item"
                        :class="{ disabled: currentPaginationPage == 1 }"
                    >
                        <a
                            class="page-link"
                            @click.prevent="getPosts(currentPaginationPage - 1)"
                            href=""
                            >Previous</a
                        >
                    </li>
                    <!-- Page buttons -->
                    <li
                        v-for="pageNumber in lastPaginationPage"
                        :key="pageNumber"
                        class="page-item"
                        :class="{ active: pageNumber == currentPaginationPage }"
                    >
                        <a
                            @click.prevent="getPosts(pageNumber)"
                            class="page-link"
                            href=""
                            >{{ pageNumber }}</a
                        >
                    </li>
                    <!-- Next button -->
                    <li
                        class="page-item"
                        :class="{
                            disabled:
                                currentPaginationPage == lastPaginationPage,
                        }"
                    >
                        <a
                            class="page-link"
                            @click.prevent="getPosts(currentPaginationPage + 1)"
                            href=""
                            >Next</a
                        >
                    </li>
                </ul>
            </nav>
        </div>
    </section>
</template>

<script>
export default {
    name: "Posts",
    data() {
        return {
            posts: [],
            currentPaginationPage: 1,
            lastPaginationPage: null,
        };
    },
    methods: {
        truncateText(text) {
            if (text.length > 75) {
                return text.slice(0, 75) + "...";
            }

            return text;
        },
        getPosts(pageNumber) {
            axios
                .get("/api/posts?page=", {
                    params: {
                        page: pageNumber,
                    },
                })
                .then((response) => {
                    // I miei post sono dentro results.data, perchè dal controller ho utilizzato il paginate
                    this.posts = response.data.results.data; //ottengo i post
                    this.currentPaginationPage =
                        response.data.results.current_page; //ottengo la current page
                    this.lastPaginationPage = response.data.results.last_page; //ottengo l'ultima pagina
                });
        },
    },
    mounted() {
        this.getPosts();
    },
};
</script>
