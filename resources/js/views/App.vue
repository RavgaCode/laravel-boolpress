<template>
    <section>
        <MainHeaderVue />
        <div class="container">
            <router-view></router-view>
        </div>
    </section>
</template>

<script>
import MainHeaderVue from "../components/MainHeader.vue";
export default {
    name: "App",
    components: {
        MainHeaderVue,
    },
};
</script>
