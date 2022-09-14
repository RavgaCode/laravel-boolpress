import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import HomePage from "./pages/HomePage.vue";
import AboutPage from "./pages/AboutPage.vue";
import BlogPage from "./pages/BlogPage.vue";
import SinglePost from "./pages/SinglePost.vue";
import NotFound from "./pages/NotFound.vue";
//Regole per il routing
const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "home",
            component: HomePage,
        },
        {
            path: "/about",
            name: "about",
            component: AboutPage,
        },
        {
            path: "/blog",
            name: "blog",
            component: BlogPage,
        },
        {
            path: "/blog/:slug", //:slug è il corrispettivo vue dello {slug} della sintassi di laravel
            name: "single-post",
            component: SinglePost,
        },
        {
            path: "/*",
            name: "not-found",
            component: NotFound,
        },
    ],
});

export default router;
