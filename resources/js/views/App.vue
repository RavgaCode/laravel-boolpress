<template>
    <section>
        <div class="container">
            <a href="/admin">Sezione Privata</a>
            <router-view></router-view>
        </div>
    </section>
</template>

<script>
export default {
    name: "App",
};
</script>
