<template>
    <div>
        <div class="main-page-line">
            <carousel></carousel>
        </div>
        <div class="main-page-line">
            <card></card>
        </div>
    </div>

</template>
<script>
    import Carousel from './carousel.vue'
    import Card from './card.vue'
    export default {
        components: {
            Carousel,
            Card
        }
    }
</script>

<style>
    .main-page-line {
        margin-top: 10px;
        margin-bottom: 10px;
    }
</style>

