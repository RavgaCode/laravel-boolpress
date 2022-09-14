<template>
    <section>
        <h2>Sono la pagina del dettaglio</h2>

        {{ $route.params.slug }}
    </section>
</template>

<script>
export default {
    name: "SinglePost",
};
</script>
