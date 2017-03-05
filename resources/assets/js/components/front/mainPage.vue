<template>
    <div>
        <div class="main-page-line">
            <carousel></carousel>
        </div>
        <div class="main-page-pic">
            <a href="">
                <img src="https://img.alicdn.com/tps/TB1lnWUNVXXXXbxXpXXXXXXXXXX-880-70.jpg_q90_.webp" alt="">
            </a>
        </div>
        <div class="main-page-line">
            <card :title="title"></card>
        </div>
        <div class="main-page-pic">
            <a href="">
                <img src="https://img.alicdn.com/tps/TB1lnWUNVXXXXbxXpXXXXXXXXXX-880-70.jpg_q90_.webp" alt="">
            </a>
        </div>
        <div class="main-page-line">
            <card :title="title"></card>
        </div>
        <div class="main-page-pic">
            <a href="">
                <img src="https://img.alicdn.com/tps/TB1lnWUNVXXXXbxXpXXXXXXXXXX-880-70.jpg_q90_.webp" alt="">
            </a>
        </div>
    </div>

</template>
<script>
    import Carousel from './carousel.vue'
    import Card from './card.vue'
    export default {
        data(){
            return {
                title: '热门商品 aa'
            }
        },
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

    .main-page-pic {
        text-align: center;
        margin: 50px auto;
    }
</style>

